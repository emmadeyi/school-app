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
            Add Question/ Assignment
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('topic.show', $topic_id)}}"><i class="fa fa-cubes"></i> Class Activity</a></li>
            <li class="active">Add Classwork</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="{{URL::Route('question.store')}}" method="post" enctype="multipart/form-data">
                        <div class="box-header">
                            <div class="callout callout-danger">
                                <p><b>Note:</b> Create a related teacher, class, subject and topic before creating questions.</p>
                            </div>
                        </div>
                        <div class="box-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group has-feedback">
                                        <label for="title">Question<span class="text-danger">*</span></label>
                                        <input autofocus type="text" class="form-control" name="title" placeholder="Enter Question" value="{{ old('title') }}" required minlength="1" maxlength="255">
                                        <span class="fa fa-info form-control-feedback"></span>
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
                                                {!! Form::select('classwork_type', AppHelper::CLASSWORK_TYPE, $classworkType, ['placeholder' => 'Select classwork type...','class' => 'form-control select2', 'required' => 'true']) !!}
                                                <span class="form-control-feedback"></span>
                                                <span class="text-danger">{{ $errors->first('classwork_type') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-feedback">
                                                <label for="type">Type<span class="text-danger">*</span>
                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="select question type"></i>
                                                </label>
                                                {!! Form::select('type', AppHelper::QUESTION_TYPE, $questionType, ['class' => 'form-control select2', 'required' => 'true']) !!}
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
                                        
                                        <input autofocus type="number" class="form-control" name="points" placeholder="Assign Points" value="{{ old('name', 0) }}" min="0" max="100">
                                        <span class="fa fa-info form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('points') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="due_date">Due Date <small>(optional)</small>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set due date for submission"></i>
                                        </label>
                                        <input type='text' class="form-control date_picker2"  readonly name="due_date" placeholder="Due Date" value="{{ old('due_date') }} " maxlength="255" />
                                        <span class="fa fa-calendar form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="topic_id">Assign Topic
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Assign this assignment to a topic"></i>
                                        </label>
                                        {!! Form::select('topic_id', $topics, $topic[0]->id, ['placeholder' => 'Pick a topic...','class' => 'form-control select2', 'required' => 'true']) !!}
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
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
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
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
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
                                        {!! Form::select('ans_type', AppHelper::ANSWER_TYPE, $answerType, ['class' => 'form-control select2', 'id' => 'answer_type', 'required' => 'true']) !!}
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
                                                <tr>
                                                    <td width=10%>
                                                    Option 1
                                                    </td>  
                                                    <td width=3%>
                                                        <input type="checkbox" class="checkbox" name="correct[]" value="1">
                                                    </td>
                                                    <td>
                                                        <div class="form-group has-feedback">
                                                            <input autofocus type="text" class="form-control" name="answer[]"placeholder="Enter Response/ answer for this classwork as required"value="{{ old('answer[]') }}" minlength="1" maxlength="255">
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
                                                            <input autofocus type="text" class="form-control" name="answer[]"placeholder="Enter Response/ answer for this classwork as required"value="{{ old('answer[]') }}" minlength="1" maxlength="255">
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
                                                            <input autofocus type="text" class="form-control" name="answer[]"placeholder="Enter Response/ answer for this classwork as required"value="{{ old('answer[]') }}" minlength="1" maxlength="255">
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
                                                            <input autofocus type="text" class="form-control" name="answer[]"placeholder="Enter Response/ answer for this classwork as required"value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                            <span class="fa fa-list-ol form-control-feedback"></span>
                                                            <span class="text-danger">{{ $errors->first('answer[]') }}</span>
                                                        </div>
                                                    </td>
                                                </tr>
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
                                        <textarea name="instruction" class="form-control"  maxlength="500" > {{ old('instruction') }}</textarea>
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
                                        {!! Form::select('class_id', $classes, $iclass, ['placeholder' => 'Pick a class...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('class_id') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="teacher_id">Teacher Name
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set subject teacher"></i>
                                        </label>
                                        {!! Form::select('teacher_id', $teachers, $teacher, ['placeholder' => 'Pick a teacher...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="teacher_id">Subject
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set topic subject"></i>
                                        </label>
                                        {!! Form::select('subject_id', $subjects, $subject, ['placeholder' => 'Pick a subject...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Add Classwork</button>    
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
    </script>
@endsection
<!-- END PAGE JS-->
