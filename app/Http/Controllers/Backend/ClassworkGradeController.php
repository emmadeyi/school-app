<?php

namespace App\Http\Controllers\Backend;

use App\ClassworkGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;

class ClassworkGradeController extends Controller
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
        $classwork_id = $request->classwork_id;
        $classwork = Question::findOrFail($classwork_id);
        $grade_type = $request->grade_type;
        $points = $request->points;
        $attempt_id = $request->attempt_id;
        $remark = $request->remark;

        if($classwork->type == 1){
            if($points[0] == null || $grade_type[0] == null) return redirect()->back()->with('error', "Please allocate points and grade type to attampts. This is a graded classwork");
            $sum_points = 0;
            foreach($points as $point){
                $sum_points += $point;
            }

            if($sum_points > $classwork->points) return redirect()->back()->with('error', "Sum of allocated points <b>(" .$sum_points.")</b> cannot be greater than set points <b>(". $classwork->points .")</b> for this classwork");            
        }   

        foreach($attempt_id as $index => $a_id){
           ClassworkGrade::where('classwork_id', $classwork_id)->where('attempt_id', $a_id)->delete();
        }

        foreach($attempt_id as $index => $a_id){
            $grade = new ClassworkGrade();
            $grade->code = now()->timestamp;
            $grade->value = $grade_type[$index];
            $grade->point = $points[$index];
            $grade->remark = $remark;
            $grade->classwork_id = $classwork_id;
            $grade->attempt_id = $a_id;

            if($grade->save()){
                $msg = true;
            }else{
                $msg = false;
            }
        }
        return redirect()->back()->with("info", "Grades processed");
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
