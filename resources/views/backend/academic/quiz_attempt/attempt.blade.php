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
    <div class="row" data-questions-route="{{URL::route('quiz_attempt_questions.get', $quiz->id)}}" data-submit-quiz-route="{{URL::route('quiz_attempt.store')}}" data-quiz-container>
        <div class="col-md-12">
            <div id="printableArea">
                <div class="row " data-quiz-content-row>
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="box box-default p-3 text-center" data-quiz-id="{{$quiz->id}}" data-quiz-content data-question-ids="{{$question_ids}}" id="quiz-content-div">
                            <div class="callout callout-default">
                                <p><b>Note:</b> Please make sure to read the instructions carefully before proceeding with this quiz.</p>
                            </div>
                            <div id="demo" class="callout callout-default">

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
                                    <button data-start-quiz class="btn btn-default btn-lg"><i class="fa fa-refresh"></i> Start Quiz</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>

                </div>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="box box-default p-3 hide-div" data-quiz-questions id="question-content-div">
                            <div class="lead" data-quiz-duration-timer></div>

                        </div>
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

<template id="show-question-template">
    <p class="lead" data-template-question></p>
</template>

<template id="show-short-answer-template">
    <div class="form-group has-feedback">
        <label for="answer">Answer
            <small>(optional)</small>
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Input you answer here if any"></i>
        </label>
        <textarea name="answer" data-short-answer class="form-control" required rows="7"></textarea>
        <span class="fa fa-location-arrow form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('answer') }}</span>
    </div>
</template>
<template id="show-multichoice-answer-template">
    <div class="row">
        <div class="col-md-12" data-mutli-choice-div>

        </div>
    </div>
</template>
<template id="show-question-btn-template">
    <div class="row my-2" data-question-btn-div>
        <div class="col-12 mx-2 py-3">
            <button data-previous-question class="btn btn-default btn pull-left"><i class="fa fa-arrow-left"></i> Previous Question</button>
            <button data-next-question class="btn btn-default btn pull-right">Save and Continue <i class="fa fa-arrow-right"></i> </button>
            <button data-finish-quiz class="btn btn-default btn pull-right hide-div"><i class="fa fa-check-circle"></i> Finish Quiz</button>
            <div data-submit-quiz class="mx-1 p-2 hide-div pull-right">
                <button class="btn btn-default btn-lg"><i class="fa fa-check-square"></i> Submit</button>
            </div>
            <div data-generate-answers class="mx-1 p-2  hide-div pull-right">
                <button class="btn btn-default btn-lg"><i class="fa fa-info"></i> Re-generate Answers</button>
            </div>
            <div data-retake-quiz class="mx-1 p-2  hide-div pull-right">
                <button class="btn btn-default btn-lg"><i class="fa fa-refresh"></i> Re-Retake</button>
            </div>
        </div>
    </div>
</template>

<!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
<script type="text/javascript">
    $(document).ready(function() {
        Academic.subjectInit();
    });


    const LOCAL_STORAGE_QUESTIONS_KEY = 'questions';
    const LOCAL_STORAGE_ATTEMPTS_KEY = 'questions.attempt';
    const LOCAL_STORAGE_QUESTION_ID_KEY = 'question.selectedQuestionId';
    const LOCAL_STORAGE_ATTEMPT_ID_KEY = 'attempt.selectedAttemptId';

    let questionlist = JSON.parse(localStorage.getItem(LOCAL_STORAGE_QUESTIONS_KEY)) || []
    let attempts = JSON.parse(localStorage.getItem(LOCAL_STORAGE_ATTEMPTS_KEY)) || []
    let selectedQuestionId = localStorage.getItem(LOCAL_STORAGE_QUESTION_ID_KEY);
    let selectedAttemptId = localStorage.getItem(LOCAL_STORAGE_ATTEMPT_ID_KEY);

    const startQuizButton = document.querySelector('[data-start-quiz]');
    const QuizContentDiv = document.querySelector('[data-quiz-content]');
    const QuizContainerDiv = document.querySelector('[data-quiz-container]');
    const quiz_id = document.querySelector('[data-quiz-id]');
    const submitQuizRoute = document.querySelector('[data-submit-quiz-route]');
    const fetchQuestionRoute = QuizContainerDiv.getAttribute('data-questions-route');
    const QuizDurationTimer = document.querySelector('[data-quiz-duration-timer]');
    const QuizContentDivRow = $('[data-quiz-content-row]');
    const showQuestionTemplate = document.querySelector('#show-question-template');
    const showShortAnswerTemplate = document.querySelector('#show-short-answer-template');
    const showMultichoiceAnswerTemplate = document.querySelector('#show-multichoice-answer-template');
    const quizQuestionsDiv = document.querySelector('[data-quiz-questions]');
    const questionBtn = document.querySelector('#show-question-btn-template');
    const questionButtonsElement = document.importNode(questionBtn.content, true);
    questionButtonsDiv = questionButtonsElement.querySelector('[data-question-btn-div]');
    nextQuestionBtn = questionButtonsElement.querySelector('[data-next-question]');
    finishQuizBtn = questionButtonsElement.querySelector('[data-finish-quiz]');
    previousQuestionBtn = questionButtonsElement.querySelector('[data-previous-question]');
    generateAnswersBtn = questionButtonsElement.querySelector('[data-generate-answers]');
    submitAttemptBtn = questionButtonsElement.querySelector('[data-submit-quiz]');
    retakeQuizBtn = questionButtonsElement.querySelector('[data-retake-quiz]');

    const showMultichoiceElement = document.importNode(showMultichoiceAnswerTemplate.content, true);
    const quizQuestionDiv = document.querySelector('[data-quiz-questions]');
    let selectedOption = null;
    let multichoice = false;

    let clearTimer = false;
    let quizTime = null;

    function startTimer(durationInMinutes, element, quizTime) {
        var date = new Date();
        var deadline = new Date(date.getTime() + durationInMinutes * 60000);
        quizTime = setInterval(function() {

            var now = new Date().getTime();
            var t = deadline - now;
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((t % (1000 * 60)) / 1000);
            var time = '';

            if (days > 0) time += days + 'd ';
            if (hours > 0) time += hours + 'h ';
            if (minutes > 0) time += minutes + 'm ';
            if (seconds >= 0) time += seconds + 's ';
            element.innerHTML = '<p class="quiz-duration-timer pull-right"><b>Time Remianing: ' + time + '<b></p><br>'; //
            element.classList.remove('hide-div');
            if (t <= 0 || clearTimer === true) {
                clearInterval(quizTime);
                element.innerHTML = "<p class='quiz-duration-timer pull-right'><b>Time Up<b></p><br>";
                element.classList.add('hide-div');
                element.innerHTML = '';
                generateAnsweredQuestionWithAnswers()
            }
        }, 1000);
    }

    function setSelectedOption(questionId, attemptId) {
        return {
            'question': parseInt(questionId),
            'answer': parseInt(attemptId)
        }
    }

    function setShortAnswerAttempt(questionId, answer) {
        return {
            'question': parseInt(questionId),
            'answer': answer
        }
    }

    quizQuestionDiv.addEventListener('click', e => {
        e.preventDefault();
        if (e.target.tagName.toLowerCase() == 'p') {
            const selecetedOptionElement = e.target;
            selectedOption = setSelectedOption(selectedQuestionId, selecetedOptionElement.id);
            if ((!selecetedOptionElement.classList.contains('multi-answer-option-selected')) &&
                (selecetedOptionElement.classList.contains('multi-answer-option'))) {
                selecetedOptionElement.classList.add('multi-answer-option-selected');
                attempts.push(selectedOption);

            } else {
                selecetedOptionElement.classList.remove('multi-answer-option-selected');
                //remove from localStorage
                attempts = attempts.filter(
                    function(item) {
                        for (var key in selectedOption) {
                            if (item[key] === undefined || item[key] != selectedOption[key])
                                return true;
                        }
                        return false;
                    }
                );
            }
        }
    })

    nextQuestionBtn.addEventListener('click', e => {
        const nextQuestion = parseInt(nextQuestionBtn.getAttribute('data-next-question'));
        const size = parseInt(nextQuestionBtn.getAttribute('data-size'));
        const questionId = parseInt(nextQuestionBtn.id);
        if (!multichoice) {
            const shortAnswer = document.querySelector('[data-short-answer]').value;
            if (shortAnswer) {
                const shortAnswerAttempt = setShortAnswerAttempt(selectedQuestionId, shortAnswer);
                attempts = attempts.filter(attempt => attempt.question !== shortAnswerAttempt.question);
                attempts.push(shortAnswerAttempt);
            }
        }
        saveToLocalStorage();
        populateQuestionsDiv(questionlist, size, nextQuestion);
    });

    previousQuestionBtn.addEventListener('click', e => {
        const prevQuestion = parseInt(previousQuestionBtn.getAttribute('data-prev-question'));
        const size = parseInt(previousQuestionBtn.getAttribute('data-size'));
        const questionId = parseInt(nextQuestionBtn.id);
        if (!multichoice) {
            const shortAnswer = document.querySelector('[data-short-answer]').value;
            if (shortAnswer) {
                const shortAnswerAttempt = setShortAnswerAttempt(selectedQuestionId, shortAnswer);
                attempts = attempts.filter(attempt => attempt.question !== shortAnswerAttempt.question);
                attempts.push(shortAnswerAttempt);
            }
        }
        saveToLocalStorage();
        populateQuestionsDiv(questionlist, size, prevQuestion);
    });

    finishQuizBtn.addEventListener('click', e => {
        const questionId = parseInt(finishQuizBtn.id);
        if (!multichoice) {
            const shortAnswer = document.querySelector('[data-short-answer]').value;
            if (shortAnswer) {
                const shortAnswerAttempt = setShortAnswerAttempt(selectedQuestionId, shortAnswer);
                attempts = attempts.filter(attempt => attempt.question !== shortAnswerAttempt.question);
                attempts.push(shortAnswerAttempt);
            }
        }
        saveToLocalStorage();
        clearTimer = true;
        generateAnsweredQuestionWithAnswers();
    });

    generateAnswersBtn.addEventListener('click', e => {
        e.preventDefault();
        generateAnsweredQuestionWithAnswers();
    });

    submitAttemptBtn.addEventListener('click', e => {
        e.preventDefault();
        submitQuizAttempt();
    });
    retakeQuizBtn.addEventListener('click', e => {
        e.preventDefault();
        initializeQuiz();
    });

    startQuizButton.addEventListener('click', function(e) {
        e.preventDefault();
        initializeQuiz();
    });

    function generateAnsweredQuestionWithAnswers() {
        quizQuestionsDiv.innerHTML = '';
        nextQuestionBtn.classList.add('hide-div');
        previousQuestionBtn.classList.add('hide-div');
        finishQuizBtn.classList.add('hide-div');
        generateAnswersBtn.classList.remove('hide-div');
        submitAttemptBtn.classList.remove('hide-div');
        retakeQuizBtn.classList.remove('hide-div');

        quizQuestionsDiv.appendChild(questionButtonsDiv);

        questionlist.forEach(questionArray => {
            selectedQuestionId = questionArray['id'];
            const questionDiv = document.createElement('div');
            const id = selectedQuestionId;
            const questionText = questionArray["question"];
            multichoice = questionArray["multichoice"];
            const answers = questionArray["answers"];
            const questionElement = document.importNode(showQuestionTemplate.content, true);
            const questionButtonsElement = document.importNode(questionBtn.content, true);
            const question = questionElement.querySelector('[data-template-question]');
            question.innerHTML = '<b> Q' + id + '.</b> ' + questionText + '<br> <b>Ans.</b>';
            questionDiv.appendChild(questionElement);
            if (multichoice) {
                for (let i = answers.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [answers[i], answers[j]] = [answers[j], answers[i]];
                }

                const showMultichoiceElementTemp = document.importNode(showMultichoiceAnswerTemplate.content, true);
                const multiChoiceDivTemp = showMultichoiceElementTemp.querySelector('[data-mutli-choice-div]');

                answers.forEach(answer => {
                    const answersDiv = document.createElement('div');
                    answersDiv.id = answer[0];
                    attempts.forEach(attempt => {
                        if (selectedQuestionId === attempt.question && attempt.answer === answer[0]) {
                            answersDiv.innerHTML = `<p id=${answer[0]} data-id-${answer[0]} class="lead p-1 m-1 multi-answers">${answer[1]}</p>`;
                        }
                    });
                    multiChoiceDivTemp.appendChild(answersDiv);
                })
                questionDiv.appendChild(showMultichoiceElementTemp);

            } else {
                const answersDiv = document.createElement('div');
                attempts.forEach(attempt => {
                    if (selectedQuestionId === attempt.question) {
                        answersDiv.innerHTML = `<p class="lead p-1 m-1 multi-answers">${attempt.answer}</p>`;
                    }
                });


                questionDiv.appendChild(answersDiv);

            }

            // saveToLocalStorage();
            quizQuestionsDiv.append(questionDiv);
            quizQuestionDiv.append(document.createElement('hr'));
            quizQuestionsDiv.classList.remove('hide-div');
        });
    }

    function initQuizTemplate() {
        nextQuestionBtn.classList.add('hide-div');
        previousQuestionBtn.classList.add('hide-div');
        finishQuizBtn.classList.add('hide-div');
        generateAnswersBtn.classList.add('hide-div');
        submitAttemptBtn.classList.add('hide-div');
        retakeQuizBtn.classList.add('hide-div');
        quizQuestionsDiv.classList.add('hide-div');
        clearTimer = false;
    }

    function initializeQuiz() {
        initQuizTemplate();
        clearQuestionsFromLocalStorage();
        fetchQuizQuestions(fetchQuestionRoute);
    }

    function saveToLocalStorage() {
        // tasks = flatArray;
        localStorage.setItem(LOCAL_STORAGE_QUESTIONS_KEY, JSON.stringify(questionlist));
        localStorage.setItem(LOCAL_STORAGE_ATTEMPTS_KEY, JSON.stringify(attempts));
        localStorage.setItem(LOCAL_STORAGE_QUESTION_ID_KEY, selectedQuestionId);
        localStorage.setItem(LOCAL_STORAGE_ATTEMPT_ID_KEY, selectedAttemptId);
    }

    function clearQuestionsFromLocalStorage() {
        questionlist = [];
        attempts = [];
        selectedAttemptId = null;
        selectedQuestionId = null;
        saveToLocalStorage();
    }

    function updateQuestions(res) {
        questionlist = res.questions;
        saveToLocalStorage();
        durationToMinutes = parseInt(res.duration);
        var timeleft = 5;
        QuizContentDiv.innerHTML = "<p class='lead start-quiz-timer'>Initializing Quiz...";
        QuizContentDiv.classList.remove('hide-div');
        var initTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(initTimer);
                // QuizContentDiv.classList.add('hide-div');
                QuizContentDiv.innerHTML = '<p class="quiz-duration-timer pull-right"><b>Time Remianing: <b></p><br>';
                startTimer(durationToMinutes, QuizContentDiv, quizTime);
                populateQuestionsDiv(questionlist, 1, 1);
            } else {
                QuizContentDiv.innerHTML = `<p class='lead start-quiz-timer'> Starting Quiz in</p>
                                            <p class='start-quiz-timer-counter'>${timeleft}s<p>
                                            `;
            }
            timeleft -= 1;
        }, 1000);
    }

    function getQuestionSet(questions, questionPerView, currentView) {
        // human-readable page numbers usually start with 1, so we reduce 1 in the first argument
        return {
            'question': questions.slice((currentView - 1) * questionPerView, currentView * questionPerView),
            'prev': currentView - 1,
            'current': currentView,
            'size': questionPerView,
            'next': currentView + 1,
        };
    }

    function populateQuestionsDiv(questions, size, page) {

        const questionObject = getQuestionSet(questions, size, page);
        const questionArray = questionObject.question[0];
        quizQuestionsDiv.innerHTML = '';
        // quizQuestionDiv.append(QuizDurationTimer);
        selectedQuestionId = questionArray['id'];

        const questionDiv = document.createElement('div');
        const id = selectedQuestionId;
        const questionText = questionArray["question"];
        multichoice = questionArray["multichoice"];
        const answers = questionArray["answers"];
        const questionElement = document.importNode(showQuestionTemplate.content, true);
        const questionButtonsElement = document.importNode(questionBtn.content, true);
        const question = questionElement.querySelector('[data-template-question]');
        nextQuestionBtn.id = id;
        nextQuestionBtn.setAttribute('data-size', questionObject.size);
        nextQuestionBtn.setAttribute('data-next-question', questionObject.next);
        previousQuestionBtn.id = id;
        previousQuestionBtn.setAttribute('data-size', questionObject.size);
        previousQuestionBtn.setAttribute('data-prev-question', questionObject.prev);
        if (questionObject.next > questionlist.length) {
            if (!nextQuestionBtn.classList.contains('hide-div')) nextQuestionBtn.classList.add('hide-div');
            if (finishQuizBtn.classList.contains('hide-div')) {
                finishQuizBtn.classList.remove('hide-div');
                finishQuizBtn.id = id
            }
        } else {
            if (nextQuestionBtn.classList.contains('hide-div')) nextQuestionBtn.classList.remove('hide-div');
            if (!finishQuizBtn.classList.contains('hide-div')) finishQuizBtn.classList.add('hide-div');
        }
        if (questionObject.prev <= 0) {
            if (!previousQuestionBtn.classList.contains('hide-div')) previousQuestionBtn.classList.add('hide-div');
        } else {
            if (previousQuestionBtn.classList.contains('hide-div')) previousQuestionBtn.classList.remove('hide-div');
        }

        question.innerHTML = '<b> Q' + id + '.</b> ' + questionText;
        questionDiv.appendChild(questionElement);
        if (multichoice) {
            for (let i = answers.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [answers[i], answers[j]] = [answers[j], answers[i]];
            }

            const showMultichoiceElementTemp = document.importNode(showMultichoiceAnswerTemplate.content, true);
            const multiChoiceDivTemp = showMultichoiceElementTemp.querySelector('[data-mutli-choice-div]');

            answers.forEach(answer => {
                const answersDiv = document.createElement('div');
                answersDiv.id = answer[0];
                answersDiv.innerHTML = `
                            <p id=${answer[0]} data-id-${answer[0]} class="lead p-1 m-1 multi-answer-option selected-option">${answer[1]}</p>`;
                const selectedOption = setSelectedOption(selectedQuestionId, answer[0]);
                attempts.filter(
                    function(item) {
                        for (var key in selectedOption) {
                            if (item[key] === undefined || item[key] != selectedOption[key])
                                return false;
                        }
                        answersDiv.innerHTML = `
                            <p id=${answer[0]} class="lead p-1 m-1 multi-answer-option selected-option multi-answer-option-selected">${answer[1]}</p>
                        `;
                    }
                );

                multiChoiceDivTemp.appendChild(answersDiv);
            })
            questionDiv.appendChild(showMultichoiceElementTemp);

        } else {
            answerElement = document.importNode(showShortAnswerTemplate.content, true);
            const answer_input = answerElement.querySelector('textarea[name=answer]');
            answer_input.id = id;

            attempts.forEach(attemp => {
                if (selectedQuestionId === attemp.question) answer_input.value = attemp.answer;
            });

            questionDiv.appendChild(answer_input);
        }

        questionDiv.appendChild(questionButtonsDiv);
        saveToLocalStorage();
        quizQuestionsDiv.append(questionDiv);
        quizQuestionsDiv.classList.remove('hide-div');
    }

    async function fetchQuizQuestions(route) {
        axios.get(route)
            .then((response) => {
                updateQuestions(response.data);
            }).catch((error) => {
                let status = error.response.statusText;
                console.log(error.response.data);
                // console.log(error.response.status);
                // console.log(error.response.headers);                                                                  
                toastr.error(status);
            });
    }

    function submitQuizAttempt() {
        const route = submitQuizRoute.getAttribute('data-submit-quiz-route');
        axios.post(route, {
                attempts: attempts,
                quiz_id: quiz_id.getAttribute('data-quiz-id')
            })
            .then((response) => {
                console.log(response.data);
            }).catch((error) => {
                console.log(error);

                let status = error.response.statusText;
                console.log(error.response.data);
                // console.log(error.response.status);
                // console.log(error.response.headers);                                                                  
                toastr.error(status);
            });
    }
</script>
@endsection
<!-- END PAGE JS-->