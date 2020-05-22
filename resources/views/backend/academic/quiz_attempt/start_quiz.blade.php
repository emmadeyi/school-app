<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Quiz Attempt @endsection
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
    {{--
    <div class="btn-group">
        <a href="#" class="btn-ta btn-sm-ta btn-print btnPrintInformation"><i class="fa fa-print"></i> Print</a>
    </div>
    @can('quiz.update')
    <div class="btn-group">
        <a href="{{URL::route('quiz.edit', $quiz->id)}}" class="btn-ta btn-sm-ta"><i class="fa fa-edit"></i> Edit</a>
    </div>
    @endcan
    --}}
    <ol class="breadcrumb">
        <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{url()->previous()}}"><i class="fa fa-cubes"></i> Class Activity </a></li>
        <li class="active">Quiz Attempt</li>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="box box-default p-3 text-center" 
                        data-quiz-content 
                        data-question-ids="{{$question_ids}}" 
                        data-questions-route="{{URL::route('quiz_attempt_questions.get', $quiz->id)}}"
                        id="quiz-content-div">
                            <div class="callout callout-default">
                                <p><b>Note:</b> Please make sure to read the instructions carefully before proceeding with this quiz.</p>
                            </div>
                            <div class="row">
                                <div class="col-12 mx-2">
                                    <p class="lead">
                                        <span><b>Quiz Title</b> <br> {{$quiz->title}}</span> <br>
                                        <b>Instruction </b><br>
                                        {{ $quiz->instructions }}
                                    </p>
                                    <hr>
                                    <p class="lead">
                                        <?php
                                        use Carbon\CarbonInterval;
                                        $duration = CarbonInterval::minutes($quiz->duration)->cascade()->forHumans() 
                                        ?>
                                        This quiz contains <b>({{$quiz->no_question}})</b> questions and you are expected to complete this quiz within the specified quiz duration <b>({{$duration}})</b>
                                        
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mx-2">
                                    <a href="{{URL::route('quiz_attempt_questions.get', $quiz->id)}}" data-start-quiz class="btn btn-default btn-lg"><i class="fa fa-refresh"></i> Start Quiz</a">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

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

    });

    const startQuizButton = document.querySelector('[data-start-quiz]');
    const QuizContentDiv = document.querySelector('[data-quiz-content]');
    startQuizButton.addEventListener('click', fetchQuizQuestions);

    function fetchQuizQuestions(e){
        const question_ids = QuizContentDiv.getAttribute('data-question-ids');
        const route = QuizContentDiv.getAttribute('data-questions-route')
        console.log(question_ids);        
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

    function fetchQuestionAnswers(id){
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