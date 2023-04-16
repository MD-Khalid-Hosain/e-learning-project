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

                <div class="col-lg-5 col-md-6 col-sm-12">

                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ $title }}</strong></h2>
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
                            <form name="productForm" id="productForm" action="{{ url('admin/update-Item-parts') }}"  method="POST">
                                @csrf
                                <input type="hidden" name="item_parts_id" value="{{ $itemParts->id }}">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="category_id">Select Category</label><span class="required">*</span>
                                        <select name="category_id" id="category_id" class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option value="">---Select Category---</option>
                                            @foreach ($categories as $sections)
                                                <option class="font-weight-bold" disabled>{{ $sections->section_name }}</option>
                                                @foreach ($sections->categories as $category)
                                                    <option class="pl-3" value="{{ $category->id }}" >--&nbsp;{{ $category->category_name }}</option>
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
                                           <input type="text" name="item_parts_variant" class="form-control" id="item_parts_variant" value="{{ $itemParts->item_parts_variant }}" >
                                           @error ('item_parts_variant')
                                            <small class="text-danger">{{ $message }}</small>
                                           @enderror
                                       </div>
                                   </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Update</button>
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
