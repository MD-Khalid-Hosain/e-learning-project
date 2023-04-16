@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@endsection
@section('role_management_active')
active open
@endsection
@section('assign_role_active')
    active
@endsection
@section('assign_role_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Jquery DataTables</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Normal Tables</li>
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
            <!-- Assign role -->
            @if(auth('admin')->user()->can('assign role'))
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Assign</strong> Role </h2>
                        </div>
                        <div class="body">
                            <form action="{{ route('management.assig.role') }}" method="POST">
                                @csrf
                                <p><b>Select User</b></p>
                                    <select class="form-control show-tick ms select2 mb-3" name="user_id" data-placeholder="Select">
                                        <option></option>
                                        @foreach ($alladmin as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                        @endforeach
                                    </select>
                                    <p><b>Select Role</b></p>
                                    <select class="form-control show-tick ms select2 " name="role_name" data-placeholder="Select">
                                        <option></option>
                                        @foreach ($allRole as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create</strong> User</h2>
                        </div>
                        <div class="body">
                             @if (session('error'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                             @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <form action="{{ route('management.createUser') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                 <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="first_name">Firs Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name"  class="form-control" value="{{ old('first_name') }}">
                                            @error ('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="last_name">Last Name</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name"  class="form-control" value="{{ old('last_name') }}">
                                            @error ('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="email">Admin Email</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" name="email" id="admin_email"  class="form-control" value="{{ old('email') }}">
                                            @error ('email')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_type">Admin Type</label><span class="required">*</span>
                                        <div class="form-group">
                                            <select class="form-control show-tick ms select2 " name="role_name" data-placeholder="Select">
                                                <option></option>
                                                @foreach ($allRole as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error ('role_name')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_mobile">Admin Mobile</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="admin_mobile" name="mobile"  class="form-control" value="{{ old('mobile') }}">
                                            @error ('mobile')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_image">Admin Image</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="file" id="admin_image" name="image"  class="form-control">
                                            @error ('image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_new_pwd">New Password</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="password" id="admin_new_pwd" name="new_pwd" class="form-control" placeholder="Enter New password">
                                            @error ('new_pwd')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="admin_confirm_pwd">Confirm Password</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="password" id="admin_confirm_pwd" name="confirm_pwd" class="form-control" >
                                            <span id="adminShowError"></span>
                                            @error ('confirm_pwd')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>User</strong> Details </h2>
                        </div>
                        <div class="body">
                            @if (session('deletesuccess'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('deletesuccess') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                             @endif
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL.</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Permission</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                         @foreach ($alladmin as $admin)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td><img src="{{ asset('backend/uploads/admin/'.$admin->image) }}" alt="{{ $admin->name }}" width="70"></td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->type }}</td>
                                            <td>{{ $admin->mobile }}</td>
                                            <td>
                                                @foreach ($admin->getRoleNames()  as $role)
                                                    {{ $role }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($admin->getAllPermissions() as $permission)
                                                    <li>{{ $permission->name }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                 @if ($admin->status == 1)
                                                    <a class="adminStatus" id="admin-{{ $admin->id }}" admin_id="{{ $admin->id  }}" href="javascript:void(0)" style="color:green">Active</a>
                                                    @else
                                                    <a class="adminStatus" id="admin-{{ $admin->id  }}" admin_id="{{ $admin->id  }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>{{ $admin->created_at }}</td>
                                            <td>
                                                <a href="{{ url('role/edit') }}/{{ $admin->id }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm confirmDeleteAdmin"  recordid="{{route('management.deleteUser', $admin->id) }}"><i class="zmdi zmdi-delete"></i></a>

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
    <input type="hidden" id="updateAdminStatus" value="{{ route('update-admin-status') }}">
@endsection

@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
