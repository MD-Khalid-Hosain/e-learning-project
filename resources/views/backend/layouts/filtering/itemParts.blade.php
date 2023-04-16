@extends('backend.master')
@section('header_section')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

@endsection
@section('title')
  Item Parts List
@endsection

@section('product_settings_active')
active open
@endsection
@section('item_parts_active')
    active
@endsection
@section('item_parts_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
      <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Catalogues</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Examples</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                  <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Item Parts List</strong></h2>
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
                             @if (session('status'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('status') }}</strong>
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover  dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Section</th>
                                            <th>Category Name</th>
                                            <th>Sub Category</th>
                                            <th>Item Type</th>
                                            <th>Item Variant</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allParts as $itemParts)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ App\Section::where('id', $itemParts->category->section_id)->value('section_name') }}</td>
                                            <td>{{ App\Category::where('id',$itemParts->category->parent_id)->value('category_name') }}</td>
                                            <td>{{ $itemParts->category->category_name }}</td>
                                            <td>{{ $itemParts->itemtype->item_type_name }}</td>
                                            <td>{{ $itemParts->item_parts_variant}}</td>
                                            <td>
                                                <a href="{{ url('admin/edit-itemParts/'.$itemParts->id) }}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-danger btn-sm itemPartsconfirmDelete"  recordid="{{route('itemParts.delete',$itemParts->id)  }}"><i class="zmdi zmdi-delete"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ $title }}</strong></h2>
                        </div>
                        <div class="body">
                            <form name="productForm" id="productForm" action="{{ url('admin/add-productItem-parts') }}"  method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option >---Select Category---</option>
                                            @foreach ($categories as $sections)
                                                <option class="font-weight-bold" disabled>{{ $sections->section_name }}</option>
                                                @foreach ($sections->categories as $category)
                                                    <option class="pl-3" value="{{ $category->id }}">--&nbsp;{{ $category->category_name }}</option>
                                                    @foreach ($category->subcategories as $subcategory)
                                                         <option class="pl-5" value="{{ $subcategory->id }}">&nbsp;&nbsp;-&nbsp;{{ $subcategory->category_name }}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error ('category_id')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-5">
                                         <label for="item_type_list">Select Item Type</label><span class="required">*</span>
                                       <select name="item_type_id" id="item_type_list" class="form-control show-tick ms select2" data-placeholder="Select">
                                           <option value="">Select</option>
                                       </select>
                                       @error ('item_type_id')
                                           <small class="text-danger">{{ $message }}</small>
                                       @enderror
                                    </div>
                                    <div class="col-md-12 mt-5">
                                       <label for="item_parts_variant">Item Parts Variant</label><span class="required">*</span>
                                       <div class="form-group">
                                           <input type="text" name="item_parts_variant" class="form-control" id="item_parts_variant" value="{{ old('item_variant') }}" >
                                           @error ('item_parts_variant')
                                            <small class="text-danger">{{ $message }}</small>
                                           @enderror
                                       </div>
                                   </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="getItemType" value="{{ route('getItem.type') }}">
@endsection
@section('footer_section')
<script src="{{ asset('backend/assets/plugins/select2/select2.min.js') }}"></script> <!-- Select2 Js -->
<script src="{{ asset('backend/assets/js/pages/forms/advanced-form-elements.js') }}"></script>
<script src="{{ asset('backend/assets/admin_js/admin_script.js') }}"></script>

<script src="{{ asset('backend/assets/js/pages/forms/editors.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/ckeditor/ckeditor.js') }}"></script> <!-- Ckeditor -->
<script src="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script> <!-- Bootstrap Tags Input Plugin Js -->
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
    $(document).ready(function(){
        //item type append with category
        $('#category_id').change(function(){
            var category_id = $(this).val();
            var getItemType = $('#getItemType').val();

            //ajax setup
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //ajax setup end

            $.ajax({
                type:'POST',
                url:getItemType,
                data:{category_id:category_id},
                success:function(data){
                    $('#item_type_list').html(data);
                }
            });
        });
    });
</script>
@endsection
