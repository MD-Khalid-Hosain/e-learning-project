@extends('backend.master')
@section('dashboard_active')
active open
@endsection
@section('dashboard_toggled')
    toggled waves-effect waves-block
@endsection
@section('content')
     <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Stater Page</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
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
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <div class="card">--}}
{{--                        <div class="body xl-blue">--}}
{{--                            <h4 class="m-t-0 m-b-0">{{ total_product() }}</h4>--}}
{{--                            <p class="m-b-0">Total Uploaded Product</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                 <div class="col-lg-3 col-md-6">
                     <div class="card">
                         <div class="body xl-purple">
                             <h4 class="m-t-0 m-b-0">{{ App\Course::get()->count() }}</h4>
                             <p class="m-b-0 ">Total Courses</p>

                         </div>
                     </div>
                 </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body xl-green">
                            <h4 class="m-t-0 m-b-0">{{ App\PaymentDetails::get()->sum('amount') }} Tk</h4>
                            <p class="m-b-0 ">Total Earning</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="body xl-pink">
                            <h4 class="m-t-0 m-b-0">{{ number_format(App\PaymentDetails::whereMonth('created_at', Carbon\Carbon::now()->month)->get()->sum('amount')) }} Tk</h4>
                            <p class="m-b-0">{{ Carbon\Carbon::now()->format('F Y') }} Earning</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                @foreach ($alladmin as $admin)
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card w_data_1">
                            <div class="body">
                                <div class="w_icon indigo"><img style="border-radius: 50%" src="{{ asset('backend/uploads/admin') }}/{{ $admin->image }}" alt="{{ $admin->name }}"></div>
                                <h4 class="mt-3">Total : {{ App\Product::where('admin_id',$admin->id)->count() }}</h4>

                                <span >Today uploaded: {{ App\Product::where('admin_id',$admin->id)->whereDate('created_at', Carbon\Carbon::today())->count() }}</span>
                                <div class="w_description text-success">
                                    <span class="font-wight-bold">{{ $admin->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            <div>
        </div>
    </div>
@endsection
