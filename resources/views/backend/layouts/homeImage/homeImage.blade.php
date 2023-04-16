@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@endsection
@section('banner_section_active')
active open
@endsection
@section('homeImage_active')
    active
@endsection
@section('homeImage_toggled')
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
            @if (count($allImages) == 24)
            @else
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create Home Images</strong></h2>
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
                            <form action="{{ route('home-image-create') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="home_image">Home Image</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="file" id="home_image" name="home_image"  class="form-control">
                                            @error ('home_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="image_link">Image Type</label><span class="required">*</span>
                                        <div class="form-group">
                                            <select name="type" id="type" class="form-control">
                                                <option >Select Type</option>
                                                <option value="Small">Small</option>
                                                <option value="Big">Big</option>
                                            </select>
                                            @error ('type')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="image_alter">Image Alter Tag</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="image_alter"  name="image_alter" class="form-control" placeholder="Enter Image Alter Tag">
                                            @error ('image_alter')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <label for="image_link">Image Link</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="text" id="image_link"  name="image_link" class="form-control" placeholder="Enter banner link">
                                            @error ('image_link')
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
            @endif

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Home Images</strong> List</h2>
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
                                            <th scope="col">Home Image</th>
                                            <th scope="col">View Image</th>
                                            <th scope="col">Image Link</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                         @foreach ($allImages as $image)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td><img src="{{ asset('backend/uploads/homeImage/'.$image->home_image) }}" alt="banner" width="100"></td>
                                            <td><a href="{{ asset('backend/uploads/homeImage/'.$image->home_image) }}" target="_blank" class="btn btn-primary btn-sm"><i class="zmdi zmdi-eye"></i></a></td>
                                            <td><a href="{{ $image->image_link }}" target="_blank">Image link</a></td>
                                            <td>{{ $image->type }} @if ( $image->type == "Small")
                                                (277x350)
                                            @else
                                                (590x350)
                                            @endif</td>
                                            <td>
                                                @if ($image->status == 1)
                                                    <a class="updateHomeImageStatus" id="homeImage-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0)" style="color:green">Active</a>
                                                    @else
                                                    <a class="updateHomeImageStatus" id="homeImage-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0)" style="color:red">Inactive</a>
                                                @endif
                                            </td>
                                            <td>{{ $image->created_at }}</td>
                                            <td>
                                                <a href="{{ route('homeImage-edit',$image->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                {{-- <a href="javascript:void(0)" class="btn btn-danger btn-sm sliderConfirmDelete"  recordid=""><i class="zmdi zmdi-delete"></i></a> --}}

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
    <input type="hidden" id="updateHomeImageStatus" value="{{ route('update-homeImage-status') }}">
@endsection

@section('footer_section')
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
