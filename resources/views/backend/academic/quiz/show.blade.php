<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Quiz Info @endsection
<!-- End block -->

<!-- Page body extra css -->
@section('extraStyle')
<style>
    @media print {
        @page {
            size: A4 landscape;
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
        <a href="#" class="btn-ta btn-sm-ta btn-print btnPrintInformation"><i class="fa fa-print"></i> Print</a>
    </div>
    @can('quiz.update')
    <div class="btn-group">
        <a href="{{URL::route('quiz.edit', $quiz->id)}}" class="btn-ta btn-sm-ta"><i class="fa fa-edit"></i> Edit</a>
    </div>
    @endcan
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url()->previous()}}"><i class="fa fa-cubes"></i> Class Activity </a></li>
        <li class="active">Quiz Details</li>
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
                                <h3 class="profile-username text-center">{{ $quiz->topic->name }}</h3>
                                <p class="lead text-muted text-center">{{$quiz->title}}</p>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item" style="background-color: #FFF">
                                        <b>Quiz Type</b> <a class="pull-right">{{ $quiz_type[1] }}</a>
                                    </li>
                                    <li class="list-group-item" style="background-color: #FFF">
                                        <b>Question Type</b> <a class="pull-right">{{ AppHelper::QUIZ_QUESTION_TYPE[$quiz->question_type] }}</a>
                                    </li>
                                    <li class="list-group-item" style="background-color: #FFF">
                                        <b>Question per attempt</b> <a class="pull-right">{{ $quiz->no_question }}</a>
                                    </li>
                                    <li class="list-group-item" style="background-color: #FFF">
                                        <b>Duration</b> <a class="pull-right">{{$quiz->duration}}</a>
                                    </li>
                                    <li class="list-group-item" style="background-color: #FFF">
                                        <b>Due Date.</b> <a class="pull-right">{{$quiz->due_date}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active lead"><a href="#details" data-toggle="tab">Details</a></li>
                                <li class="lead"><a href="#attempts" data-toggle="tab">Take Quiz</a></li>
                                <li class="lead"><a href="#grades" data-toggle="tab">Quiz Grades</a></li>
                            </ul>


                            <div class="box-header">
                                <div class="callout callout-info">
                                    <p><b>Note:</b> Please make sure to read the instructions given before proceeding with this class work.</p>
                                </div>
                            </div>
                            {{--@if($classwork->editable_answer)
                                    <p class="px-2 text-success">Modification to your response <b>Can</b> be made <b>Before</b> grading</p>
                                @else
                                    <p class="px-2 text-danger">Modification to your response <b>Can Not</b> be made <b>After</b> submission</p>
                                @endif--}}
                            <div class="row mx-2">
                                <div class="col-12 px-1">
                                    <p class="lead"><b>Quiz</b> 
                                        @can('quiz_attempt.index') 
                                            <a href="#" class="btn btn-info btn-sm pull-right" data-attempt-quiz>View Quiz Attempts</a>
                                        @endcan
                                    </p>
                                    <p class="lead">
                                        {{ $quiz->title }}                                         
                                    </p>
                                </div>
                            </div>

                            <div class="tab-content">
                                <div class="tab-pane active" id="details">
                                    <div class="row">
                                        <div class="col-12 mx-2">
                                            <label for="">Instruction</label>
                                            <p>
                                                {{ $quiz->instructions }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12 mx-2">
                                            <p class="lead">Questions - <span id="question-count" data-count-route="{{URL::Route('quiz_question.count', $quiz->id)}}"></span> <button data-add-quiz-question class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> Add Question</button>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row hide-div" id="add-quiz-question-div">
                                        <form novalidate id="addQuestionForm"  data-route="{{URL::Route('quiz_question.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                            <div class="col-12 mx-2">
                                                <div class="row mx-2">
                                                    <div class="col-12">
                                                        <div class="form-group has-feedback">
                                                            <label for="note">Question
                                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Enter Question Here"></i>
                                                            </label>
                                                            <textarea name="question" class="form-control" maxlength="500" required> {{ old('question') }}</textarea>
                                                            <span class="fa fa-location-arrow form-control-feedback"></span>
                                                            <span class="text-danger" id="question-error">{{ $errors->first('question') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label for="points">Points <small>(optional)</small>
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set points for this question"></i>
                                                                </label>

                                                                <input autofocus type="number" class="form-control" name="points" placeholder="Assign Points" value="{{ old('name', 0) }}" min="0" max="100">
                                                                <span class="fa fa-info form-control-feedback"></span>
                                                                <span class="text-danger" id="points-error">{{ $errors->first('points') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label for="ans_modify">Answer Modification
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Allow Student to modifiy the answer before submittion?"></i>
                                                                </label>
                                                                <input type="checkbox" class="checkbox modify-checkbox" name="ans_modify">
                                                                <span class="form-control-feedback"></span>
                                                                <span class="text-danger" id="ans_modify-error">{{ $errors->first('ans_modify') }}</span>
                                                            </div>
                                                            <div class="form-group has-feedback">
                                                                <label for="auto_grade">Multi Choice Answer?
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Check the box if you want this question to have multichoice answer"></i>
                                                                </label>
                                                                <input type="checkbox" class="checkbox" id="multi-choice-answer" name="answer_type">
                                                                <span class="text-danger" id="answer_type-error">{{ $errors->first('answer_type') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group has-feedback">
                                                                <label for="auto_grade">Status
                                                                    <small>(optional)</small>
                                                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Check the box if you want this question to be available for quiz. Inactive questions can be activated anytime"></i>
                                                                </label>
                                                                <input type="checkbox" class="checkbox status-checkbox" name="status" checked>
                                                                <span class="text-danger" id="status-error">{{ $errors->first('status') }}</span>
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
                                                                <span class="text-danger" id="answer-error"></span>
                                                                <table class="table table-hover table-responsive">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td width=5%>
                                                                                A
                                                                            </td>
                                                                            <td width=3%>
                                                                                <input type="checkbox" class="checkbox option-checkbox" name="correct[]" value="1">
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group has-feedback">
                                                                                    <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
                                                                                    <span class="fa fa-list-ol form-control-feedback"></span>
                                                                                    <span class="text-danger" id="answer-error">{{ $errors->first('answer[]') }}</span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width=5%>
                                                                                B
                                                                            </td>
                                                                            <td width=3%>
                                                                                <input type="checkbox" class="checkbox option-checkbox" name="correct[]" value="2">
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
                                                                            <td width=5%>
                                                                                C
                                                                            </td>
                                                                            <td width=3%>
                                                                                <input type="checkbox" class="checkbox option-checkbox" name="correct[]" value="3">
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
                                                                            <td width=5%>
                                                                                D
                                                                            </td>
                                                                            <td width=3%>
                                                                                <input type="checkbox" class="checkbox option-checkbox" name="correct[]" value="4">
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group has-feedback">
                                                                                    <input autofocus type="text" class="form-control" name="answer[]" placeholder="Enter Response/ answer for this classwork as required" value="{{ old('answer[]') }}" minlength="1" maxlength="255">
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
                                                </div>
                                            </div>
                                            <div class="col-12 mx-2">
                                                <div class="box-footer">
                                                    <a href="#" class="btn btn-sm btn-default" id="cancel-question-form-button">Cancel</a>
                                                    <button type="submit" class="btn btn-info btn-sm pull-right"><i class="fa fa-save"></i> Save Question</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane" id="attempts">
                                    
                                    <div class="row">
                                        <div class="col-12 mx-2 my-1 text-center">
                                            <p class="lead">Click the <b>Take Quiz</b> button below to attempt quiz.</p>
                                            <a href="{{URL::route('quiz_attempt.create', $quiz->id)}}" class="btn btn-info btn-lg" data-attempt-quiz>Take Quiz</a>
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

</section>

<template id="add-question-template">
    <h3>Template</h3>

</template>
<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnPrintInformation').click(function() {
            $('ul.nav-tabs li:not(.active)').addClass('no-print');
            $('ul.nav-tabs li.active').removeClass('no-print');
            window.print();
        });

        $('form.myAction').submit(function(e) {
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

        getQuestionCount(function(res = {}){
            document.querySelector('#question-count').innerHTML = "Active - ("+ res.activeQuestionCount + ") | Total (" + res.totalQuestionCount +")";
        });

        $('input').not('.dont-style').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });

        const multichoiceAnswer = $('#multi-choice-answer').iCheck('update')[0].checked;
        const multiChoiceDiv = $('#multiChoice');
        if (!multichoiceAnswer) multiChoiceDiv.addClass('hide-div');
        $('#multi-choice-answer').on('ifChecked', (e) => {
            if (multiChoiceDiv.hasClass('hide-div')) multiChoiceDiv.removeClass('hide-div');
        });
        $('#multi-choice-answer').on('ifUnchecked', (e) => {
            if (!multiChoiceDiv.hasClass('hide-div')) multiChoiceDiv.addClass('hide-div');
        });
    });
    const addQuestionButton = document.querySelector('[data-add-quiz-question]');
    const addQuestionDiv = $('#add-quiz-question-div');
    const cancelQuestionFormBtn = document.querySelector('#cancel-question-form-button');
    const addQuestionForm = document.querySelector('#addQuestionForm');
    const questionCount = document.querySelector('#question-count')

    cancelQuestionFormBtn.addEventListener('click', hideShowQuestionDiv);
    addQuestionButton.addEventListener('click', hideShowQuestionDiv);

    addQuestionForm.addEventListener('submit', e => {
        e.preventDefault();
        toastr.info("Processing Data..."); 
        const route = addQuestionForm.getAttribute('data-route');
        const form_data = $('#addQuestionForm').serialize();
        processQuestionForm(route, form_data, function(res = {}){
            if(res[0].question){
                document.querySelector("#question-error").innerHTML = res[0].question[0];     
                toastr.error("Form Validation Error");           
            }else if(res.multichoice_error){
                document.querySelector("#answer-error").innerHTML = "Answer options and correct option is required when Multichoice is checked";                
                toastr.error("Form Validation Error");     
            }else if(res.server_error){           
                toastr.error(res.server_error);     
            }else{
                resetQuestionFormFields(res[0]);                
            }         
        });
        
    })

    function resetQuestionFormFields(res){
        toastr.success(res);
        document.querySelector("#question-error").innerHTML = '';
        document.querySelector("#answer-error").innerHTML = '';
        addQuestionForm.reset();
        addQuestionDiv.addClass('hide-div');
        $('.modify-checkbox').removeAttr('checked').iCheck('update');
        $('.option-checkbox').removeAttr('checked').iCheck('update');
        $('#multi-choice-answer').removeAttr('checked').iCheck('update');
        $('.status-checkbox').attr('checked', true).iCheck('update');
        $('#multiChoice').addClass('hide-div');
        getQuestionCount(function(res = {}){
            questionCount.innerHTML = "Active - ("+ res.activeQuestionCount + ") | Total (" + res.totalQuestionCount +")";
        });
    }

    function getQuestionCount(responseData){
        const route = questionCount.getAttribute('data-count-route');
        if(route) {
            axios.get(route)
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

    function hideShowQuestionDiv(e) {
        e.preventDefault()
        if (!addQuestionDiv.hasClass('hide-div')) addQuestionDiv.addClass('hide-div');
        else addQuestionDiv.removeClass('hide-div')
    }

    function processQuestionForm(route, data, responseData) {
        if (route) {
            axios.post(route, data)
                .then((response) => {
                    responseData(response.data);

                }).catch((error) => {
                    let status = error.response.statusText;
                    console.log(error.response.data);
                    // console.log(error.response.status);
                    // console.log(error.response.headers);                                                                  
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