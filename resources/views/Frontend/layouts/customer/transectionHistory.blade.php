

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

    <!--======================
    My Account area Start
    ==========================-->
    <div class="my-account-area mt-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-2">
                    <ul class="nav flex-column dashboard-list mb-20">
                        <li><a class="nav-link "  href="{{ route('my.account') }}">Dashboard</a></li>
                        <li> <a class="nav-link " href="{{ route('order-history') }}">Order History</a></li>
                        <li> <a class="nav-link " href="{{ route('transaction-history') }}">Transaction History</a></li>
                        <li> <a class="nav-link " href="{{ route('cannceld-orders') }}">Canceled Order</a></li>
                        <li><a class="nav-link"  href="{{ route('user-change-password') }}">Change Password</a></li>
                        <li><a class="nav-link"  href="{{ route('ecom-user-details') }}">Account details</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ url('ecom/user/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">
                        <div id="dashboard" class="tab-pane fade active show">
                            <!-- Tab panes -->
                    <div class="tab-content dashboard-content mb-20">

                        <div id="orders" class="tab-pane fade active show">
                            <div class="table-responsive">
                                <table class="table ">
                                        @php
                                            $total =0;
                                        @endphp
                                    @foreach ($allOrders as $order)
                                            @php
                                                $total= $total+$order->amount;
                                            @endphp
                                        @endforeach
                                    <thead>
                                         <td class="font-weight-bold"> Total Transaction: </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="font-weight-bold"> ৳ {{ $total }}</td>
                                            <td></td>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Delivered Date</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($allOrders as $order)
                                            <tr>
                                                <td>{{ $order->transaction_id }}</td>
                                                <td>{{ $order->updated_at->translatedFormat('d, F, Y') }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>৳ {{ $order->amount }}</td>
                                                <td><a class="btn btn-secondary" href="{{ route('my.invoice',$order->id) }}">view</a></td>
                                                <td><a class="btn btn-secondary" href="{{ route('pdf.download',$order->id) }}">Download</a></td>
                                            </tr>

                                        @endforeach


                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                        </div> <!-- end of tab-pane -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======================
    My Account area End
    ==========================-->
@endsection













