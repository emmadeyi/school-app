<?php

namespace App\Http\Controllers\Backend;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Subject;
use App\Topic;

class TopicController extends Controller
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
    public function create($id=0)
    {
        
        $subjects = Subject::where('status', AppHelper::ACTIVE)->get();
            // ->pluck('name', 'id');

        $teachers = Employee::where('role_id', AppHelper::EMP_TEACHER)
            ->where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');

        $classes = IClass::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');
        $iclass = null;
        $topicType = null;
        $teacher = null;
        $subject = null;

        // dd($subjects, $classes, $teachers);
        return view('backend.academic.topic.add', compact('subjects', 'classes', 'teachers', 'topicType', 'iclass', 'teacher', 'subject'));
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
                'name' => 'required|min:1|max:255',
                'type' => 'required|numeric',
                'class_id' => 'required|integer',
                'subject_id' => 'required|integer',
            ]);

        $data = $request->all();
        $topic = new Topic();
        $topic->name = ucwords($request->name);
        $topic->code = now()->timestamp;
        $topic->type = $request->type;
        $topic->class_id = $request->class_id;
        $topic->subject_id = $request->subject_id;
        $topic->teacher_id = Subject::find($request->subject_id)->teacher->id;

        
        if($topic->save()){
            //now notify the admins about this record
            $adminMsg = $data['name']." subject added by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            return redirect()->back()->with('success', "Topic Added");
        }else{
            return redirect()->back()->with('error', "Error adding topic");
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
        $topic = Topic::findOrFail($id);

        // dd($topic->quiz);
        
        return view('backend.academic.classwork.list', compact('topic'));
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
