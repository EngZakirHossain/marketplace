@extends('admin.layouts.master')
@section('page_title', 'Dashboard')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <!-- View sales -->
        <div class="col-xl-4 mb-4 col-lg-5 col-12">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-7">
                        <div class="card-body text-nowrap">
                            <h5 class="card-title mb-0">Congratulations {{ Auth::user()->name }}! 🎉</h5>
                            <p class="mb-2">Have a Good</p>
                            <h4 class="text-primary mb-1">$48.9k</h4>
                            <a href="javascript:;" class="btn btn-primary">View Sales</a>
                        </div>
                    </div>
                    <div class="col-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin/assets') }}/img/illustrations/card-advance-sale.png" height="140"
                                alt="view sales" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- View sales -->

        <!-- Statistics -->
        <div class="col-xl-8 mb-4 col-lg-7 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <small class="text-muted">Updated 1 month ago</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                    <i class="ti ti-chart-pie-2 ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">230k</h5>
                                    <small>Sales</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2">
                                    <i class="ti ti-users ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ count($user) }}</h5>
                                    <small>Customers</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2">
                                    <i class="ti ti-shopping-cart ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">1.423k</h5>
                                    <small>Products</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-2">
                                    <i class="ti ti-currency-dollar ti-sm"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">$9745</h5>
                                    <small>Revenue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics -->

        <div class="col-xl-4 col-12">
            <div class="row">
                <!-- Expenses -->
                <div class="col-xl-6 mb-4 col-md-3 col-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">{{ count($user) }}</h5>
                            <small class="text-muted">Total Users</small>
                        </div>
                        <div class="card-body">
                            <div id="expensesChart"></div>
                            <div class="mt-md-2 text-center mt-lg-3 mt-3">
                                <small class="text-muted mt-3">{{ $user->where('is_active', 1)->count() }} Active User
                                    Science last
                                    month</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Expenses -->

                <!-- Profit last month -->
                <div class="col-xl-6 mb-4 col-md-3 col-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Profit</h5>
                            <small class="text-muted">Last Month</small>
                        </div>
                        <div class="card-body">
                            <div id="profitLastMonth"></div>
                            <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                <h4 class="mb-0">624k</h4>
                                <small class="text-success">+8.24%</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Profit last month -->

                <!-- Generated Leads -->
                <div class="col-xl-12 mb-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-column">
                                    <div class="card-title mb-auto">
                                        <h5 class="mb-1 text-nowrap">Generated Leads</h5>
                                        <small>Monthly Report</small>
                                    </div>
                                    <div class="chart-statistics">
                                        <h3 class="card-title mb-1">4,350</h3>
                                        <small class="text-success text-nowrap fw-semibold"><i
                                                class="ti ti-chevron-up me-1"></i> 15.8%</small>
                                    </div>
                                </div>
                                <div id="generatedLeadsChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Generated Leads -->
            </div>
        </div>

        <!-- Revenue Report -->
        <div class="col-12 col-xl-8 mb-4 col-lg-7">
            <div class="card">
                <div class="card-header pb-3">
                    <h5 class="m-0 me-2 card-title">Revenue Report</h5>
                </div>
                <div class="card-body">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <div id="totalRevenueChart"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center mt-4">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                        id="budgetId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <script>
                                            document.write(new Date().getFullYear());
                                        </script>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="budgetId">
                                        <a class="dropdown-item prev-year1" href="javascript:void(0);">
                                            <script>
                                                document.write(new Date().getFullYear() - 1);
                                            </script>
                                        </a>
                                        <a class="dropdown-item prev-year2" href="javascript:void(0);">
                                            <script>
                                                document.write(new Date().getFullYear() - 2);
                                            </script>
                                        </a>
                                        <a class="dropdown-item prev-year3" href="javascript:void(0);">
                                            <script>
                                                document.write(new Date().getFullYear() - 3);
                                            </script>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h3 class="text-center pt-4 mb-0">$25,825</h3>
                            <p class="mb-4 text-center"><span class="fw-semibold">Budget:
                                </span>56,800</p>
                            <div class="px-3">
                                <div id="budgetChart"></div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="button" class="btn btn-primary">Increase
                                    Button</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Revenue Report -->

        <div class="col-12 col-xl-8 mb-4 col-lg-7">
            <div class="card">
                <div class="card-header pb-3">
                    <h5 class="m-0 me-2 card-title">Pyment Testing </h5>
                </div>
                <div class="card-body">
                    <div class="row row-bordered g-0">
                        @php($config = \App\Helper\Helpers::get_business_settings('paypal'))

                        @php($callback = session('callback'))
                        @if (isset($config) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card" onclick="$('#ssl-form').submit()">
                                    <div class="card-body" >
                                        <form class="needs-validation" method="POST" id="payment-form"
                                            action="{!! route('pay-paypal', [
                                                'order_amount' => 25,
                                                'customer_id' => Auth::user()->id,
                                                'callback' => $callback,
                                            ]) !!}">
                                            @csrf
                                            <button class="btn btn-block click-if-alone" type="submit">
                                                <img width="100"
                                                    src="{{ asset('admin/assets/img/icons/payments/paypal.png') }}" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @php($config = \App\Helper\Helpers::get_business_settings('ssl_commerz_payment'))
                        @if (isset($config) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card" onclick="$('#ssl-form').submit()">
                                    <div class="card-body">
                                        <form action="{!! route('pay-ssl', [
                                            'order_amount' => 25,
                                            'customer_id' => Auth::user()->id,
                                            'callback' => $callback,
                                        ]) !!}" method="POST" class="needs-validation"
                                            id="ssl-form">
                                            <input type="hidden" value="{{ csrf_token() }}" name="_token" />
                                            <button class="btn btn-block click-if-alone" type="submit">
                                                <img width="100"
                                                    src="{{ asset('admin/assets/img/icons/payments/sslcomz.png') }}" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php($config = \App\Helper\Helpers::get_business_settings('stripe'))
                        @if (isset($config) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body" style="height: 70px">
                                        @php($config = \App\Helper\Helpers::get_business_settings('stripe'))
                                        <button class="btn btn-block click-if-alone" type="button" id="checkout-button">
                                            <img width="100" src="{{ asset('public/assets/admin/img/stripe.png') }}" />
                                        </button>
                                        <script type="text/javascript">
                                            // Create an instance of the Stripe object with your publishable API key
                                            var stripe = Stripe('{{ $config['published_key'] }}');
                                            var checkoutButton = document.getElementById("checkout-button");
                                            checkoutButton.addEventListener("click", function() {
                                                fetch("{!! route('pay-stripe', [
                                                    'order_amount' => $order_amount,
                                                    'customer_id' => $customer['id'],
                                                    'callback' => $callback,
                                                ]) !!}", {
                                                    method: "GET",
                                                }).then(function(response) {
                                                    console.log(response)
                                                    return response.text();
                                                }).then(function(session) {
                                                    console.log(JSON.parse(session).id)
                                                    return stripe.redirectToCheckout({
                                                        sessionId: JSON.parse(session).id
                                                    });
                                                }).then(function(result) {
                                                    if (result.error) {
                                                        alert(result.error.message);
                                                    }
                                                }).catch(function(error) {
                                                    console.error("Error:", error);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php($config = \App\Helper\Helpers::get_business_settings('bkash'))
                        @if (isset($config) && $config['status'])
                            <div class="col-md-6 mb-4" style="cursor: pointer">
                                <div class="card">
                                    <div class="card-body">
                                        <button class="btn btn-block click-if-alone" id="bKash_button"
                                            onclick="BkashPayment()">
                                            <img width="100"
                                                src="{{ asset('admin/assets/img/icons/payments/bkash.png') }}" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_scipt')
@php($config=\App\Helper\Helpers::get_business_settings('bkash'))
@if(isset($config) && $config['status'])
    {{-- BKash Starts --}}
    @if(env('APP_MODE')=='live')
        <script id="myScript"
                src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    @else
        <script id="myScript"
                src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
    @endif

    <script type="text/javascript">
        function BkashPayment() {
            $('#loading').show();
            // get token
            $.ajax({
                url: "{{ route('bkash-get-token') }}",
                type: 'POST',
                contentType: 'application/json',
                success: function (data) {
                    $('#loading').hide();
                    $('pay-with-bkash-button').trigger('click');
                    if (data.hasOwnProperty('msg')) {
                        showErrorMessage(data) // unknown error
                    }
                },
                error: function (err) {
                    $('#loading').hide();
                    showErrorMessage(err);
                }
            });
        }

        let paymentID = '';
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: {},
            createRequest: function (request) {
                setTimeout(function () {
                    createPayment(request);
                }, 2000)
            },
            executeRequestOnAuthorization: function (request) {
                $.ajax({
                    url: '{{ route('bkash-execute-payment') }}',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        "paymentID": paymentID
                    }),
                    success: function (data) {
                        if (data) {
                            if (data.paymentID != null) {
                                BkashSuccess(data);
                            } else {
                                showErrorMessage(data);
                                bKash.execute().onError();
                            }
                        } else {
                            $.get('{{ route('bkash-query-payment') }}', {
                                payment_info: {
                                    payment_id: paymentID
                                }
                            }, function (data) {
                                if (data.transactionStatus === 'Completed') {
                                    BkashSuccess(data);
                                } else {
                                    createPayment(request);
                                }
                            });
                        }
                    },
                    error: function (err) {
                        bKash.execute().onError();
                    }
                });
            },
            onClose: function () {
                // for error handle after close bKash Popup
            }
        });

        function createPayment(request) {
            // because of createRequest function finds amount from this request
            request['amount'] = "25"; // max two decimal points allowed
            $.ajax({
                url: '{{ route('bkash-create-payment') }}',
                data: JSON.stringify(request),
                type: 'POST',
                contentType: 'application/json',
                success: function (data) {
                    $('#loading').hide();
                    if (data && data.paymentID != null) {
                        paymentID = data.paymentID;
                        bKash.create().onSuccess(data);
                    } else {
                        bKash.create().onError();
                    }
                },
                error: function (err) {
                    $('#loading').hide();
                    showErrorMessage(err.responseJSON);
                    bKash.create().onError();
                }
            });
        }

        function BkashSuccess(data) {
            $.post('{{ route('bkash-success') }}', {
                payment_info: data,
                callback: "{{ $callback }}",
            }, function (res) {
                location.href = res.redirect_url;
                {{--location.href = '{{ route('payment-success')}}';--}}
            });
        }

        function showErrorMessage(response) {
            let message = 'Unknown Error';
            if (response.hasOwnProperty('errorMessage')) {
                let errorCode = parseInt(response.errorCode);
                let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                    2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                    2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                    2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                    2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
                ];
                if (bkashErrorCode.includes(errorCode)) {
                    message = response.errorMessage
                }
            }
            Swal.fire("Payment Failed!", message, "error");
        }
    </script>
    {{-- BKash Ends --}}
@endif
@endpush
