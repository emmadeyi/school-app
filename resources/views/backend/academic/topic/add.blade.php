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
            Manage Topic/ Module
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa fa-cubes"></i> Classworks</a></li>
            <li class="active">Add Topic/ Module</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="{{URL::Route('topic.store')}}" method="post" enctype="multipart/form-data">
                        <div class="box-header">
                            <div class="callout callout-danger">
                                <p><b>Note:</b> Create a teacher, class and subject before create new topic/ module.</p>
                            </div>
                        </div>
                        <div class="box-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="name">Name/ Title<span class="text-danger">*</span></label>
                                        <input autofocus type="text" class="form-control" name="name" placeholder="name" value="{{ old('name') }}" required minlength="1" maxlength="255">
                                        <span class="fa fa-info form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="type">Type<span class="text-danger">*</span>
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="select subject type"></i>
                                        </label>
                                        {!! Form::select('type', AppHelper::TOPIC_TYPE, $topicType, ['class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('type') }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="class_id">Class Name
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set class that belongs to this subject"></i>
                                        </label>
                                        {!! Form::select('class_id', $classes, $iclass, ['placeholder' => 'Pick a class...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('class_id') }}</span>

                                    </div>
                                </div>
                                {{--<div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="teacher_id">Teacher/ Tutor Name
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set subject teacher"></i>
                                        </label>
                                        {!! Form::select('teacher_id', $teachers, $teacher, ['placeholder' => 'Pick a teacher...','class' => 'form-control select2', 'required' => 'true']) !!}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group has-feedback">
                                        <label for="subject_id">Subject/ Course
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Set topic/ module subject"></i>
                                        </label>

                                        <select name="subject_id" id="" required class="'form-control select2">
                                            <option value="">Pick a subject...</option>
                                            @foreach($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}} - {{$subject->class->name}} </option>
                                            @endforeach
                                        </select>
                                        {{--{!! Form::select('subject_id', $subjects, $subject, ['class' => 'form-control select2', 'required' => 'true']) !!} --}}
                                        <span class="form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('subject_id') }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i>Add Topic/ Module</button>

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
            // var section_list_url = '{{URL::Route("academic.section")}}';
            // var subject_list_url = '{{URL::Route("academic.subject")}}';
            Academic.subjectInit();
        });
        $('select[name="class_id"]').on('change', function () {
            Generic.loaderStart();
            let class_id = $(this).val();
            let type = 0; //(institute_category == "college") ? 0 : 2;
            getSubject(class_id, type, function (res = {}) {
                console.log(res);
                if (Object.keys(res).length) {

                    $('select[name="subject_id"]').empty().prepend('<option selected=""></option>').select2({ placeholder: 'Pick a subject...', data: res });

                }
                else {
                    // clear subject list dropdown
                    $('select[name="subject_id"]').empty().select2({ placeholder: 'Pick a subject...' });
                    toastr.warning('This class have no subject!');
                }
                Generic.loaderStop();
            });
        });

        function getSubject(class_id, $type = 0, cb) {
            var subject_list_url = '{{URL::Route("academic.subject")}}';
            
            let getUrl = subject_list_url + "?class=" + class_id + "&type=" + $type;
            if (class_id) {
                axios.get(getUrl)
                    .then((response) => {
                        cb(response.data);

                    }).catch((error) => {
                        let status = error.response.statusText;
                        toastr.error(status);
                        cb();

                    });
            }
            else {
                cb();
            }
        }
    </script>
@endsection
<!-- END PAGE JS-->
