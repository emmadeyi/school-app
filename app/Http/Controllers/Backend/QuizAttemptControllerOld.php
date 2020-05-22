<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\Quiz;
use App\QuizAnswer;
use App\QuizAttempt;
use App\QuizQuestion;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Auth;

class QuizAttemptController extends Controller
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
        $quiz = Quiz::find($id);
        if (!$quiz || $quiz->no_question <= 0) return redirect()->back()->with('error', 'Quiz data not found');
        $quiz = Quiz::findOrFail($id);
        if (!$quiz) return redirect()->back();
        $quiz_type = $quiz->type;
        // dd($quiz->topic);
        if ($quiz->type = 1) $quiz_type = [AppHelper::MODULE_QUIZ, 'Module'];
        if ($quiz->type = 2) $quiz_type = [AppHelper::SUBJECT_QUIZ, 'Subject'];
        if ($quiz->type = 3) $quiz_type = [AppHelper::EXAM_QUIZ, 'Exam'];

        $answerType = null;
        $question_ids = $quiz->question->where('status', AppHelper::ACTIVE)
            ->random($quiz->no_question)->pluck('id');

        dd(QuizAttempt::all());
        return view('backend.academic.quiz_attempt.attempt', compact('quiz', 'question_ids', 'quiz_type', 'answerType'));
    }

    public function getAttemptQuestions(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        if (!$quiz) return false;
        $questions_array = [];
        $questions = $quiz->question->where('status', AppHelper::ACTIVE)
            ->random($quiz->no_question);

        foreach ($questions as $question) {
            $answers_array = [];
            $multichoice = false;
            if ($question->answer_type === '1') {
                $multichoice = true;
                $answers = $this->getQuestionAnswers($question->id);
                foreach ($answers as $answer) {
                    array_push($answers_array, [$answer->id, $answer->answer, $answer->correct]);
                }
            }
            array_push($questions_array, ['id' => $question->id, 'question' => $question->question, 'multichoice' => $multichoice, 'answers' => $answers_array, 'duration' => $quiz->duration]);
        }
        if ($request->ajax()) {
            return response()->json([
                'questions' => $questions_array,
            ], 200);
        } else return false;
    }

    private function getQuestionAnswers($id)
    {
        $question = QuizQuestion::findOrFail($id);
        if (!$question) return false;
        return $question->answer->random($question->answer->count());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return response()->json(QuizAttempt::get(), 200);
        $attempts = $request->attempts;
        $quiz = Quiz::find(intval($request->quiz_id));
        if (!$quiz) return response()->json(['Quiz info data not found'], 404);
        $return = false;
        $questions = [];
        $answers = [];
        $attemptCount = QuizAttempt::get();
        // foreach ($attempts as $attempt) {
        //     array_push($questions, $attempt['question']);
        //     $question = QuizQuestion::find(intval($attempt['question']));
        //     if (!$question) return response()->json(['Quiz question info data not found'], 404);
        //     $multichoice = false;
        //     if ($question->answer_type === '1') $multichoice = true;

        //     if ($multichoice) {
        //         if ($this->checkAttempt($quiz->id, $question->id)) {
        //             $ans = QuizAnswer::find(intval($attempt['answer']));
        //             array_push($answers, $this->checkAttempt($quiz->id, $question->id));
        //             if ($this->processAttempt($ans->answer, $question->id, $ans->id, $quiz->id)) {
        //                 $return = true;
        //             } else {
        //                 $return = false;
        //             }
        //         } else {
        //             $return = false;
        //         }
        //     } else {
        //         if ($this->checkAttempt($quiz->id, $question->id)) {
        //             if ($this->processAttempt($attempt['answer'], $question->id, null, $quiz->id)) {
        //                 $return = true;
        //             } else {
        //                 $return = false;
        //             }
        //         } else {
        //             $return = false;
        //         }
        //     }
        // }
        if ($return) {
            $msg = "Attempt submitted. Pending grading";
        } else {
            $msg = "Error submitting attempt";
        }
        return response()->json(["message" => $msg, QuizAttempt::get()], 200);
    }

    private function processAttempt($value, $question_id, $answer_id, $quiz_id)
    {
        $attempt = new QuizAttempt();
        $attempt->code = now()->timestamp;
        $attempt->value = $value;
        $attempt->user_id = Auth::user()->id;
        $attempt->answer_id = $answer_id;
        $attempt->question_id = $question_id;
        $attempt->quiz_id = $quiz_id;

        if ($attempt->save()) {
            return true;
        } else {
            return false;
        }
    }

    private function checkAttempt($id, $question_id)
    {
        $attempts = QuizAttempt::where('user_id', Auth::user()->id)
            ->where('quiz_id', $id)
            ->where('question_id', $question_id)
            ->get();
        $del = false;
        if ($attempts) {
            foreach ($attempts as $attempt) {
                if ($attempt->delete()) {
                    $del = true;
                } else {
                    $del = false;
                }
            }
        }
        return $del;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
