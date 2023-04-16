@extends('backend.master')
@section('role_management_active')
active open
@endsection
@section('role_create_active')
    active
@endsection
@section('role_create_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Stater Page</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                        <li class="breadcrumb-item active">Stater Page</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create</strong> Role </h2>
                        </div>
                        @if (session('created_succcess'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('created_succcess') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                        @if ($errors->all())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="body">
                            <form action="{{ route('management.index') }}" method="POST">
                                @csrf
                                <label for="role_name">Role Name</label>
                                <div class="form-group">
                                    <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter Role Name">
                                </div>
                                <div class="checkbox">
                                    <input id="select_all" type="checkbox">
                                    <label for="select_all">Select All</label>
                                </div>
                                @foreach ($allPermission as $permission)
                                <div class="checkbox">
                                    <input id="item1{{ $permission->id }}" class="checkbox" name="permission[]" type="checkbox" value="{{ $permission->name}}">
                                    <label for="item1{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                                @endforeach
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Role</strong> Details </h2>
                        </div>
                        <div class="body">
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <th scope="col">SL.</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allRole as $role)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->getPermissionNames()  as $permission)
                                                <li>{{ $permission }}</li>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm RoleconfirmDelete"  recordid="{{ route('role.delete',$role->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
@endsection

@section('footer_section')
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
<script>
       //select all checkboxes
        $("#select_all").change(function(){  //"select all" change
            $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
        });

        //".checkbox" change
        $('.checkbox').change(function(){
            //uncheck "select all", if one of the listed checkbox item is unchecked
            if(false == $(this).prop("checked")){ //if this item is unchecked
                $("#select_all").prop('checked', false); //change "select all" checked status to false
            }
            //check "select all" if all checkbox items are checked
            if ($('.checkbox:checked').length == $('.checkbox').length ){
                $("#select_all").prop('checked', true);
            }
        });
</script>
@endsection

