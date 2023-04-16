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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->

    <!--======================
    Shopping Cart area Start
    ==========================-->
    <div class="cart-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" >
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" >
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                     <div style="text-align: center">
                         <p > <span style="background-color: yellow;">নির্দিষ্ট মডেল এর প্রসেসর, মাদারবোর্ড, গ্রাফিক্স কার্ড, র‍্যাম ও মনিটর স্টক সীমিত থাকায় সিংগেল প্রোডাক্ট অনলাইন ডেলিভারি দেয়া সম্ভব নাও হতে পারে।</span></p>

                    <p>বর্তমানে করোনা সংক্রমণ রোধে ঢাকা শহরে হোম ডেলিভারি এর ক্ষেত্রে বিল্ডিং এর ভেতরে নির্দিষ্ট ফ্ল্যাট এ গিয়ে ডেলিভারি সাময়িক বন্ধ রাখা হয়েছে। ক্রেতাকে বিল্ডিং এর মেইন গেট থেকে পণ্য রিসিভ করতে হবে।</p>
                    </p>
                     </div>

                    <form action="{{ route('update.cart.item') }}" class="cart-form" method="POST">
                        @csrf
                        <!-- Cart Title Start -->
                        <div class="cart-title">
                            <h5 class="last-title mt-50 mb-20">Shopping Cart</h5>
                        </div>
                        @isset($coupon_name)
                        <div style="text-align: center;">
                            <p style=" font-size:20px">@isset($product_id)<span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($discount_percentage) {{ $discount_percentage }} % @else ৳ {{ $discount_max_amount }} @endisset </span> Discount in this {{ App\Product::find($product_id)->product_name }} product @else
                                <span style="color:red; font-weight:bold">Congratulations !!</span> You got <span style="font-weight: bold; color:red;"> @isset($discount_percentage) {{ $discount_percentage }} % @else ৳ {{ $discount_max_amount  }} @endisset </span> Discount on Total
                            @endisset </p>
                        </div>
                        @endisset

                        <!-- Cart Title End -->
                        <!-- Cart Table Area Start -->
                        <div class="table-desc">
                            <div class="cart-page table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-image">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-price">Total</th>
                                            @isset($product_id)
                                                <th class="product-price">After Discount</th>
                                            @endisset
                                            <th class="product-remove">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (cart_all_product() as $item)
                                          <tr>
                                              <input type="hidden" name="cart_id[]" value="{{ $item->id }}">
                                                <td class="product-image"><a href="{{ route('product-details',$item->product->slug) }}"><img src="{{ asset('backend/uploads/product_main_image/'.$item->product->main_image) }}" alt="{{ $item->product->product_name }}" width="100"></a></td>
                                                <td class="product-name"><a href="{{ route('product-details',$item->product->slug) }}">{{ $item->product->product_name }}</a></td>
                                                @if ($item->emi != null)
                                                <td class="product-price">৳ {{ $item->product->regular_price }}</td>
                                                @else
                                                <td class="product-price">৳ {{ $item->product->price }}</td>
                                                @endif
                                                <td class="product-quantity">
                                                    <div class="product-quantity " >
                                                        <span class="qty-btn minus updateCartItems qntyMinus" data-cartid="{{ $item->id }}"><i class="fa fa-angle-down"></i></span>
                                                            <input type="text" min="1" max="100" id="updateCartValue" name="product_quantity[]" value="{{ $item->product_quantity }}">
                                                        <span class="qty-btn plus updateCartItems qntyPlus" data-cartid="{{ $item->id }}"><i class="fa fa-angle-up"></i></span>
                                                    </div>
                                                    {{-- <label>Quantity</label> <input min="1" max="100" name="product_quantity[]" value="{{ $item->product_quantity }}" type="number"> --}}
                                                </td>
                                                @if ($item->emi != null)
                                                <td class="product-price">৳ {{ $item->product->regular_price * $item->product_quantity }}</td>
                                                @else
                                                <td class="product-price">৳ {{ $item->product->price * $item->product_quantity }}</td>
                                                @endif
                                                 @isset($product_id)
                                                    <td class="product-price"><span class="amount">@if($product_id == $item->product_id) ৳ {{ $total}} @else {{ "N/A" }}  @endif</span></td>
                                                @endisset
                                                <td class="product-remove"><a href="{{ route('delete.cart.item',$item->id) }}"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-submit">
                                <a href="{{ url('/') }}">Continue Shopping</a>
                                <button type="submit">update cart</button>
                            </div>

                    </form>

                        </div>
                        <!-- Cart Table Area End -->
                        <!-- Coupon Area Start -->
                        <div class="coupon-area">
                            <div class="row">

                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code left">
                                        <h3>Coupon</h3>
                                        <div class="coupon-inner">
                                            <p>Enter your coupon code if you have one.</p>
                                            <input placeholder="Coupon code" type="text" id="coupon_name">
                                            <button  id="applyCoupon">Apply coupon</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="coupon-code right">
                                        <h3>Cart Totals</h3>
                                        <div class="coupon-inner">
                                            <div class="cart-subtotal">
                                                <p>Subtotal</p>
                                                <p class="cart-amount">৳ {{ number_format(cart_subtotal()) }}</p>
                                            </div>
                                            <div class="cart-subtotal">
                                                @isset($product_id)
                                                        <p>Discount</p>
                                                            <p class="cart-amount">
                                                                @isset($discount_max_amount)
                                                                 @php
                                                                    $discount= $discount_max_amount;
                                                                @endphp
                                                                    ৳ {{ $discount_max_amount }}
                                                                @else
                                                                 @php
                                                                    $discount= $discount_percentage;
                                                                @endphp
                                                                    {{ $discount_percentage }} %
                                                                @endisset
                                                            </p>
                                                    @else
                                                    @endisset
                                                    @isset($discount_by_total)
                                                    <p>Discount</p>
                                                        <p class="cart-amount">
                                                            @isset($discount_max_amount)
                                                                @php
                                                                    $discount= $discount_max_amount;
                                                                @endphp
                                                                ৳ {{ $discount_max_amount }}
                                                            @else
                                                                @php
                                                                    $discount= $discount_percentage;
                                                                @endphp
                                                                {{ $discount_percentage }} %
                                                            @endisset
                                                        </p>
                                                    @else
                                                @endisset
                                            </div>
                                            <div class="cart-subtotal">
                                                <p>Total</p>
                                                <p class="cart-amount">
                                                    @isset($product_id)
                                                            @php
                                                                $total_without_discount = 0;
                                                                $total_from_cart =0;
                                                            @endphp
                                                            @foreach (cart_all_product() as $grand_total)
                                                                @if ($product_id !=$grand_total->product_id)
                                                                @php
                                                                    $total_without_discount = $total_without_discount +(($grand_total->product)->price * $grand_total->product_quantity);
                                                                @endphp
                                                                @endif
                                                            @endforeach
                                                                ৳ {{ $total_from_cart =$total_without_discount + $total }}
                                                        @else
                                                            @isset($discount_by_total)
                                                                ৳ {{ $total_from_cart = $discount_by_total }}
                                                            @else
                                                                ৳ {{ $total_from_cart = cart_subtotal() }}
                                                            @endisset
                                                    @endisset
                                                </p>
                                            </div>
                                            <form action="{{ route('checkout') }}" method="post">
                                            @csrf
                                                <div class="checkout-btn">
                                                <input type="hidden" name="discount" value="{{ $discount ?? "" }}">
                                                <input type="hidden" name="coupon_name_from_cart" value="{{ $coupon_name ?? "" }}">
                                                <input type="hidden" name="total_from_cart" value="{{ $total_from_cart }}">
                                                <button>Proceed to Checkout</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Coupon Area End -->
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Shopping Cart area End
    ==========================-->
    <input type="hidden" id="couponLink" value="{{ url('/cart/view') }}">
@endsection

