<?php

namespace App\Http\Controllers\Backend;

use App\Assignment;
use App\ClassworkGrade;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Question;
use App\Topic;
use Illuminate\Support\Facades\Auth;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role->role_id != 1 && Auth::user()->role->role_id != 8 && Auth::user()->role->role_id != 2 && Auth::user()->role->role_id != 3) return redirect()->back()->with('error', 'Only Teachers, Students and Admins can access class activities');

        $topics = null;

        if(Auth::user()->role->role_id === 1 || Auth::user()->role->role_id === 8) {
            // Admin
            $questions = Question::where('status', AppHelper::ACTIVE)->count();
            $topics = Topic::where('status', AppHelper::ACTIVE)->get();
        }
        
        if(Auth::user()->role->role_id === 2){ 
            //Teacher
            $topics = Topic::where('status', AppHelper::ACTIVE)
                    ->where('teacher_id', Auth::user()->employee->id)
                    ->get();
        }

        if(Auth::user()->role->role_id === 3){ 
            //Teacher
            $topics = Topic::where('status', AppHelper::ACTIVE)
                    ->where('class_id', Auth::user()->student->registration[0]->class->id)
                    ->get();
        }
        
        $topics = $topics->groupBy('subject_id', 'class_id');
        
        return view('backend.academic.topic.index', compact('topics'));
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
        //
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
            return redirect()->back()->with('error', "Classwork data not found");
        }

        $grades_array = [];
        $grade_type = null;
        $grade_remark = null;

        $user_attempts = $classwork->attempt->where('user_id', Auth::user()->id);
        $isAuthUser = false;
        foreach($user_attempts as $attempt){
            $grades = ClassworkGrade::where('attempt_id', $attempt->id)->get();
            if($grades->count() > 0) array_push($grades_array, $grades);
            if(Auth::user()->id === $attempt->user_id) $isAuthUser = true;
        }
        // dd($grades_array, $grades);
        // $grades = $classwork->grade;
        
        return view('backend.academic.classwork.show', compact('classwork', 'user_attempts', 'grades', 'grades_array', 'isAuthUser'));
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
