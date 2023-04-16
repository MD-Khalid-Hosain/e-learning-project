@extends('backend.master')
@section('header_section')
<!-- Multi Select Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/multi-select/css/multi-select.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/dist/summernote.css') }}"/>
@endsection
@section('banner_section_active')
active open
@endsection
@section('banner_active')
    active
@endsection
@section('banner_toggled')
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Create Slider</strong> Banner</h2>
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
                            <form action="{{ route('banner-slider-create') }}" method="POST" enctype="multipart/form-data" id="updatPwdForm">
                                @csrf
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <label for="slider_image">Slider Image</label><span class="required">*</span>
                                        <div class="form-group">
                                            <input type="file" id="slider_image" name="slider_image"  class="form-control">
                                            @error ('slider_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <label for="slider_link">Slider Link</label>
                                        <div class="form-group">
                                            <input type="text" id="slider_link"  name="slider_link" class="form-control" placeholder="Enter Slider link">
                                            @error ('slider_link')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <label for="alt">Slider alt value</label>
                                        <div class="form-group">
                                            <input type="text" id="alt"  name="alt" class="form-control" placeholder="Enter Slider Alt Tag">
                                            @error ('alt')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="description">Details</label>
                                        <div class="form-group">
                                                <textarea name="details"  class="form-control summernote"  rows="9">{{ old('details') }}</textarea>
                                            @error ('details')
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Slider Image</strong> List</h2>
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
                                            <th scope="col">Slider Image</th>
                                            <th scope="col">View Image</th>
                                            <th scope="col">Slider Link</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                         @foreach ($allSliders as $slider)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td><img src="{{ asset('backend/uploads/banners/slider/'.$slider->slider_image) }}" alt="banner" width="100"></td>
                                            <td><a href="{{ asset('backend/uploads/banners/slider/'.$slider->slider_image) }}" target="_blank" class="btn btn-primary btn-sm"><i class="zmdi zmdi-eye"></i></a></td>
                                            <td><a href="{{ $slider->slider_link }}">Slider link</a></td>

                                            <td>{{ $slider->created_at }}</td>
                                            <td>
                                                <a href="{{ route('banner-slider-edit',$slider->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm sliderConfirmDelete"  recordid="{{ route('banner-slider-delete',$slider->id) }}"><i class="zmdi zmdi-delete"></i></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Right Side Image</strong> List</h2>
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
                                            <th scope="col">Right Side Image</th>
                                            <th scope="col">View Image</th>
                                            <th scope="col">Image Link</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                         @foreach ($rightSideImages as $rightSide)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td><img src="{{ asset('backend/uploads/banners/rightSideImage/'.$rightSide->right_image) }}" alt="banner" width="100"></td>
                                            <td><a href="{{ asset('backend/uploads/banners/rightSideImage/'.$rightSide->right_image) }}" target="_blank" class="btn btn-primary btn-sm"><i class="zmdi zmdi-eye"></i></a></td>
                                            <td><a href="{{ $rightSide->right_side_link }}">Banner link</a></td>

                                            <td>{{ $rightSide->created_at }}</td>
                                            <td>
                                               <a href="{{ route('banner-rightSide-edit',$rightSide->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm rightSideConfirmDelete"  recordid="{{ route('banner-rightSide-delete',$rightSide->id) }}"><i class="zmdi zmdi-delete"></i></a>
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
    <script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
    <script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/summernote/dist/summernote.js') }}"></script>
    <script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>
@endsection
