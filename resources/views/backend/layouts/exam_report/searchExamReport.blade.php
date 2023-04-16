@extends('backend.master')
@section('header_section')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/select2/select2.css') }}" />
    <!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

@endsection
@section('title')
    Exam Report
@endsection

@section('exam_report_active')
    active
@endsection
@section('exam_report_toggled')
    toggled waves-effect waves-block
@endsection

@section('content')
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Search Report</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Home</a></li>
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
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Payment Search By Date Range</strong></h2>
                        </div>
                        <div class="body">
                            <form name="orderSearch" id="orderSearch" action="{{route('show-search-data')}}" class="needs-validation" novalidate method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <label for="form">Select From</label><span class="required">*</span>
                                        <input type="date" name="from" class="form-control" id="from" required>
                                        @error ('from')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please choose a date.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="form">Select To</label><span class="required">*</span>
                                        <input type="date" name="to" class="form-control" id="to" required>

                                        @error ('to')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please choose a date.
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Payment Search By Date</strong></h2>
                        </div>
                        <div class="body">
                            <form name="orderSearch" id="orderSearch" action="{{route('show-search-data')}}" class="needs-validation" novalidate method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="order_date">Select Date</label><span class="required">*</span>
                                        <input type="date" name="order_date" class="form-control" id="order_date" required>
                                        @error ('order_date')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please choose a date.
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Payment Search By Month and Year </strong></h2>
                        </div>
                        <div class="body">
                            <form name="orderSearch" id="orderSearch" action="{{route('show-search-data')}}" class="needs-validation" novalidate method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="order_month">Select Month</label><span class="required">*</span>
                                        <select name="order_month" id="order_month" class="form-control show-tick ms select2" required>
                                            <option value="">--Select a Month--</option>
                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="July">July</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>
                                        </select>
                                        @error ('order_month')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please Select a Month.
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="order_year">Select Year</label><span class="required">*</span>
                                        <select name="order_year" id="order_year" class="form-control show-tick ms select2" required>
                                            <option value="">--Select a Year--</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                            <option value="2037">2037</option>
                                            <option value="2038">2038</option>
                                            <option value="2039">2039</option>
                                            <option value="2040">2040</option>
                                        </select>
                                        @error ('order_year')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please Select a Year.
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Payment Search By Year</strong></h2>
                        </div>
                        <div class="body">
                            <form name="orderSearch" id="orderSearch" action="{{route('show-search-data')}}" class="needs-validation" novalidate method="POST">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <label for="order_year">Select Year</label><span class="required">*</span>
                                        <select name="order_year" id="order_year" class="form-control show-tick ms select2" required>
                                            <option value="">--Select a Year--</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                            <option value="2037">2037</option>
                                            <option value="2038">2038</option>
                                            <option value="2039">2039</option>
                                            <option value="2040">2040</option>
                                        </select>
                                        @error ('order_year')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please Select a Year.
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endsection
