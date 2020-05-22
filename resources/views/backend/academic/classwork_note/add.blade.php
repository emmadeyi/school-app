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
           <a href="{{URL::route('topic.show', $topic->id)}}">{{$topic->name}}</a> - New Class Note
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('topic.show', $topic->id)}}"><i class="fa fa-cubes"></i> {{$topic->name}}</a></li>
            <li class="active">Add Class Note</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <form novalidate id="entryForm" action="{{URL::Route('classwork_note.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="box-header">
                            <div class="callout callout-danger">
                                <p><b>Note:</b> Create a topic/ module before create new note.</p>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group has-feedback">
                                        <label for="title">Title<span class="text-danger">*</span></label>
                                        <input autofocus type="text" class="form-control" name="title" placeholder="Note Title" value="{{ old('title') }}" required minlength="1" maxlength="255">
                                        <input type="hidden" name="module" value="{{$topic->id}}">
                                        <span class="fa fa-info form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-feedback">
                                        <label for="note">Note Content 
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Enter Note Content Here"></i>
                                        </label>
                                        <textarea id="editor_textarea" name="body" class="form-control" rows="20" required 
                                         > {{ old('body') }}</textarea>
                                        <span class="fa fa-location-arrow form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('body') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-plus-circle"></i> Add Class Note</button>
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
    </script>
@endsection
<!-- END PAGE JS-->
