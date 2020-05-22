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
           <a href="{{URL::route('topic.show', $note->topic->id)}}">{{$note->topic->name}}</a> - {{$note->title}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('topic.show', $note->topic->id)}}"><i class="fa fa-cubes"></i> {{$note->topic->name}}</a></li>
            <li class="active">{{$note->title}}</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <div class="callout callout-info">
                            <p><b>Note:</b> Modifying created note.</p>
                                                                    
                            @can('classwork_note.destroy')
                                <form class="myAction" method="POST" action="{{URL::route('classwork_note.destroy', $note->id)}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}                                                          
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                        <i class="fa fa-fw fa-trash"></i> Delete Class note
                                    </button>
                                </form>
                            @endcan  
                        </div>
                    </div>
                    <form novalidate id="entryForm" action="{{URL::Route('classwork_note.update', $note->id)}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group has-feedback">
                                        <label for="title">Title<span class="text-danger">*</span></label>
                                        <input autofocus type="text" class="form-control" name="title" placeholder="Note Title" value="{{ old('title', $note->title) }}" required minlength="1" maxlength="255">
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
                                         > {{ old('body', $note->body) }}</textarea>
                                        <span class="fa fa-location-arrow form-control-feedback"></span>
                                        <span class="text-danger">{{ $errors->first('body') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-check-square"></i> Update Note</button>
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
        });


    </script>
@endsection
<!-- END PAGE JS-->
