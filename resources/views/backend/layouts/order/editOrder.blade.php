@extends('backend.master')
@section('title')
  Online Order List
@endsection
@section('header_section')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
@section('content')
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>Invoice</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Aero</a></li>
                            <li class="breadcrumb-item active">Pages</li>
                            <li class="breadcrumb-item active">Invoice</li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <h5><strong>Order ID: </strong> #{{ $order->order_no }}</h5>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <address>
                                            <strong>{{ $order->name }}</strong><br>
                                            {{ $order->email }}<br>
                                            {{ $order->phone }}<br>
                                            {{ $order->address }}<br>
                                        </address>
                                    </div>

                                    <div class="col-md-6 col-sm-6 text-right">
                                        <p class="mb-0"><strong>Order Date: </strong> {{ $order->created_at->translatedFormat('d, F, Y') }}</p>
                                        <p class="mb-0"><strong>Order Status: </strong> <span class="badge badge-success">Success</span></p>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th width="60px">Item Image</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th class="hidden-sm-down">Unit Cost</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_price=0;
                                                @endphp
                                                @foreach ($order_details as $orderItem)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td><img src="{{ asset('backend/uploads/product_main_image') }}/{{ App\Product::find($orderItem->product_id)->value('main_image') }}" width="40" alt="Product img"></td>
                                                        <td>{{ App\Product::find($orderItem->product_id)->value('product_name') }}</td>
                                                        <td>{{ $orderItem->quantity }}</td>
                                                        <td class="hidden-sm-down">৳ {{ $orderItem->price }}</td>
                                                        <td>৳ {{ $orderItem->price * $orderItem->quantity }}</td>
                                                    </tr>
                                                    @php
                                                        $total_price = $total_price + ($orderItem->quantity * $orderItem->price);
                                                    @endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @isset($coupon_name)
                                            <p>Your Coupon Code is {{ $coupon_name->coupon }}</p>
                                            <div >
                                                <p style=" font-size:20px">@isset($coupon_name->product_id)<span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else ৳ {{ $coupon_name->max_amount  }} @endisset </span> Discount in this {{  App\Product::find($coupon_name->product_id)->product_name   }} product @else <span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else ৳ {{ $coupon_name->max_amount  }} @endisset </span> Discount on Total @endisset </p>
                                            </div>
                                        @endisset
                                        <hr>
                                        <h5>Note</h5>
                                        <p>Products once sold can not be replaced or returned. Thanks for being with us.</p>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <ul class="list-unstyled">
                                            <li><strong>Sub-Total:-</strong>৳ {{ $total_price }}</li>
                                        </ul>
                                        <h3 class="mb-0 text-success">৳ {{ $order->amount }}</h3>
                                        <a href="javascript:void(0);" class="btn btn-info"><i class="zmdi zmdi-print"></i></a>
                                            <form action="{{ route('order.update') }}" method="post">
                                            @csrf
                                            <div class="text-right">
                                                <select name="status" id="status" class="form-control show-tick ms select2" width="20">
                                                <option >--Select--</option>
                                                <option value="Confirmed">Confirmed</option>
                                            </select>
                                            @error ('status')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

