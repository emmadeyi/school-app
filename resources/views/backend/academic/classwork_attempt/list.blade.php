<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Student @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass') @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
        <h1>
            Classwork Attempt
            <small>List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa fa-dashboard"></i> Classwork</a></li>
            <li class="active">Classwork</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                       {{-- @if(AppHelper::getInstituteCategory() == 'college')
                        <div class="col-md-3">
                        <div class="form-group has-feedback">
                                {!! Form::select('academic_year', $academic_years, $acYear , ['placeholder' => 'Pick a year...','class' => 'form-control select2', 'required' => 'true']) !!}
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3">
                        <div class="form-group has-feedback">
                                {!! Form::select('class_id', $classes, $iclass , ['placeholder' => 'Pick a class...','class' => 'form-control select2', 'required' => 'true']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback">
                                {!! Form::select('section_id', $sections, $section_id , ['placeholder' => 'Pick a section...','class' => 'form-control select2', 'id' => 'student_list_filter', 'required' => 'true']) !!}
                            </div>
                        </div>
                        <div class="box-tools pull-right">
                            <a class="btn btn-info btn-sm" href="{{ URL::route('student.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                        </div> --}}

                        <p><b>Class:</b> {{$classwork->class->name}}</p>
                        <p><b>Subject:</b> {{$classwork->subject->name}}</p>
                        <p><b>Teacher:</b> {{$classwork->teacher->name}}</p>
                        <p><b>Module/ Topic:</b> {{$classwork->topic->name}}</p>
                        <p><b>Classwork:</b> {{$classwork->title}}</p>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th >Student Name</th>
                                <th >Phone No</th>
                                <th >Email</th>
                                <th width="10%">Status</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($classwork->attempt->keyBy('user_id') as $attempt)
                                <tr>
                                    <td>
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $attempt->user->name }}</td>
                                    <td>{{ $attempt->user->phone_no }}</td>
                                    <td>{{ $attempt->user->email }}</td>
                                    <td>
                                        <!-- todo: have problem in mobile device -->
                                        <input class="statusChange" type="checkbox" data-pk="{{$attempt->id}}" @if($attempt->status) checked @endif data-toggle="toggle" data-on="<i class='fa fa-check-circle'></i>" data-off="<i class='fa fa-ban'></i>" data-onstyle="success" data-offstyle="danger">
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a title="Grade this attempt"  href="{{URL::route('classwork_attempt.edit', [$classwork->id, $attempt->user->id])}}"  class="btn btn-primary btn-sm"><i class="fa fa-check"></i>
                                            </a>
                                        </div>
                                        <div class="btn-group">
                                            <a title="Edit" href="{{URL::route('student.edit',$attempt->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </a>
                                        </div>
                                        <!-- todo: have problem in mobile device -->
                                        <div class="btn-group">
                                            <form  class="myAction" method="POST" action="{{URL::route('student.destroy', $attempt->id)}}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="5%">#</th>
                                <th >Student Name</th>
                                <th >Phone No</th>
                                <th >Email</th>
                                <th width="10%">Status</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    </div>
                    <!-- /.box-body -->
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
            window.postUrl = '{{URL::Route("student.status", 0)}}';
            window.section_list_url = '{{URL::Route("academic.section")}}';
            window.changeExportColumnIndex = 7;
            window.excludeFilterComlumns = [0,1,8,9];
           Academic.studentInit();
           $('title').text($('title').text() + '-' + $('select[name="class_id"] option[selected]').text() + '(' + $('select[name="section_id"] option[selected]').text() +')');
        });
    </script>
@endsection
<!-- END PAGE JS-->
