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
            Classwork Activities
            <small>Topics</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::route('classwork.index')}}"><i class="fa fa-dashboard"></i> Classwork</a></li>
            <li class="active">Topics</li>
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
                        @can('topic.create')
                        <a class="btn btn-info btn-sm" href="{{ URL::route('topic.create') }}"><i class="fa fa-plus-circle"></i> Add Topic</a>
                        @endcan
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                        <table id="listDataTableWithSearch" class="table table-bordered table-striped list_view_table display responsive no-wrap" width="100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th >Topic</th>
                                <th >Subject</th>
                                <th >Class</th>
                                <th >Teacher</th>
                                <th class="notexport" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $sn = 1; ?>
                            @foreach($topics as $topicBySubject)
                                @foreach($topicBySubject as $topic)
                                <tr>
                                    <td>
                                        {{$sn}}
                                    </td>
                                    <td>{{ $topic->name }}</td>
                                    <td>{{ $topic->subject->name }}</td>
                                    <td>{{ $topic->class->name }}</td>
                                    <td>{{ $topic->teacher->name }}</td>
                                    <td>

                                        @can('topic.show')
                                        <div class="btn-group">
                                            <a title="Open Activity"  href="{{URL::route('topic.show', $topic->id)}}"  class="btn btn-primary btn-sm"><i class="fa fa-folder-open"></i>
                                            </a>
                                        </div>
                                        @endcan
                                        @can('topic.update')
                                        <div class="btn-group">
                                            <a title="Edit Activity" href="{{URL::route('topic.edit',$topic->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            </a>
                                        </div>
                                        @endcan
                                        <!-- todo: have problem in mobile device -->

                                        @can('topic.destroy')
                                        <div class="btn-group">
                                            <form  class="myAction" method="POST" action="{{URL::route('topic.destroy', $topic->id)}}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Activity">
                                                    <i class="fa fa-fw fa-trash"></i>
                                                </button>
                                            </form>
                                        </div> 
                                        @endcan
                                    </td>
                                </tr>
                                <?php $sn++; ?>
                                @endforeach
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>
                                <th width="5%">#</th>
                                <th >Topic</th>
                                <th >Subject</th>
                                <th >Class</th>
                                <th >Teacher</th>
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
