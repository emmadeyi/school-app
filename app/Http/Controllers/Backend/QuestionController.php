<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Assignment;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Question;
use App\Subject;
use App\Topic;


class QuestionController extends Controller
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
    public function create($id)
    {
        $topic_id = null;
        $topic = null;
        $iclass = null;
        $questionType = null;
        $answerType = null;
        $classworkType = null;
        $teacher = null;
        $subject = null;
        if($id >= 0 && $id != null){
            $topic_id = $id;
            $subject = Topic::where('status', AppHelper::ACTIVE)
            ->pluck('subject_id', 'id');
            $topic = Topic::where('status', AppHelper::ACTIVE)
            ->where('id', $topic_id)
            ->with('subject')
            ->with('teacher')
            ->with('class')
            ->get();
            
            $iclass = $topic[0]->class->id;
            $teacher = $topic[0]->teacher->id;
            $subject = $topic[0]->subject->id;

        }

        $topics = Topic::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');

        $subjects = Subject::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
            
        $teachers = Employee::where('role_id', AppHelper::EMP_TEACHER)
            ->where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');

        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
        
        

        // dd($subjects, $classes, $teachers, $topic, $topics, $topic[0]->teacher->id);
        return view('backend.academic.question.add', compact('subjects', 'classes', 'teachers', 'topic_id', 'topics', 'topic', 'iclass', 'teacher', 'subject', 'questionType', 'answerType', 'classworkType'));
    
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
                'type' => 'required|numeric',
                'points' => 'numeric',
                'instruction' => 'max:1000',
                'class_id' => 'integer',
                'teacher_id' => 'integer',
                'subject_id' => 'integer',
                'topic_id' => 'integer',
                'ans_type' => 'required|integer',
                'ans_modify' => 'required|integer',
                'collaborate' => 'required|integer',
                'classwork_type' => 'required|integer',
            ]);
        
            
        $data = $request->all();
        $question = new Question();
        $question->title = ucwords($request->title);
        $question->code = now()->timestamp;
        $question->type = $request->type;
        $question->points = $request->points;
        $question->instructions = $request->instruction;
        $question->due_date = $request->due_date;
        $question->class_id = $request->class_id;
        $question->teacher_id = $request->teacher_id;
        $question->subject_id = $request->subject_id;
        $question->topic_id = $request->topic_id;
        $question->answer_type = $request->ans_type;
        $question->classwork_type = $request->classwork_type;
        $question->editable_answer = $request->ans_modify;
        $question->collaboration = $request->collaborate;
        
        if($question->save()){
            $msg = "";
            //now notify the admins about this record
            if(!$question->attempt->count() > 0){
                if($question->answer_type == 2){
                    // modify answer
                    $options = $request->answer;
                    $correct = $request->correct;
                    
                    Answer::where('type_id', $question->id)->delete();
    
                    foreach($options as $optKey=>$option){            
                        $ans = false;
                        foreach($correct as $cor){                
                            if($optKey == ($cor - 1)){
                                $ans = true;
                            }
                        }
                        $answer = new Answer();
                        $answer->code = now()->timestamp;
                        $answer->text = $option;
                        $answer->correct = $ans;
                        $answer->type = $question->type;
                        $answer->type_id = $question->id;
                        if($answer->save()){
                            $msg = "Multiple choice answers updated. ";
                        }else{
                            $msg = "Error saving updating answers. ";
                        }
                    }  
                }
            }
            $adminMsg = $data['title']." question added by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Question Added";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg .= "Error adding question";
            return redirect()->back()->with('error', "Error adding question");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classwork = Question::findorFail($id);
        $answers = null;

        if(!$classwork){
            return redirect()->back()->with('error', "Classwork data not found");
        }

        $topics = Topic::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');

        $subjects = Subject::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
            
        $teachers = Employee::where('role_id', AppHelper::EMP_TEACHER)
            ->where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');

        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
        if($classwork->answer_type == 2){
            $answers = Answer::where('type_id', $classwork->id)->get();
        }
        return view('backend.academic.question.edit', compact('subjects', 'classes', 'teachers', 'topics', 'classwork', 'answers'));
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
        $question = Question::findorFail($id);

        if(!$question){
            return redirect()->back()->with('error', "Classwork data not found");
        }

        $this->validate($request, [
                'title' => 'required|min:1|max:255',
                'type' => 'required|numeric',
                'points' => 'numeric',
                'instruction' => 'max:1000',
                'class_id' => 'integer',
                'teacher_id' => 'integer',
                'subject_id' => 'integer',
                'topic_id' => 'integer',
                'ans_type' => 'required|integer',
                'ans_modify' => 'required|integer',
                'collaborate' => 'required|integer',
                'classwork_type' => 'required|integer',
            ]);
        
        
        $data = $request->all();
        $question = Question::findorFail($id);
        $question->title = ucwords($request->title);
        $question->code = now()->timestamp;
        $question->type = $request->type;
        $question->points = $request->points;
        $question->instructions = $request->instruction;
        $question->due_date = $request->due_date;
        $question->class_id = $request->class_id;
        $question->teacher_id = $request->teacher_id;
        $question->subject_id = $request->subject_id;
        $question->topic_id = $request->topic_id;
        $question->answer_type = $request->ans_type;
        $question->classwork_type = $request->classwork_type;
        $question->editable_answer = $request->ans_modify;
        $question->collaboration = $request->collaborate;        
        
        if($question->update()){
            $msg = "";
            if(!$question->attempt->count() > 0){                
                if($question->answer_type == 2){
                    // modify answer
                    $options = $request->answer;
                    $correct = $request->correct;
                    
                    Answer::where('type_id', $question->id)->delete();
    
                    foreach($options as $optKey=>$option){            
                        $ans = false;
                        foreach($correct as $cor){                
                            if($optKey == ($cor - 1)){
                                $ans = true;
                            }
                        }
                        $answer = new Answer();
                        $answer->code = now()->timestamp;
                        $answer->text = $option;
                        $answer->correct = $ans;
                        $answer->type = $question->type;
                        $answer->type_id = $question->id;
                        if($answer->save()){
                            $msg = "Multiple choice answers updated. ";
                        }else{
                            $msg = "Error saving updating answers. ";
                        }
                    }  
                }
            }

            //now notify the admins about this record
            $adminMsg = $data['title']." question updated by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Question updated";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg .= "Error updating question";
            return redirect()->back()->with('error', "Error updating question");
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
        $question = Question::findorFail($id);
        if(!$question){
            return redirect()->back()->with('error', "Classwork data not found");
        }

        if($question->delete()){
             return redirect()->route('classwork.index')->with('success', "Classwork deleted");
        }else{
             return redirect()->back()->with('error', "Error deleting record");
        }
    }
}
