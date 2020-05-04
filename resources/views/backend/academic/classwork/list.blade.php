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
            {{$topic->name}} <small>({{AppHelper::TOPIC_TYPE[$topic->type]}}) </small> 
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
        {{-- <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box ">
                    <a class="small-box-footer bg-orange-dark" href="{{URL::route('topic.index')}}">
                        <div class="icon bg-orange-dark" style="padding: 9.5px 18px 8px 18px;">
                            <i class="fa fa-th"></i>
                        </div>
                        <div class="inner ">
                            <h3 class="text-white">{{$topics_count}} </h3>
                            <p class="text-white">
                                Active Topics </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box ">
                    <a class="small-box-footer bg-pink-light" href="{{URL::route('assignment.index')}}">
                        <div class="icon bg-pink-light" style="padding: 9.5px 18px 8px 18px;">
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <div class="inner ">
                            <h3 class="text-white">
                                {{$questions->where("classwork_type", 1)->count()}}  </h3>
                            <p class="text-white">
                                Active Assignments </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box ">
                    <a class="small-box-footer bg-purple-light" href="{{URL::route('question.index')}}">
                        <div class="icon bg-purple-light" style="padding: 9.5px 18px 8px 18px;">
                            <i class="fa fa-list-ol"></i>
                        </div>
                        <div class="inner ">
                            <h3 class="text-white">
                                {{$questions->where("classwork_type", 2)->count()}} </h3>
                            <p class="text-white">
                                Active Questions </p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box ">
                    <a class="small-box-footer bg-teal-light" href="{{URL::route('classwork.index')}}">
                        <div class="icon bg-teal-light" style="padding: 9.5px 18px 8px 18px;">
                            <i class="fa fa-files-o"></i>
                        </div>
                        <div class="inner ">
                            <h3 class="text-white">
                                0 </h3>
                            <p class="text-white">
                                Completed Classwork</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    @can('classwork.create')
                    <div class="box-header">
                        <div class="">
                            <div class="col-md-7"> 
                                @can('classwork.create')
                                    <a class="btn btn-info btn-sm" href="{{ URL::route('question.create', $topic->id) }}" title="Add Assignemnt or Question" ><i class="fa fa-plus-circle"></i> Add Classwork</a>
                                @endcan

                                @can('classwork_note.create')
                                    <a href="{{ URL::route('classwork_note.create', $topic->id) }}" class="btn btn-info btn-sm" title="Add Class Note">
                                        <i class="fa fa-file-o"></i> Add Class Note
                                    </a>
                                @endcan
                                </p>
                            </div>
                        </div>
                    </div> 
                    @endcan                 
                    <div class="box-body">
                        <!-- Assignments -->
                        <?php
                        // $topic_assignments = App\Assignment::where('topic_id', $topic-->get(); 
                        // $topic_classwork = App\Question::where('topic_id', $topic->id)->get(); 
                        ?>
                        @foreach($topic->notes as $note)
                            <div class="box box-warning collasped-box">
                                <div class="box-header with-border x_title">
                                    <div class="mx-3">
                                        <p class="lead text-primary">  <i class="fa fa-file-o"></i> 
                                            {{$note->title}} 
                                            <br>
                                            @can('classwork_note.edit')
                                                <a class="btn btn-warning btn-sm" href="{{ URL::route('classwork_note.edit', $note->id) }}" title="Update Assignment" ><i class="fa fa-edit"></i> Edit Class Note </a>
                                            @endcan                                      
                                        </p>
                                    </div>
                                    <div class="box-tools pull-right">
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
                        <div class="row">
                            <div class="col-md-12 px-3">
                                @foreach($topic->question as $classwork)
                                    <div class="box box-warning collasped-box">
                                        <div class="box-header with-border x_title">
                                            <div class="mx-3">
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
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

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
    </script>
@endsection
<!-- END PAGE JS-->
