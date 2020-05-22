<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Add Quiz @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
<!-- Section header -->
<section class="content-header">
    <h1>
        Add Quiz
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{URL::route('topic.show', $classwork->id)}}"><i class="fa fa-cubes"></i> {{$classwork->name}}</a></li>
        <li class="active">Add Quiz</li>
    </ol>
</section>
<!-- ./Section header -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <form novalidate id="entryForm" action="{{URL::Route('quiz.store')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header">
                        <div class="callout callout-danger">
                            <p><b>Note:</b> Create a teacher, class, subject, topic or module before create new quiz.</p>
                        </div>
                    </div>
                    <div class="box-body">
                        @csrf
                        <input type="hidden" name="classwork_id" id="class_id" value="{{$classwork->id}}">
                        <input type="hidden" id="quiz_url" value="{{URL::Route('quiz_constrains.get', $classwork->id)}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <label for="name">Name/ Title<span class="text-danger">*</span></label>
                                    <input autofocus type="text" class="form-control" name="title" placeholder="Quiz Title" value="{{ old('title') }}" required minlength="1" maxlength="255">
                                    <span class="fa fa-info form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label for="type">Duration in Minutes <small>(optional)</small>
                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Enter quiz duration in minutes"></i>
                                            </label>
                                            <input autofocus type="number" class="form-control" name="duration" placeholder="Quiz duration" value="{{ old('duration') }}">
                                            <span class="form-control-feedback"></span>
                                            <span class="text-danger">{{ $errors->first('duration') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <label for="due_date">Due Date <small>(optional)</small>
                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set due date for submission"></i>
                                            </label>
                                            <input type='text' class="form-control date_picker2" readonly name="due_date" placeholder="Due Date" value="{{ old('due_date') }} " maxlength="255" />
                                            <span class="fa fa-calendar form-control-feedback"></span>
                                            <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group has-feedback">
                                    <label for="type">No. Question <small>(optional)</small>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Enter number of question per attempt"></i>
                                    </label>
                                    <input autofocus type="number" class="form-control" name="no_question" placeholder="Questions per attempt" value="{{ old('no_question') }}">
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('no_question') }}</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group has-feedback">
                                    <label for="note">Instruction
                                        <small>(optional)</small>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set instructions for this question"></i>
                                    </label>
                                    <textarea name="instruction" class="form-control" maxlength="500"> {{ old('instruction') }}</textarea>
                                    <span class="fa fa-location-arrow form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('instruction') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="auto_grade">Auto Grade
                                    <small>(optional)</small>
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Check the box if you want theis quiz to be automatically graded on completion. This only works for multiple choice questions"></i>
                                </label>
                                <input type="checkbox" class="checkbox" name="auto_grade">
                                <span class="text-danger">{{ $errors->first('auto_grade') }}</span>
                                <div class="col-12" id="constrain_quiz_div">
                                    <label for="constrain_quiz" id="constrain_quiz_label">Constrain Quiz?
                                        <small>(optional)</small>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Check the box if you want theis quiz to be constrained to the completion of an activity in related module"></i>
                                    </label>
                                    <input type="checkbox" class="checkbox" id="constrain_quiz" name="constrain_quiz">
                                    <span class="text-danger">{{ $errors->first('constrain_quiz') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 hide-div" id="module_activities">
                                <div class="form-group has-feedback">
                                    <label for="subject_id">Module Activities
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set topic/ module constrains"></i>
                                    </label>
                                    {!! Form::select('module_id', $modules, $module, ['class' => 'form-control select2', 'required' => 'true']) !!}
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('module') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">
                                    <label for="ans_type">Quiz Question Type
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select Quiz Type"></i>
                                    </label>
                                    {!! Form::select('quiz_question_type', AppHelper::QUIZ_QUESTION_TYPE, $quiz_type, ['placeholder' => 'Select Quiz Type', 'class' => 'form-control select2', 'id' => 'quiz_type', 'required' => 'true']) !!}
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('quiz_type') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group has-feedback">
                                    <label for="ans_type">Quiz Status
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Select Quiz Status"></i>
                                    </label>
                                    <select name="quiz_status" id="quiz_status" required class="'form-control select2">
                                        <option value="{{AppHelper::ACTIVE}}">Active</option>
                                        <option value="{{AppHelper::INACTIVE}}">Inactive</option>
                                    </select>
                                    <span class="form-control-feedback"></span>
                                    <span class="text-danger">{{ $errors->first('quiz_type') }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                        <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Save Quiz</button>

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
    $(document).ready(function() {
        Academic.subjectInit();
        const constrain_quiz = $('#constrain_quiz').iCheck('update')[0].checked;
        const module_activities = $('#module_activities');
        if (constrain_quiz) processQuizConstrains();
        $('#constrain_quiz').on('ifChecked', (e) => {
            processQuizConstrains();
        });
        $('#constrain_quiz').on('ifUnchecked', (e) => {
            if (!module_activities.hasClass('hide-div')) module_activities.addClass('hide-div');
        });

        function processQuizConstrains() {
            if (module_activities.hasClass('hide-div')) module_activities.removeClass('hide-div');
            Generic.loaderStart();
            const class_id = $('#class_id').val();
            getQuizConstrainModules(class_id, function(res = {}) {
                if (Object.keys(res).length) {
                    const constrains = $('select[name="module_id"]')
                    constrains.empty().select2();
                    constrains.append('<option selected="">Pick a Constrain...</option>');
                    Object(res).forEach(res => {
                        constrains.append('<option value="' + [res.id, res.constrain] + '">' + res.text + '</option>');
                    });
                } else {
                    // clear subject list dropdown
                    $('select[name="module_id"]').empty().select2({
                        placeholder: 'Pick a Constrain...'
                    });
                    toastr.warning('No Contrain Available! Add a Note or Assignment first.');
                }
                Generic.loaderStop();
            });
        }

    });

    function getQuizConstrainModules(class_id, responseData) {
        let getUrl = $('#quiz_url').val();
        if (class_id) {
            axios.get(getUrl)
                .then((response) => {
                    responseData(response.data);

                }).catch((error) => {
                    let status = error.response.statusText;
                    toastr.error(status);
                    responseData();
                });
        } else {
            responseData();
        }
    }
</script>
@endsection
<!-- END PAGE JS-->