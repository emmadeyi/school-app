<?php

namespace App\Http\Controllers\Backend;

use App\Answer;
use App\Classwork;
use App\ClassworkAttempt;
use App\ClassworkGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\User;
use Illuminate\Support\Facades\Auth;

class ClassworkAttemptController extends Controller
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
        if($request->answer_type == 1){
            $this->validate($request, [
                    'answer' => 'required|min:1|max:255',
                ]);

            $this->checkAttempt($request->classwork_id);

            if($this->processAttempt($request->answer, null, $request)){
                $return = true;
            }else{
                $return = false;
            }
        }elseif($request->answer_type == 2){
            $this->validate($request, [
                    'answer' => 'required|array',
                ]);
            
            $this->checkAttempt($request->classwork_id);

            foreach($request->answer as $answer_id){
                $ans = Answer::where('id', $answer_id)->pluck('text');
                if($this->processAttempt($ans[0], $answer_id, $request)){
                    $return = true;
                }else{
                    $return = false;
                }
            }

        }else{
            $this->checkAttempt($request->classwork_id);

            if($this->processAttempt(null, null, $request)){
                    $return = true;
                }else{
                    $return = "Unable to submit attempt";
                }
        }

        if($return){
            $msg = "Attempt submitted. Pending grading";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg = "Error submitting attempt";
            return redirect()->back()->with('success', $msg);
        }
        
    }
    
    private function processAttempt($value, $answer_id, $request){          
        
        $attempt = new ClassworkAttempt();
        $attempt->code = now()->timestamp;
        $attempt->value = $value;
        $attempt->type = $request->answer_type;
        $attempt->user_id = Auth::user()->id;
        $attempt->count += 1;
        $attempt->answer_id = $answer_id;
        $attempt->classwork_id = $request->classwork_id;

        if($attempt->save()){
            return true;
        }else{
            return false;
        }

    }

    private function checkAttempt($id){
            $check = ClassworkAttempt::where('user_id', Auth::user()->id)->where('classwork_id', $id)->get();
            if($check){
                ClassworkAttempt::where('user_id', Auth::user()->id)->where('classwork_id', $id)->delete();
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
        $classwork = Question::findOrFail($id);        

        if(!$classwork){
            return redirect()->back()->with('error', 'Unable to retrive classwork data');
        }
        return view('backend.academic.classwork_attempt.list', compact('classwork', 'attempts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($classwork_id, $user_id)
    {
        $classwork = Question::findOrFail($classwork_id);
        if(!$classwork){
            return redirect()->back()->with('error', "Classwork data not found");
        }

        $grades_array = [];

        $user_attempts = $classwork->attempt->where('user_id', $user_id);
        $isAuthUser = false;
        // dd($user_attempts->count());

        foreach($user_attempts as $attempt){
            $grades = ClassworkGrade::where('attempt_id', $attempt->id)->get();
            if($grades->count() > 0) array_push($grades_array, $grades);
            if(Auth::user()->id === $attempt->user_id) $isAuthUser = true;
        }

        // dd($classwork, $user_attempts);
        
        
        return view('backend.academic.classwork.show', compact('classwork', 'user_attempts', 'grades', 'grades_array', 'isAuthUser'));
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
