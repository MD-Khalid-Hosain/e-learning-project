@extends('backend.master')
@section('title')
  Course List
@endsection

@section('course_active')
    active
@endsection
@section('course_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Course List</h2>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Course</strong> List </h2>
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            @if (session('error_message'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error_message') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <a href="{{ route('course.create') }}" class="btn btn-labeled btn-info float-right my-3">
                            <span class="btn-label"><i class="zmdi zmdi-plus font-weight-bold pr-2"></i></span>Add Course</a>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Course Title</th>
                                            <th>Language</th>
                                            <th>Level</th>
                                            <th>Category</th>
                                            <th>Total Enrolled</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allCourse as $course)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{$course->language}}</td>
                                            <td>{{$course->level}}</td>
                                            <td>{{App\CourseCategory::where('id',$course->category_id)->value('category_name')}}</td>
                                            <td>{{App\CourseEnroll::where('course_id', $course->id)->count()}}</td>
                                            <td>
                                                <a href="{{route('show-all-course-lesson', $course->id)}}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-plus"></i></a>
                                                <a href="{{route('course.edit', $course->id)}}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <form class="d-inline" action="{{ route('course.destroy',$course->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm show_confirm"  data-toggle="tooltip" title='Delete'><i class="zmdi zmdi-delete"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_section')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
    <!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/assets/bundles/datatablescripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/tables/jquery-datatable.js') }}"></script>
    <script>
        $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
