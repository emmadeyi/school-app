<?php

namespace App\Http\Controllers\Backend;

use App\ClassworkNote;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\AppHelper;
use App\IClass;
use App\Subject;
use App\Topic;
use Mews\Purifier\Facades\Purifier;

class ClassworkNoteController extends Controller
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
        if($id >= 0 && $id != null){
            $topic_id = $id;
            $topic = Topic::findOrFail($topic_id);
        }

        $topics = Topic::where('status', AppHelper::ACTIVE)
            ->pluck('name', 'id');      
            
        return view('backend.academic.classwork_note.add', compact('topics', 'topic'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->module){
            return redirect()->back()->with('error', 'Invalid request');
        }


        $this->validate($request, [
                'title' => 'required|min:2|max:255',
            ]);

        $note = new ClassworkNote();
        $note->title = $request->title;
        $note->body = Purifier::clean($request->body);
        $note->topic_id = $request->module;

        if($note->save()){
            $msg = '';

            $adminMsg = $note->title." note added by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Note Added";
            return redirect()->back()->with('success', $msg);
        }else{
            $msg .= "Error adding note";
            return redirect()->back()->with('error', "Error adding note");
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
        $note = ClassworkNote::findOrFail($id);
        if(!$note)return redirect()->back()->with('error', 'Invalid request');
            
        return view('backend.academic.classwork_note.edit', compact('note'));
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
        $note = ClassworkNote::findOrFail($id);
        if(!$note)return redirect()->back()->with('error', 'Invalid request');

        $this->validate($request, [
                'title' => 'required|min:2|max:255',
            ]);
            
        $note->title = $request->title;
        $note->body = Purifier::clean($request->body);

        if($note->save()){
            $msg = '';

            $adminMsg = $note->title." note updated by ".auth()->user()->name;
            $nothing = AppHelper::sendNotificationToAdmins('info', $adminMsg);
            // Notification end
            //invalid dashboard cache
            // Cache::forget('SubjectCount');
            $msg .= "Note Updated";
            return redirect()->back()->with('success', $msg);
        }else{
            return redirect()->back()->with('error', "Error updating note");
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
        $note = ClassworkNote::find($id);
        $topic = $note->topic;
        if($note->delete()) return view('backend.academic.classwork.list', compact('topic'));

        return redirect()->back()->with('error', 'Error occured while deleting this note');
    }
}
