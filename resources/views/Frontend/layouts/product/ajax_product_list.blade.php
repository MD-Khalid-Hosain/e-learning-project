
@foreach ($categoryProducts as $product)
    <div class="col-lg-4 col-cust-5 col-12 mb-20">
    <!-- Single-Product-Start -->
    <div class="item-product pt-0">
        <div class="product-thumb">
            <a href="{{ route('product-details',$product['slug']) }}">
                <img src="{{ asset('backend/uploads/product_main_image/'.$product['main_image']) }}" alt="{{ $product['product_name'] }}" class="img-fluid">
            </a>
            @if ($product['offer_id'] != null)
                @if (App\Offer::where('id', $product['offer_id'])->value('status') == 1)
                <div class="box-label">
                    <div class="label-product-discount">
                        <a href="{{ route('our.offers.details',App\Offer::where('id', $product['offer_id'])->where('status', 1)->value('slug')) }}"><span>{{ App\Offer::where('id', $product['offer_id'])->where('status', 1)->value('offer_title') }}</span></a>
                    </div>
                </div>
                @endif
            @else

            @endif

            <div class="action-link">
            <form action="{{ route('add.compare') }}" method="post" class="d-inline">
            @csrf
                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                <input type="hidden" name="category_id" value="{{ $product['category_id'] }}">
                <button type="submit" class="compare-add same-link" title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></button>
            </form>
                <a class="wishlist-add same-link" href="wishlist.html" title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
            </div>
        </div>
        <div class="product-caption">
            <div class="product-name">
                <a href="{{ route('product-details',$product['slug']) }}">{{ $product['product_name'] }}</a>
            </div>
            <div class="rating">
                @php
                $productReviews = App\Review::where('product_id', $product['id'])->where('status',1)->get();
                    //array variable initialization
                $allStars= [];
                $flag=0;
                //geting this product review rating
                foreach($productReviews as $review){
                    $allStars[] = $review->rating;
                    $flag++;
                }
                // highest value in all rating
                $print_star = 0;
                foreach($allStars as $key=>$val){
                    if($val > $print_star){
                        $print_star = $val;
                    }
                }
                @endphp
                @if ($print_star >0)
                    @php
                        $remain_star= 0;
                    @endphp
                    @for ($i = 1; $i <= $print_star; $i++)
                    <span class="yellow"><i class="fa fa-star"></i></span>
                        @php
                            $remain_star= (5 - $print_star);
                        @endphp
                    @endfor
                    @for ($j = 1; $j<=$remain_star; $j++)
                        <span class="null-star">&#9734;</span>
                    @endfor
                @else
                    @for ($k = 1; $k<=5; $k++)
                        <span class="null-star">&#9734;</span>
                    @endfor
                @endif
            </div>
            <div class="product-tax mb-20">
                <ul>
                    @php
                        $i=0;
                    @endphp
                    @foreach (App\ProductFetures::where('product_id', $product['id'])->get() as $features)
                    <li>&diams; {{ $features['fetures'] }}</li>
                    @php
                        $i++;
                        if($i==3) break;
                    @endphp
                    @endforeach
                </ul>
            </div>
            <div class="price-box">
                <span class="regular-price">৳{{ number_format($product['price']) }}</span>
                @if ($product['previous_price'] != null)

                <del><span >৳{{ number_format($product['previous_price']) }}</span></del>
                <span class="badge" style="color: white; background:red">@if($product['offer_percent'] != null) -{{ $product['offer_percent'] }}%  @endif</span>
                @else

                @endif
            </div>
            <div class="cart">
                @if ($product['product_stock'] == "Out of Stock")
                    <P class="font-weight-bold">Out of Stock</P>
                @else
                    @if ($product['product_stock'] == "Up Comming")
                        <P class="font-weight-bold">Up Comming</P>
                    @else
                        <div class="add-to-cart">
                            <form action="{{ route('add-to-cart') }}" method="POST">
                            @csrf
                                <input type="hidden"  name="product_quantity" value="1">
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <input type="hidden" name="category_id" value="{{ $product['category_id'] }}">
                                <button type="submit"><i class="zmdi zmdi-shopping-cart-plus zmdi-hc-fw"></i></button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="grid-list-caption align-items-center">
            <div class="product-name">
                <a href="{{ route('product-details',$product['slug']) }}">{{ $product['product_name'] }}</a>
            </div>
            <div class="rating">
                @php
                $productReviews = App\Review::where('product_id', $product['id'])->where('status',1)->get();
                    //array variable initialization
                $allStars= [];
                $flag=0;
                //geting this product review rating
                foreach($productReviews as $review){
                    $allStars[] = $review->rating;
                    $flag++;
                }
                // highest value in all rating
                $print_star = 0;
                foreach($allStars as $key=>$val){
                    if($val > $print_star){
                        $print_star = $val;
                    }
                }
                @endphp
                @if ($print_star >0)
                    @php
                        $remain_star= 0;
                    @endphp
                    @for ($i = 1; $i <= $print_star; $i++)
                    <span class="yellow"><i class="fa fa-star"></i></span>
                        @php
                            $remain_star= (5 - $print_star);
                        @endphp
                    @endfor
                    @for ($j = 1; $j<=$remain_star; $j++)
                        <span class="null-star">&#9734;</span>
                    @endfor
                @else
                    @for ($k = 1; $k<=5; $k++)
                        <span class="null-star">&#9734;</span>
                    @endfor
                @endif
            </div>
            <div class="product-tax mb-20">
                <ul>
                    @foreach (App\ProductFetures::where('product_id', $product['id'])->get() as $features)
                    <li>&diams; {{ $features['fetures'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="text-available">
                <p><strong>Brand:</strong><span> {{ $product['brand']['name'] }}</span></p>
            </div>
            <div class="price-box">
                <span class="regular-price">৳{{ number_format($product['price']) }}</span>
                @if ($product['previous_price'] != null)

                <del><span >৳{{ number_format($product['previous_price']) }}</span></del>
                <span class="badge" style="color: white; background:red">@if($product['offer_percent'] != null) -{{ $product['offer_percent'] }}%  @endif</span>
                @else

                @endif
            </div>
            <div class="action-link">
                <a class="compare-add same-link" href="compare.html" title="Add to compare"><i class="zmdi zmdi-refresh-alt"></i></a>
                <a class="wishlist-add same-link" href="wishlist.html" title="Add to wishlist"><i class="zmdi zmdi-favorite-outline zmdi-hc-fw"></i></a>
            </div>
            <div class="cart-list-button">
                @if ($product['product_stock'] == "Out of Stock")
                    <P class="font-weight-bold">Out of Stock</P>
                @else
                    @if ($product['product_stock'] == "Up Comming")
                        <P class="font-weight-bold">Up Comming</P>
                    @else
                    <form action="{{ route('add-to-cart') }}" method="POST">
                            @csrf
                                <input type="hidden"  name="product_quantity" value="1">
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <input type="hidden" name="category_id" value="{{ $product['category_id'] }}">
                                <button type="submit" class="cart-btn">Add To Cart</button>
                            </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
    <!-- Single-Product-End -->
</div>
@endforeach

