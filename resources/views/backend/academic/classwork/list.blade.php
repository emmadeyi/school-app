<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Subject @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i> {{$topic->name}} <small>({{AppHelper::TOPIC_TYPE[$topic->type]}}) </small> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa icon-teacher"></i> Classwork</a></li>
            <li class="active">{{$topic->name}}</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
    <div class="row">
            <div class="col-md-12">
                <div id="printableArea">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box box-info">
                                <div class="box-body box-profile">
                                    <h3 class="profile-username text-left"> <i class="fa fa-files-o"></i> Note(s) 
                                    @can('classwork_note.create')
                                    <a href="{{ URL::route('classwork_note.create', $topic->id) }}" class="btn btn-info btn-sm pull-right" title="Add Class Note">
                                        <i class="fa fa-file-o"></i> Add Class Note
                                    </a>
                                    @endcan
                                    </h3>
                                    <ul class="list-group list-group-unbordered" data-note-list>
                                        @foreach($topic->notes as $note)
                                            <li class="list-group-item" style="background-color: #FFF">
                                                <?php $body = $note->body; ?>
                                                <b> <a href="#" class="note" id="{{$note->id}}" data-note-body="{{ $body }}">
                                                    <i class="fa fa-file"></i> {{$note->title}} </b></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                            
                            <div class="box box-info">
                                <div class="box-body box-profile">
                                    <h3 class="profile-username text-left"> <i class="fa fa-pencil"></i> Assignment(s)
                                    @can('classwork.create')
                                        <a class="btn btn-info btn-sm pull-right" href="{{ URL::route('question.create', $topic->id) }}" title="Add Assignemnt or Question" ><i class="fa fa-plus-circle"></i> Add Classwork</a>
                                    @endcan
                                    </h3>
                                    <ul class="list-group list-group-unbordered" data-classwork-list>
                                        @foreach($topic->question as $classwork)
                                            <li class="list-group-item" style="background-color: #FFF">
                                                <a href="{{ URL::route('classwork.show', $classwork->id) }}" id="{{ $classwork->id }}" data-classwork="{{ $classwork }}">
                                                    <i class="fa fa-pencil"></i> <b>{{$classwork->title}} </b> <small>({{AppHelper::ASSIGNMENT_TYPE[$classwork->type]}}) 
                                                    @can('classwork_grade.update')  
                                                    - ({{ $classwork->attempt->keyBy('user_id')->count() }}) 
                                                        @if($classwork->attempt->keyBy('user_id')->count() > 1) Attempts @else Attempt @endif
                                                    @endcan
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                            
                            <div class="box box-info">
                                <div class="box-body box-profile">
                                    <h3 class="profile-username text-left"> <i class="fa fa-calculator"></i> Quiz Tab
                                    @can('quiz.create')
                                        <a class="btn btn-info btn-sm pull-right" href="{{ URL::route('quiz.create', $topic->id) }}" title="Add Assignemnt or Question" ><i class="fa fa-plus-circle"></i> Add Quiz</a>
                                    @endcan
                                    </h3>
                                    <ul class="list-group list-group-unbordered" data-classwork-list>
                                        @foreach($topic->quiz as $quiz)
                                            <li class="list-group-item" style="background-color: #FFF">
                                                <a href="{{ URL::route('quiz.show', $quiz->id) }}" id="{{ $quiz->id }}" data-quiz="{{ $quiz }}">
                                                    <i class="fa fa-calculator"></i> <b>{{$quiz->title}} </b>
                                                    @can('classwork_grade.update')  
                                                    - ({{ $classwork->attempt->keyBy('user_id')->count() }}) 
                                                        @if($classwork->attempt->keyBy('user_id')->count() > 1) Attempts @else Attempt @endif
                                                    @endcan
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>                            
                        </div>

                        <div class="col-sm-8">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active lead"><a href="#details" data-toggle="tab">Activity Details</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="details">  
                                        <div class="row">
                                            <div class="col-12 mx-2">
                                                <p id="details_text">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <!-- Assignments -->
                        <h3> <i class="fa fa-files-o"></i> Class Note(s) 
                                @can('classwork_note.create')
                                    <a href="{{ URL::route('classwork_note.create', $topic->id) }}" class="btn btn-info btn-sm" title="Add Class Note">
                                        <i class="fa fa-file-o"></i> Add Class Note
                                    </a>
                                @endcan
                        </h3>
                        @foreach($topic->notes as $note)
                            <div class="box collasped-box">
                                <div class="box-header with-border x_title">
                                    <div class="mx-1">
                                        <br>
                                        <p class="lead text-primary">  <i class="fa fa-file-o"></i> 
                                            <b>{{$note->title}} </b>
                                            <br>
                                            @can('classwork_note.edit')
                                                <a class="btn btn-warning btn-sm" href="{{ URL::route('classwork_note.edit', $note->id) }}" title="Update Assignment" ><i class="fa fa-edit"></i> Edit Class Note </a>
                                            @endcan                                      
                                        </p>
                                    </div>
                                    <div class="box-tools pull-right">
                                        <br>
                                        <button type="button" class="btn btn-default btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="box-body" style="max-height: auto; display:none">
                                    <!-- Note Body -->
                                    <p class="lead px-3"> {!! $note->body !!} </p>
                                    <div>                                    
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- End of Note -->
                            </div>
                        @endforeach
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>--}}
        {{--
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-body">
                        <!-- Assignments -->
                        <h3> <i class="fa fa-pencil"></i> Assignment(s)
                                @can('classwork.create')
                                    <a class="btn btn-info btn-sm" href="{{ URL::route('question.create', $topic->id) }}" title="Add Assignemnt or Question" ><i class="fa fa-plus-circle"></i> Add Classwork</a>
                                @endcan
                        </h3>
                        {{--
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($topic->question as $classwork)
                                    <div class="box box-warning collasped-box">
                                        <div class="box-header with-border x_title">
                                            <div class="mx-1">
                                                <p class="lead text-primary">  <i class="fa fa-pencil"></i>  <strong>
                                                    {{AppHelper::CLASSWORK_TYPE[$classwork->classwork_type]}}
                                                    </strong> -  {{$classwork->title}}
                                                    <small>({{AppHelper::ASSIGNMENT_TYPE[$classwork->type]}}) </small>
                                                    <br>
                                                    @can('classwork.edit')
                                                        <a class="btn btn-warning btn-sm" href="{{ URL::route('question.edit', $classwork->id) }}" title="Update Assignment" ><i class="fa fa-edit"></i> Edit Classwork </a>
                                                    @endcan                                        
                                                </p>
                                            </div>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-default btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="box-body" style="max-height: auto; display:none">
                                            <!-- Assignments -->
                                            <div>                                    
                                                <p class="lead"> {{ $classwork->instructions }} 
                                                    <br><br>
                                                    @can('classwork_grade.update')  
                                                    <a href="{{ URL::route('classwork_attempt.show', $classwork->id) }}" type="submit" class="btn btn-info btn-sm" title="Grade Attempts">
                                                        <i class="fa fa-fw fa-check"></i> Grade Submission
                                                    </a>
                                                    @endcan
                            
                                                    @can('classwork_attempt.create')
                                                    <a href="{{ URL::route('classwork.show', $classwork->id) }}" type="submit" class="btn btn-info btn-sm" title="Attempt Classwork">
                                                        <i class="fa fa-fw fa-pencil"></i> Attempt Classwork
                                                    </a>
                                                    @endcan
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><strong>Subject</strong> <p>{{ $topic->subject->name }}</p></span>
                                                            <span><strong>Due Date</strong> <p>{{ $classwork->due_date }}</p></span>
                                                            <span><strong>Allocated Points</strong> <p>{{ $classwork->points }}</p></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span><strong>Teacher</strong> <p>{{ $topic->teacher->name }}</p></span>
                                                            <span><strong>Class</strong> <p>{{ $topic->class->name }}</p></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @can('classwork_grade.update')  
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="lead text-info">Submitted</p>
                                                                <h2 class="text-success">{{ $classwork->attempt->keyBy('user_id')->count() }}</h2>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="lead text-info">Pending</p>
                                                                <h2 class="text-danger">
                                                                    @if(($topic->class->student->count() - $classwork->attempt->keyBy('user_id')->count()) < 0)    
                                                                        {{ 0 }}
                                                                    @else
                                                                        {{ $topic->class->student->count() - $classwork->attempt->keyBy('user_id')->count() }}</h2>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                </div>
                                                <!-- End of Assignment -->
                                                <!-- Questions -->
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- End of Assignment -->
                                        <!-- Questions -->
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        --}}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        --}}
            
    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
    <script type="text/javascript">
        $(document).ready(function () {
            window.postUrl = '{{URL::Route("academic.subject_status", 0)}}';
            window.changeExportColumnIndex = 6;
            window.excludeFilterComlumns = [0,6,7];
            Academic.subjectInit();
            $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text());
        });   

        // const notes_list = document.querySelector('[data-note-list]')

        document.querySelector('[data-note-list]').addEventListener('click', function(e){
            e.preventDefault()
            if(e.target.tagName.toLowerCase() === 'a') {
                const body = e.target.getAttribute('data-note-body')
                document.querySelector('#details_text').innerHTML = body
            }         
        })     
    </script>
@endsection
<!-- END PAGE JS-->
