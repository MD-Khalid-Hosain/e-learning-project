@extends('backend.master')
@section('header_section')
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/others.css') }}">

@endsection

@section('title')
  Product Details
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Product Details</h2>
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
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-md-12">
                                    <div class="preview preview-pic tab-content">
                                        <div class="tab-pane active" id="main_image{{ $productDetails['id'] }}"><img src="{{ asset('backend/uploads/product_main_image') }}/{{ $productDetails['main_image'] }}" class="img-fluid" alt="" /></div>
                                        @php
                                            $flag=0;
                                        @endphp
                                        @foreach ($multiple_images as $item)
                                        <div class="tab-pane" id="multiple{{ $flag }}"><img src="{{ asset('backend/uploads/product/'.$item) }}" class="img-fluid" alt=""/></div>
                                        @php
                                            $flag++;
                                        @endphp
                                        @endforeach
                                    </div>
                                    <ul class="preview thumbnail nav nav-tabs">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#main_image{{ $productDetails['id']  }}"><img src="{{ asset('backend/uploads/product_main_image') }}/{{ $productDetails['main_image'] }}" alt=""/></a></li>
                                        @php
                                            $flag = 0;
                                        @endphp
                                        @foreach ($multiple_images as $item)
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#multiple{{ $flag }}"><img src="{{ asset('backend/uploads/product/'.$item) }}" alt=""/></a></li>
                                        @php
                                            $flag++;
                                        @endphp
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-xl-9 col-lg-8 col-md-12">
                                    <div class="product details">
                                        <h3 class="product-title mb-0">{{ $productDetails['product_name'] }}</h3>
                                        <h5 class="price mt-0">Current Price: <span class="col-amber">${{ $productDetails['price'] }}</span></h5>
                                        <hr>
                                        <p class="product-description">
                                            <table>
                                                @foreach ($productDetails['product_fetures'] as $features)
                                                <tr>
                                                    <td>{{ $features['fetures'] }}</td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </p>
                                        <p class="vote"><h5 class="font-weight-bold">Fetures</h5>
                                            <ul>
                                                @foreach ($productDetails['product_fetures'] as $feture)
                                                <li>
                                                    <td>{{ $feture['fetures'] }}</td>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#specification">Specification</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#description">Description</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="specification">
                                   <div class="table-responsive">
                                       @foreach ($specification_header as $headerTitle)
                                            <table class="data-table" cellspacing="0" cellpadding="0">
                                                <colgroup>
                                                    <col class="name">
                                                    <col class="value">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <td class="heading-row" colspan="3">{{ $headerTitle->header }}</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     @foreach ( App\TitleDescOfSpecification::where('header_id',$headerTitle->id)->where('product_id',$headerTitle->product_id)->get() as $specification)
                                                        <tr>
                                                            <td class="name">{{ $specification->title }}</td>
                                                            <td class="value">{!! $specification->description  !!}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane" id="description">
                                    {!! $productDetails['product_description'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
