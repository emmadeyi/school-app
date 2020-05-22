<?php

namespace App\Http\Controllers\Backend;

use App\ClassworkNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\Question;
use App\Quiz;
use App\Topic;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $classwork = Topic::findOrFail($id);
        $modules = ClassworkNote::where('topic_id', $classwork->id);
        $module = null;
        $quiz_type = null;        

        return view('backend.academic.quiz.add', compact('modules', 'module', 'quiz_type', 'classwork'));
    }

    public function getConstrains(Request $request, $id){
        if($request->ajax()){            
            $notes = ClassworkNote::select('id', 'title as text')->where('topic_id', $id)->where('status', AppHelper::ACTIVE)->orderBy('title', 'asc')->get();
            $assignments = Question::select('id', 'title as text')->where('topic_id', $id)->where('status', AppHelper::ACTIVE)->orderBy('title', 'asc')->get();

            $constrains = [];

            foreach($notes as $note){
                $note['constrain'] = AppHelper::QUIZ_CONSTRIAN_NOTE;
                array_push($constrains, $note);
            }
            foreach($assignments as $assignment){
                $assignment['constrain'] = AppHelper::QUIZ_CONSTRIAN_ASSIGNMENT;
                array_push($constrains, $assignment);
            }

            return response()->json($constrains, 200);
        }else{
            return response()->json(['message' => 'failed'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required|min:1|max:255',
                'quiz_question_type' => 'required|numeric',
                'instruction' => 'max:500',
                'classwork_id' => 'integer',
            ]);
        $quiz_type = AppHelper::MODULE_QUIZ; 

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->instructions = $request->instruction;
        $quiz->duration = $request->duration;
        $quiz->due_date = $request->due_date;
        $quiz->type = $quiz_type;
        $quiz->no_question = $request->no_question;
        $quiz->question_type = $request->quiz_question_type;
        $quiz->auto_grade = $request->auto_grade ? '1' : '0';
        $quiz->constrained = $request->constrain_quiz ? '1' : '0';
        $quiz->constrain_id =  intval($request->module_id[0]);
        $quiz->constrain_type = intval($request->module_id[2]);
        $quiz->topic_id = $request->classwork_id;
        $quiz->status = intval($request->quiz_status);
        

        if($quiz->save()){
            $msg = "";
            //now notify the admins about this record
            $adminMsg = $quiz->title." quiz added by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Quiz Added";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg .= "Error adding quiz";
            return redirect()->back()->with('error', "Error adding quiz");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        if(!$quiz) return redirect()->back();
        $quiz_type = $quiz->type;
        // dd($quiz->topic);
        if($quiz->type = 1) $quiz_type = [AppHelper::MODULE_QUIZ, 'Module'];
        if($quiz->type = 2) $quiz_type = [AppHelper::SUBJECT_QUIZ, 'Subject'];
        if($quiz->type = 3) $quiz_type = [AppHelper::EXAM_QUIZ, 'Exam'];

        $answerType = null;
        // dd($quiz->question->count(), $quiz->question->where('status', AppHelper::ACTIVE)->count());
        return view('backend.academic.quiz.show', compact('quiz', 'quiz_type', 'answerType'));
    }
    
    public function getQuestionCount(Request $request, $id){
        $quiz = Quiz::findOrFail($id);
        if(!$quiz) return false;
        $totalQuestionCount = $quiz->question->count();
        $activeQuestionCount = $quiz->question->where('status', AppHelper::ACTIVE)->count();
        if($request->ajax()){
            return response()->json([
                'totalQuestionCount' => $totalQuestionCount,
                'activeQuestionCount' => $activeQuestionCount,
            ], 200);
        }    
        else return false;  

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $classwork = Topic::findOrFail($quiz->topic->id);
        $modules = ClassworkNote::where('topic_id', $classwork->id);
        $module = null;
        $quiz_type = null;

        if($request->ajax()){            
            $notes = ClassworkNote::select('id', 'title as text')->where('topic_id', $id)->where('status', AppHelper::ACTIVE)->orderBy('title', 'asc')->get();
            $assignments = Question::select('id', 'title as text')->where('topic_id', $id)->where('status', AppHelper::ACTIVE)->orderBy('title', 'asc')->get();

            $constrains = [];

            foreach($notes as $note){
                $note['constrain'] = AppHelper::QUIZ_CONSTRIAN_NOTE;
                array_push($constrains, $note);
            }
            foreach($assignments as $assignment){
                $assignment['constrain'] = AppHelper::QUIZ_CONSTRIAN_ASSIGNMENT;
                array_push($constrains, $assignment);
            }

            return $constrains;
        }

        return view('backend.academic.quiz.edit', compact('modules', 'module', 'quiz_type', 'classwork', 'quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Check if Quiz has Attempts and return if true

        $this->validate($request, [
                'title' => 'required|min:1|max:255',
                'quiz_question_type' => 'required|numeric',
                'instruction' => 'max:500',
                'classwork_id' => 'integer',
            ]);
        $quiz_type = AppHelper::MODULE_QUIZ; 

        $quiz = Quiz::findOrFail($id);
        $quiz->title = $request->title;
        $quiz->instructions = $request->instruction;
        $quiz->duration = $request->duration;
        $quiz->due_date = $request->due_date;
        $quiz->type = $quiz_type;
        $quiz->no_question = $request->no_question;
        $quiz->question_type = $request->quiz_question_type;
        $quiz->auto_grade = $request->auto_grade ? '1' : '0';
        $quiz->constrained = $request->constrain_quiz ? '1' : '0';
        $quiz->constrain_id =  intval($request->module_id[0]);
        $quiz->constrain_type = intval($request->module_id[2]);
        $quiz->topic_id = $request->classwork_id;
        $quiz->status = $request->quiz_status;
            
        // dd($request->quiz_status, $quiz->status);

        if($quiz->save()){
            $msg = "";

            //now notify the admins about this record
            $adminMsg = $quiz->title." quiz updated by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Quiz Updated";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg .= "Error updating quiz";
            return redirect()->back()->with('error', "Error updating quiz");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::findorFail($id);
        if(!$quiz){
            return redirect()->back()->with('error', "Quiz data not found");
        }

        if($quiz->delete()){
             return redirect()->route('classwork.index')->with('success', "Quiz deleted");
        }else{
             return redirect()->back()->with('error', "Error deleting record");
        }
    }
}
