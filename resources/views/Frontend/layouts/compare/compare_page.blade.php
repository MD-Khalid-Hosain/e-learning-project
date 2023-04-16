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
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Compare</li>
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
    Compare area Start
    ==========================-->
    <div class="compare-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-6">
                        <!-- Compare Title Start -->
                        <div class="cart-title">
                            <h5 class="last-title mt-45 mb-20">Compare</h5>
                        </div>
                        <!-- Compare Title End -->

                        <!-- Compare Table Area Start -->
                        <div class="compare-table">
                            <div class="table table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="first-column">Product Image</td>
                                            <td class="product-image-title">
                                                <a href="#" class="image"><img src="{{ asset('frontend/assets/images/feature/feature-4.jpg') }}" alt="Compare Product"></a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Product Name</td>
                                            <td class="product-image-title">
                                                <a href="#" class="category">Headphone</a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Description</td>
                                            <td class="pro-desc">
                                                <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend ..</p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Price</td>
                                            <td class="pro-price">$295</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Color</td>
                                            <td class="pro-color">Black</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Stock</td>
                                            <td class="pro-stock">In Stock</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Rating</td>
                                            <td class="pro-ratting">
                                                <div class="rating">
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Add to cart</td>
                                            <td class="pro-addtocart"><a href="#" class="btn-secondary" tabindex="0"><span>ADD TO CART</span></a></td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Delete</td>
                                            <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Compare Table Area End -->
                </div>
                <div class="col-md-6 col-6">
                        <!-- Compare Title Start -->
                        <div class="cart-title">
                            <h5 class="last-title mt-45 mb-20">Compare</h5>
                        </div>
                        <!-- Compare Title End -->

                        <!-- Compare Table Area Start -->
                        <div class="compare-table">
                            <div class="table table-responsive">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="first-column">Product Image</td>
                                            <td class="product-image-title">
                                                <a href="#" class="image"><img src="{{ asset('frontend/assets/images/feature/feature-4.jpg') }}" alt="Compare Product"></a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Product Name</td>
                                            <td class="product-image-title">
                                                <a href="#" class="category">Headphone</a>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Description</td>
                                            <td class="pro-desc">
                                                <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend ..</p>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Price</td>
                                            <td class="pro-price">$295</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Color</td>
                                            <td class="pro-color">Black</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Stock</td>
                                            <td class="pro-stock">In Stock</td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Rating</td>
                                            <td class="pro-ratting">
                                                <div class="rating">
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                    <span class="yellow"><i class="fa fa-star"></i></span>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Add to cart</td>
                                            <td class="pro-addtocart"><a href="#" class="btn-secondary" tabindex="0"><span>ADD TO CART</span></a></td>

                                        </tr>
                                        <tr>
                                            <td class="first-column">Delete</td>
                                            <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Compare Table Area End -->
                </div>
            </div>
        </div>
    </div>
    <!--======================
    Compare area End
    ==========================-->
@endsection

