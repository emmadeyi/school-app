<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Teacher Profile @endsection
<!-- End block -->

<!-- Page body extra css -->
@section('extraStyle')
    <style>
        @media print {
            @page {
                size:  A4 landscape;
                margin: 5px;
            }
        }
    </style>
@endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <div class="btn-group">
            <a href="{{url()->previous()}}" class="btn btn-default"> <i class="fa fa-arrow-left"></i> Go Back </a>
        </div>
        <div class="btn-group">
            <a href="#"  class="btn-ta btn-sm-ta btn-print btnPrintInformation"><i class="fa fa-print"></i> Print</a>
        </div>
        @can('classwork.update')
        <div class="btn-group">
            <a href="{{URL::route('question.edit', $classwork->id)}}" class="btn-ta btn-sm-ta"><i class="fa fa-edit"></i> Edit</a>
        </div>
        @endcan
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa icon-teacher"></i> Classwork</a></li>
            <li class="active">Classwork Details</li>
        </ol>
    </section>
    <div class="box-header">
        @if ($errors->any())
            <div class="callout callout-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><b>Validation Error: </b> {{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content main-contents">
        <div class="row">
            <div class="col-md-12">
                <div id="printableArea">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box box-info">
                                <div class="box-body box-profile">
                                    <h3 class="profile-username text-center">{{ AppHelper::CLASSWORK_TYPE[$classwork->classwork_type] }}</h3>
                                    <p class="lead text-muted text-center">{{$classwork->topic->name}}</p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Type</b> <a class="pull-right">{{ AppHelper::QUESTION_TYPE[$classwork->type] }}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Points</b> <a class="pull-right">{{$classwork->points}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Due Date.</b> <a class="pull-right">{{$classwork->due_date}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Teacher</b> <a class="pull-right">{{$classwork->teacher->name}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Subject</b> <a class="pull-right">{{$classwork->subject->name}}</a>
                                        </li>
                                        <li class="list-group-item" style="background-color: #FFF">
                                            <b>Class</b> <a class="pull-right">{{$classwork->class->name}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>                            
                        </div>

                        <div class="col-sm-8">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active lead"><a href="#details" data-toggle="tab">Details</a></li>
                                    <li class="lead" ><a href="#attempts" data-toggle="tab">Attempts</a></li>
                                    <li class="lead"><a href="#grades" data-toggle="tab">Grade</a></li>
                                </ul>

                                
                                <div class="box-header">
                                    <div class="callout callout-info">
                                        <p><b>Note:</b> Please make sure to read the instructions given before proceeding with this class work.</p>
                                    </div>
                                </div>
                                @if($classwork->editable_answer)
                                    <p class="px-2 text-success">Modification to your response <b>Can</b> be made <b>Before</b> grading</p>
                                @else
                                    <p class="px-2 text-danger">Modification to your response <b>Can Not</b> be made <b>After</b> submission</p>
                                @endif
                                <div class="row mx-2">
                                    <div class="col-12 px-1">
                                        <label for="">Classwork</label>
                                        <p>
                                            {{ $classwork->title }}
                                        </p>
                                    </div>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="details">                                       
                                       <div class="row">
                                            <div class="col-12 mx-2">
                                                <label for="">Instruction</label>
                                                <p>
                                                    {{ $classwork->instructions }}
                                                </p>
                                            </div>
                                        </div>
                                       <div class="row">
                                            <div class="col-12 mx-2">
                                                <label for="">Answer Type</label>
                                                <p>
                                                    {{ AppHelper::ANSWER_TYPE[$classwork->answer_type] }}
                                                </p>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <?php 
                                        
                                        $canEdit = false;
                                        if($classwork->editable_answer)$canEdit = true;
                                        elseif(!$classwork->editable_answer && (!$user_attempts->count() > 0)) $canEdit = true;
                                        elseif($classwork->editable_answer && ($user_attempts->count() > 0)) $canEdit = true;  
                                        else $canEdit = false;
                                        if(count($grades_array) > 0) $canEdit = false; 
                                        if(!$isAuthUser) $canEdit = false;                                        
                                    ?>
                                    <div class="tab-pane" id="attempts">
                                        <form novalidate id="entryForm" action="{{URL::Route('classwork_attempt.store')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="answer_type" value="{{ $classwork->answer_type }}">
                                            <input type="hidden" name="classwork_id" value="{{ $classwork->id }}">
                                            @if($classwork->answer_type == 1)                      
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <label for="answer">Answer 
                                                                <small>(optional)</small>
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Input you answer here if any"></i>
                                                            </label>
                                                            <?php                                                                
                                                                $ans = "";                                                                
                                                                if($user_attempts->count() === 1) {
                                                                    foreach($user_attempts as $attempt){
                                                                        // dd($attempt->value);
                                                                        $ans = $attempt->value;
                                                                    }
                                                                }
                                                            ?>
                                                            @if($canEdit)
                                                            <textarea name="answer" class="form-control" required rows="7" > {{ old('answer', $ans) }}</textarea>
                                                            <span class="fa fa-location-arrow form-control-feedback"></span>
                                                            <span class="text-danger">{{ $errors->first('answer') }}</span>
                                                            @else
                                                            <p>{{$ans}}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>                                            
                                            @elseif($classwork->answer_type == 2)
                                                <p class="px-2">Check to select the correct answers</p>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered table-striped table-hover table-responsive">
                                                            <tbody>            
                                                                                                               
                                                           @foreach($classwork->answer as $answer)
                                                           <?php $check = false; ?>
                                                                @if($user_attempts->count() > 0 || Auth::user()->role->role_id === 2)
                                                                    @foreach($user_attempts as $attempt)
                                                                        <?php 
                                                                            if($attempt->answer_id == $answer->id){
                                                                                $check = true;
                                                                            }
                                                                        ?>
                                                                    @endforeach
                                                                @endif
                                                                
                                                                <tr>
                                                                    <td width=5%>
                                                                        <input type="checkbox"  class="checkbox" name="answer[]" @if($check) checked @endif @if(!$canEdit) disabled @endif value="{{$answer->id}}">
                                                                    </td>
                                                                    <td>
                                                                    {{$answer->text}}
                                                                    </td>  
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                                            
                                                    </div>
                                                </div>
                                            @else
                                                <p class="px-2">No answer is required. Just click on completed</p>
                                            @endif

                                            @if($canEdit)
                                                @if($classwork->answer_type == 1 || $classwork->answer_type == 2)
                                                    <div class="box-footer"> 
                                                        <button type="submit" class="btn @if($user_attempts->count() > 0) btn-warning @else btn-info @endif pull-right"><i class="fa fa-save"></i> 
                                                        @if($user_attempts->count() > 0) Update Response  @else @if($classwork->answer_type == 3) Completed @else Save Response @endif @endif</button>    
                                                    </div>
                                                @endif
                                            @endif
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="grades">      
                                        @if($grades_array != null)                                                  
                                            @can('classwork_grade.destroy')     
                                                <form  class="myAction" method="POST" action="{{URL::route('classwork_grade.destroy', $classwork->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}          
                                                    <input type="hidden" name="classwork_id" value="{{ $classwork->id }}">  
                                                    <input type="hidden"class="form-control" name="grades[]" value="{{$grades}}">  
                                                                                                              
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-fw fa-trash"></i> Delete Classwork
                                                    </button>
                                                </form>
                                                <br>
                                            @endcan
                                        @endif                              
                                       {{-- @if($classwork->type == 1 || ) --}}
                                        <form novalidate id="entryForm" action="{{URL::Route('classwork_grade.store')}}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="classwork_id" value="{{ $classwork->id }}">
                                            <?php 
                                                $value = null;
                                                $point = null;
                                                $at = null;
                                                $remark = null;
                                                $count = 0;
                                                
                                            ?>
                                            @if($classwork->answer_type == 1)                      
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <label for="answer">Answer 
                                                                <small>(optional)</small>
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Input you answer here if any"></i>
                                                            </label>
                                                            <?php
                                                                $ans = "No attempt to this classwork yet.";
                                                                $attempt_id = null;
                                                                if($user_attempts->count() === 1) {
                                                                    foreach($user_attempts as $attempt){
                                                                        $ans = $attempt->value;
                                                                        $attempt_id = $attempt->id;
                                                                    } 
                                                                }
                                                            ?>                                                            
                                                            <p>{{$ans}}</p>
                                                        </div>                                                        
                                                    </div>
                                                </div>   
                                               
                                                <hr>
                                                
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <label for="note">Grade Type
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set grade type for this attempt"></i>
                                                                </label>
                                                                <?php
                                                                    // $value = null;
                                                                    // $point = null;
                                                                    // $remark = null;
                                                                    if(count($grades_array) === 1) {
                                                                        foreach($grades_array[0] as $grade){
                                                                            $value = $grade->value;
                                                                            $point = $grade->point;
                                                                            $remark = $grade->remark;
                                                                        } 
                                                                    }
                                                                ?>     
                                                                @can('classwork_grade.update')
                                                                {!! Form::select('grade_type[]', AppHelper::CLASSWORK_GRADE_TYPE, $value, ['placeholder' => 'Grade type...','class' => 'form-control select2', 'required' => 'true']) !!} 
                                                                @else
                                                                    @if(count($grades_array) > 0)
                                                                        <p>{{AppHelper::CLASSWORK_GRADE_TYPE[$value]}}</p>
                                                                    @endif
                                                                @endcan
                                                            </div>
                                                            <div class="col-md-5">
                                                                <label for="note">Points
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set point for this attempt"></i>
                                                                </label>
                                                                @can('classwork_grade.update')
                                                                <input type="number" required step="0.01" class="form-control" name="points[]" placeholder="point" value="{{$point}}">
                                                                <input type="hidden"class="form-control" name="attempt_id[]" placeholder="point" value="{{$attempt_id}}">  
                                                                @else
                                                                     @if(count($grades_array) > 0)<p>{{$point}}</p>@endif
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group has-feedback">
                                                            <label for="note">Remark/ Comment 
                                                                <small>(optional)</small>
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remark or comment here"></i>
                                                            </label>
                                                            @can('classwork_grade.update')
                                                            <textarea name="remark" class="form-control"  maxlength="500" > {{ old('remark', $remark) }}</textarea>
                                                            <span class="fa fa-location-arrow form-control-feedback"></span>
                                                            <span class="text-danger">{{ $errors->first('remark') }}</span>
                                                            @else
                                                                 @if(count($grades_array) > 0)<p>{{$remark}}</p>@endif
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>                       
                                            @elseif($classwork->answer_type == 2)
                                                <p class="px-2">Selected option</p>
                                                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered table-striped table-hover table-responsive">
                                                            <tbody>
                                                            @foreach($classwork->answer as $answer)
                                                                @if($user_attempts->count() > 0)
                                                                    @foreach($user_attempts as $attempt)
                                                                    @if($attempt->answer_id == $answer->id)  
                                                                        @if(count($grades_array) > 0)
                                                                            @foreach($grades_array as $grade)
                                                                            
                                                                                <?php 
                                                                                    if($grade[0]->attempt_id == $attempt->id){
                                                                                        $value = $grade[0]->value;
                                                                                        $point = $grade[0]->point;
                                                                                        $at = $grade[0]->attempt_id;
                                                                                        $remark = $grade[0]->remark;
                                                                                    }
                                                                                    $count++
                                                                                ?>                         
                                                                            @endforeach  
                                                                        @endif    
                                                                            <tr>
                                                                                <td width=5%>
                                                                                   <i class="fa fa-check-square font-2 text-primary"></i>
                                                                                </td>
                                                                                <td>
                                                                                {{$answer->text}}
                                                                                </td> 
                                                                                <td width=25%>
                                                                                    @can('classwork_grade.update')
                                                                                    {!! Form::select('grade_type[]', AppHelper::CLASSWORK_GRADE_TYPE, $value, ['placeholder' => 'Grade type...','class' => 'form-control select2', 'required' => 'true']) !!}
                                                                                    @else
                                                                                        @if(count($grades_array) > 0)
                                                                                            <span>{{AppHelper::CLASSWORK_GRADE_TYPE[$value]}}</span>
                                                                                        @endif
                                                                                    @endcan
                                                                                </td> 
                                                                                <td width=15%>
                                                                                    @can('classwork_grade.update')
                                                                                    <input type="number" required step="0.01" class="form-control" name="points[]" placeholder="point" value="{{$point}}">
                                                                                    <input type="hidden"class="form-control" name="attempt_id[]" placeholder="point" value="{{$attempt->id}}">
                                                                                    @else
                                                                                        @if(count($grades_array) > 0)
                                                                                            <span>{{$point}}</span>
                                                                                        @endif
                                                                                    @endcan
                                                                                </td>
                                                                            </tr>
                                                                    @endif 
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <div class="form-group has-feedback">
                                                            <label for="note">Remark/ Comment 
                                                                <small>(optional)</small>
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Remark or comment here"></i>
                                                            </label>
                                                            @can('classwork_grade.update')
                                                            <textarea name="remark" class="form-control"  maxlength="500" > {{ old('remark', $remark) }}</textarea>
                                                            <span class="fa fa-location-arrow form-control-feedback"></span>
                                                            <span class="text-danger">{{ $errors->first('remark') }}</span>
                                                            @else
                                                                @if(count($grades_array) > 0)
                                                                    <p>{{$remark}}</p>
                                                                @endif
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <p class="px-2">No answer is required. Just click on completed</p>
                                            @endif
    
                                            @can("classwork_grade.edit")
                                                @if($classwork->answer_type == 1 || $classwork->answer_type == 2)                                                    
                                                    <div class="box-footer"> 
                                                        <button type="submit" class="btn @if($user_attempts->count() > 0 && (count($grades_array) > 0)) btn-warning @else btn-info @endif pull-right"><i class="fa fa-save"></i> 
                                                        @if($user_attempts->count() > 0 && count($grades_array) > 0) Update Grade  @else @if($classwork->answer_type == 3) Completed @else Save Grade @endif @endif</button>  
                                                    </div>
                                                @endif
                                            @endcan
                                        </form> 
                                        {{--
                                        @else
                                             <p class="px-2">No answer is required. Just click on completed</p>
                                        @endif                                  
                                        --}}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
            $('.btnPrintInformation').click(function () {
                $('ul.nav-tabs li:not(.active)').addClass('no-print');
                $('ul.nav-tabs li.active').removeClass('no-print');
                window.print();
            });

            $('form.myAction').submit(function (e) {
                e.preventDefault();
                var that = this;
                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this record!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        that.submit();
                    }
                });
            });

            $('input').not('.dont-style').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
@endsection
<!-- END PAGE JS-->
