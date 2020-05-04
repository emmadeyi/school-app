<?php

namespace App\Http\Controllers\Backend;

use App\Assignment;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Subject;
use App\Topic;

class AssignmentController extends Controller
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
        $assignmentType = null;
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
        return view('backend.academic.assignment.add', compact('subjects', 'classes', 'teachers', 'topic_id', 'topics', 'topic', 'iclass', 'teacher', 'subject', 'assignmentType'));
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
            ]);
        
            
        $data = $request->all();
        $assignment = new Assignment();
        $assignment->title = ucwords($request->title);
        $assignment->code = now()->timestamp;
        $assignment->type = $request->type;
        $assignment->points = $request->points;
        $assignment->instructions = $request->instruction;
        $assignment->due_date = $request->due_date;
        $assignment->class_id = $request->class_id;
        $assignment->teacher_id = $request->teacher_id;
        $assignment->subject_id = $request->subject_id;
        $assignment->topic_id = $request->topic_id;
        
        if($assignment->save()){
            //now notify the admins about this record
            $adminMsg = $data['title']." assignment added by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            return redirect()->back()->with('success', "Assignment Added");
        }else{
            return redirect()->back()->with('error', "Error adding assignment");
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
