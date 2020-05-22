<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\QuizAnswer;
use App\QuizQuestion;
use Exception;
use Illuminate\Support\Facades\Validator;

class QuizQuestionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'The :attribute field is required',
            'array' => 'The :attribute field is required',
        ];
        $multichoice_ans = false;
        $response = '';
        $server_error = '';

        if($request->answer_type) {
            $multichoice_ans = true;
            $multichoice_error = true; 
            if(($request->answer != null && $request->correct != null) && count($request->correct) > 0 && count($request->answer) > 0){
                foreach($request->answer as $answer){
                    if($answer != null) {
                        $multichoice_error = false; 
                        break;
                    }
                }
                foreach($request->correct as $correct){
                    if($correct != null) {
                        $multichoice_error = false; 
                        break;
                    }
                }
            }            
        }else $multichoice_error = false;
        

        $validator = Validator::make(
            $request->all(),
            [
                'question' => 'required|string',
            ],
            $messages
        );
        if($validator->fails()){
            $response = $validator->messages();
        }else{
            if($multichoice_error === false){
                // process submittion
                $question = new QuizQuestion();
                $question->question = $request->question;
                $question->code = now()->timestamp;
                $question->points = intval($request->points);
                if($multichoice_ans) {$question->answer_type = '1';} 
                else {$question->answer_type = '2';}
                if($request->ans_modify) {$question->editable_answer = '1';} 
                else {$question->editable_answer = '0';}
                if($request->status) {$question->status = '1';} 
                else {$question->status = '0';}
                $question->quiz_id = $request->quiz_id;

                if($question->save()){
                    if($multichoice_ans){    
                        $options = $request->answer;
                        $correct = $request->correct;
                        
                        QuizAnswer::where('question_id', $question->id)->delete();
        
                        foreach($options as $optKey=>$option){  
                            if($option != null){
                                $ans = false;
                                foreach($correct as $cor){                
                                    if($optKey == ($cor - 1)){
                                        $ans = true;
                                    }
                                }
                                $answer = new QuizAnswer();
                                $answer->code = now()->timestamp;
                                $answer->answer = $option;
                                $answer->correct = $ans;
                                $answer->quiz_id = $request->quiz_id;
                                $answer->question_id = $question->id;
                                if($answer->save()){
                                    $response = "Multiple choice answers updated. <br> ";
                                }else{
                                    $server_error .= "Error saving updating answers . " . $option;
                                }
                            }          
                        }  
                    }
                    $response .= 'Question saved to question database <br>';
                }
                else{
                    $server_error .= 'Unable to save question to question database';
                }
            }else{
                $response = true;
                $server_error = 'Multichoice Option Error';
            }
        }
        return response()->json([
            $response, 
            'server_error' => $server_error,
            'multichoice_error' => $multichoice_error, 
            'request' => $request->all()], 200);
    }

    private function answerFielsInvalid(){
        return true;
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
