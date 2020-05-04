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
            Manage Classwork
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa fa-cubes"></i> Classworks</a></li>
            <li class="active">Update Classwork</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                            <div class="callout callout-danger">
                                <p><b>Note:</b> Create a related teacher, class, subject and topic before creating questions.</p>
                                @can('classwork.destroy')                                                      
                                <form  class="myAction" method="POST" action="{{URL::route('question.destroy', $classwork->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}                                                          
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-fw fa-trash"></i> Delete Classwork
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </div>
                    <form novalidate id="entryForm" action="{{URL::Route('question.update', $classwork->id)}}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group has-feedback">
                                        <label for="title">Question<span class="text-danger">*</span></label>
                                        <input autofocus type="text" class="form-control" name="title" placeholder="Enter assignment or question here" value="{{ old('title', $classwork->title) }}" required minlength="1" maxlength="255">
                                        <span class="fa fa-question form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="classwork_type">Classwork Type<span class="text-danger">*</span>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="select classwork type"></i>
                                                </label>
                                                {!! Form::select('classwork_type', AppHelper::CLASSWORK_TYPE, $classwork->classwork_type, ['placeholder' => 'Select classwork type...','class' => 'form-control select2', 'required' => 'true']) !!}
                                                <span class="form-control-feedback"></span>
                                                <span class="text-danger">{{ $errors->first('classwork_type') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="type">Type<span class="text-danger">*</span>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="select question type"></i>
                                                </label>
                                                {!! Form::select('type', AppHelper::QUESTION_TYPE, $classwork->type, ['class' => 'form-control select2', 'required' => 'true']) !!}
                                                <span class="form-control-feedback"></span>
                                                <span class="text-danger">{{ $errors->first('type') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="points">Points <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set points for this assignment"></i>
                                        </label>
                                        
                                        <input autofocus type="number" class="form-control" name="points" placeholder="Assign Points" value="{{ old('name', $classwork->points) }}" min="0" max="100">
                                        <span class="fa fa-info form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('points') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="due_date">Due Date <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set due date for submission"></i>
                                        </label>
                                        <input type='text' class="form-control date_picker2"  readonly name="due_date" placeholder="Due Date" value="{{ old('due_date', $classwork->due_date) }} " maxlength="255" />
                                        <span class="fa fa-calendar form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="topic_id">Assign Topic
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign this assignment to a topic"></i>
                                        </label>
                                        {!! Form::select('topic_id', $topics, $classwork->topic_id, ['placeholder' => 'Pick a topic...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('topic_id') }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="ans_modify">Allow Answer Modification <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Allow Student to modifiy the answer?"></i>
                                        </label>                                        
                                        <select class="form-control select2" required name="ans_modify" id="ans_modify">
                                            <option value="1" @if($classwork->editable_answer == 1) selected @endif >Yes</option>
                                            <option value="0" @if($classwork->editable_answer == 0) selected @endif >No</option>
                                        </select>
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('ans_modify') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="collaborate">Allow Student Collaboration <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Allow Student to ask questions and collaborate"></i>
                                        </label>                                        
                                        <select class="form-control select2" required name="collaborate" id="collaborate">
                                            <option value="1" @if($classwork->collaboration == 1) selected @endif >Yes</option>
                                            <option value="0" @if($classwork->collaboration == 0) selected @endif >No</option>
                                        </select>
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('collaborate') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="ans_type">Answer Type
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select Answer Type"></i>
                                        </label>
                                        {!! Form::select('ans_type', AppHelper::ANSWER_TYPE, $classwork->answer_type, ['class' => 'form-control select2', 'id' => 'answer_type', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('ans_type') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="row hide-div" id="multiChoice">
                                <div class="col-12 p-2">
                                    <p class="lead">Filling in the options of the classwork response into the input field provided.</p>
                                    <p>Use the checkbox by the side of the fields to indicate the correct option(s). </p>
                                </div>
                                <div class="row px-2">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover table-responsive">
                                            <tbody>                                                
                                                @if($answers != null)
                                                    <?php 
                                                        $sn = 1;
                                                    ?>
                                                    @if($classwork->attempt != null)
                                                        <p class="text-danger">Cannot edit classwork that already has attempts</p>
                                                    @endif
                                                    @foreach($answers as $answer)
                                                        <tr>
                                                            <td width=10%>
                                                            Option {{$sn}}
                                                            </td>  
                                                            <td width=3%>
                                                                <input type="checkbox" @if($classwork->attempt->count() > 0) disabled @endif class="checkbox" name="correct[]" @if($answer->correct) checked @endif  value="{{$sn}}">
                                                            </td>
                                                            <td>
                                                                <div class="form-group has-feedback">
                                                                    <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]', $answer->text) }}" minlength="1" maxlength="255" @if($classwork->attempt->count() > 0) disabled @endif>
                                                                    <span class="fa fa-list-ol form-control-feedback"></span>
                                                                    <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php $sn++ ?>
                                                    @endforeach
                                                @else
    
                                                    <tr>
                                                        <td width=10%>
                                                        Option 1
                                                        </td>  
                                                        <td width=3%>
                                                            <input type="checkbox" class="checkbox" name="correct[]" value="1">
                                                        </td>
                                                        <td>
                                                            <div class="form-group has-feedback">
                                                                <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                                <span class="fa fa-list-ol form-control-feedback"></span>
                                                                <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width=10%>
                                                        Option 2
                                                        </td>  
                                                        <td width=3%>
                                                            <input type="checkbox" class="checkbox" name="correct[]" value="2">
                                                        </td>
                                                        <td>
                                                            <div class="form-group has-feedback">
                                                                <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                                <span class="fa fa-list-ol form-control-feedback"></span>
                                                                <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width=10%>
                                                        Option 3
                                                        </td>  
                                                        <td width=3%>
                                                            <input type="checkbox" class="checkbox" name="correct[]" value="3">
                                                        </td>
                                                        <td>
                                                            <div class="form-group has-feedback">
                                                                <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                                <span class="fa fa-list-ol form-control-feedback"></span>
                                                                <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width=10%>
                                                        Option 4
                                                        </td>  
                                                        <td width=3%>
                                                            <input type="checkbox" class="checkbox" name="correct[]" value="4">
                                                        </td>
                                                        <td>
                                                            <div class="form-group has-feedback">
                                                                <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                                <span class="fa fa-list-ol form-control-feedback"></span>
                                                                <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="note">Instruction 
                                            <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set instructions for this question"></i>
                                        </label>
                                        <textarea name="instruction" class="form-control"  maxlength="500" > {{ old('instruction', $classwork->instructions) }}</textarea>
                                        <span class="fa fa-location-arrow form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('instruction') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="class_id">Class Name
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set class that has to this question"></i>
                                        </label>
                                        {!! Form::select('class_id', $classes, $classwork->class_id, ['placeholder' => 'Pick a class...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('class_id') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="teacher_id">Teacher Name
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set subject teacher"></i>
                                        </label>
                                        {!! Form::select('teacher_id', $teachers, $classwork->teacher_id, ['placeholder' => 'Pick a teacher...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="teacher_id">Subject
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set topic subject"></i>
                                        </label>
                                        {!! Form::select('subject_id', $subjects, $classwork->subject_id, ['placeholder' => 'Pick a subject...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Update Classwork</button>
                            
                        </div>
                    </form>
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
            Academic.subjectInit();
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

            if($('select#answer_type').children("option:selected").val() == 2){
                $('#multiChoice').removeClass('hide-div');
                $('#multiChoice').addClass('show-div');
            }else{
                $('#multiChoice').addClass('hide-div');
                $('#multiChoice').removeClass('show-div');
            }

            $('select#answer_type').change(function(e){
                var selectedOption = $(this).children("option:selected").val();
                if(selectedOption == 2){
                    $('#multiChoice').removeClass('hide-div');
                    $('#multiChoice').addClass('show-div');
                }else{
                    $('#multiChoice').addClass('hide-div');
                    $('#multiChoice').removeClass('show-div');
                }               
            });
        });
    </script>
@endsection
<!-- END PAGE JS-->
