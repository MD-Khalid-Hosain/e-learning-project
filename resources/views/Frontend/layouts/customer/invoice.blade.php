@extends('Frontend.master')
@section('content')
<!--=====================
    Breadcrumb Aera Start
    =========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <h1><a href="{{ url('/') }}">Home</a></h1>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>My Account</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->
 <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding mt-3">
     <div class="card">
         <div class="card-header p-4">
             <a class="pt-2 d-inline-block" href="{{ route('frontend.home') }}" data-abc="true">www.originalstorebd.com</a><a class="btn btn-secondary ml-4" href="{{ route('pdf.download',$order_no->id) }}">Download</a>
             <div class="float-right">
                 <h5 class="mb-0">Order ID #{{ $order_no->transaction_id }}</h5>
                 Date: {{ $order_no->created_at->translatedFormat('d, F, Y') }}
             </div>
         </div>
         <div class="card-body">
             <div class="row mb-2">
                 <div class="col-sm-4 ">
                     <h6 class="mb-2">From:</h6>
                     <h5 class="text-dark mb-1">Orginal Store Ltd.</h5>
                     <div>44, Siddiqui Plaza, (1st Floor)</div> <div>New Elephent Road Dhaka-1205</div>
                     <div>Email: a.k.azad@originalstorebd.com</div>
                     <div>Phone: 0173 9438877</div>
                 </div>
                 <div class="col-sm-4">
                     <h6 class="mb-2">Delivery Address</h6>
                     <div>{{ $order_no->delivery_address }}</div>
                 </div>
                 <div class="col-sm-4 ">
                     <h6 class="mb-2">Billing Address</h6>
                     <h5 class="text-dark mb-1">{{ $order_no->name }}</h5>
                     <div>Email: {{ $order_no->email }}</div>
                     <div>Phone: {{ $order_no->phone }}</div>
                     <div>{{ $order_no->billing_address }}</div>
                 </div>
             </div>
             <div class="table-responsive-sm">
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th class="center">#</th>
                             <th>Product</th>
                             <th class="right">Price</th>
                             <th class="center">Qty</th>
                             <th class="right">Total</th>
                         </tr>
                     </thead>
                     <tbody>
                         @php
                             $total_price=0;
                         @endphp
                         @foreach ($order_details as $order_item)
                         <tr>
                            <td class="center">{{ $loop->index + 1 }}</td>
                            <td class="left strong">{{ App\Product::where('id', $order_item->product_id)->value('product_name') }}</td>
                            <td class="right">৳ {{ $order_item->price }}</td>
                            <td class="center">{{ $order_item->quantity }}</td>
                            <td class="right">৳ {{ $order_item->quantity * $order_item->price  }}</td>
                        </tr>
                        @php
                            $total_price = $total_price + ($order_item->quantity * $order_item->price);
                        @endphp
                         @endforeach
                     </tbody>
                 </table>
             </div>
             <div class="row">
                 <div class="col-lg-4 col-sm-5">
                    @isset($coupon_name)
                    <p>Your Coupon Code is {{ $coupon_name->coupon }}</p>
                    <div >
                         <p style=" font-size:20px">@isset($coupon_name->product_id)<span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else ৳ {{ $coupon_name->max_amount  }} @endisset </span> Discount in this {{  App\Product::find($coupon_name->product_id)->product_name   }} product @else <span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($coupon_name->percentage) {{ $coupon_name->percentage }} % @else ৳ {{ $coupon_name->max_amount  }} @endisset </span> Discount on Total @endisset </p>
                    </div>
                    @endisset
                 </div>
                 <div class="col-lg-4 col-sm-5 ml-auto">
                     <table class="table table-clear">
                         <tbody>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Subtotal</strong>
                                 </td>
                                 <td class="right">৳ {{ $total_price }}</td>
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Delivery Charge</strong>
                                 </td>
                                 @if ($order_no->city == 'in_side_dhaka')
                                     <td class="right">৳ 100</td>
                                 @else
                                    <td class="right">৳ 200</td>
                                 @endif
                             </tr>
                             <tr>
                                 <td class="left">
                                     <strong class="text-dark">Total</strong> </td>
                                 <td class="right">
                                     <strong class="text-dark">৳ {{ $order_no->amount }}</strong>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
         <div class="card-footer bg-white">
             <p class="mb-0">**Products once sold can not be replaced or returned. Thanks for being with us.</p>
         </div>
     </div>
 </div>
@endsection
