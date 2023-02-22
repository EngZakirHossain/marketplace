@extends('admin.layouts.master')
@section('page_title', 'Payment Setting')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Social Login Setting</h4>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.pages.settings.3rdparty.3rdPartySettingMenu')
                    {{-- //Twilio sms  --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase mb-3">payment method
                                    </h5>
                                    @php($config = \App\Helper\Helpers::get_business_settings('cash_on_delivery'))
                                    <form action="{{ route('admin.settings.payment_method_update', ['cash_on_delivery']) }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="select-all"
                                                    name="status"
                                                    {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                <label class="form-check-label" for="select-all">Cash On Delivery </label>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-uppercase mb-3">payment method
                                    </h5>
                                    @php($config = \App\Helper\Helpers::get_business_settings('digital_payment'))
                                    <form action="{{ route('admin.settings.payment_method_update', ['digital_payment']) }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" id="select-all"
                                                    name="status"
                                                    {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                <label class="form-check-label" for="select-all">Digital Payment </label>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    @php($config = \App\Helper\Helpers::get_business_settings('ssl_commerz_payment'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.payment_method_update', ['ssl_commerz_payment']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <h5 class="d-flex flex-wrap justify-content-between">
                                                <span class="text-uppercase">sslcommerz</span>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="select-all"
                                                        name="status"
                                                        {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="select-all">Is Active</label>
                                                </div>
                                            </h5>

                                            <div class="payment--gateway-img">
                                                <img src="{{ asset('admin/assets/img/icons/payments/sslcomz.png') }}"
                                                    alt="public">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2 mb-2" name="store_id"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['store_id'] : '' }}"
                                                    placeholder="store id">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="store_password"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['store_password'] : '' }}"
                                                    placeholder="store' password'">
                                            </div>
                                            <div class="text-right">
                                                <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                    onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                    class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 ">
                            <div class="card">
                                <div class="card-body">
                                    @php($config = \App\Helper\Helpers::get_business_settings('paypal'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.payment_method_update', ['paypal']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <h5 class="d-flex flex-wrap justify-content-between">
                                                <span class="text-uppercase">paypal</span>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="select-all"
                                                        name="status"
                                                        {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="select-all">Is Active</label>
                                                </div>
                                            </h5>

                                            <div class="payment--gateway-img">
                                                <img src="{{ asset('admin/assets/img/icons/payments/paypal.png') }}"
                                                    alt="public">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="paypal_client_id"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['paypal_client_id'] : '' }}"
                                                    placeholder="paypal client id">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="paypal_secret"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['paypal_secret'] : '' }}"
                                                    placeholder="paypalsecret">
                                            </div>

                                            <div class="text-right">
                                                <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                    onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                    class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="card">
                                <div class="card-body">
                                    @php($config = \App\Helper\Helpers::get_business_settings('stripe'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.payment_method_update', ['stripe']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <h5 class="d-flex flex-wrap justify-content-between">
                                                <span class="text-uppercase">stripe</span>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="select-all"
                                                        name="status"
                                                        {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="select-all">Is Active</label>
                                                </div>
                                            </h5>

                                            <div class="payment--gateway-img">
                                                <img src="{{ asset('admin/assets/img/icons/payments/stripe.png') }}"
                                                    alt="public">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="published_key"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['published_key'] : '' }}"
                                                    placeholder="published key'">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="api_key"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['api_key'] : '' }}"
                                                    placeholder="api key">
                                            </div>
                                            <div class="text-right">
                                                <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                    onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                    class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    @php($config = \App\Helper\Helpers::get_business_settings('bkash'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.payment_method_update', ['bkash']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        @if (isset($config))
                                            <h5 class="d-flex flex-wrap justify-content-between">
                                                <span class="text-uppercase">bkash</span>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="select-all"
                                                        name="status"
                                                        {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="select-all">Is Active</label>
                                                </div>
                                            </h5>

                                            <div class="payment--gateway-img">
                                                <img src="{{ asset('admin/assets/img/icons/payments/bkash.png') }}"
                                                    alt="public">
                                            </div>


                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="api_key"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['api_key'] ?? '' : '' }}"
                                                    placeholder="bkash api key">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="api_secret"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['api_secret'] ?? '' : '' }}"
                                                    placeholder="bkash api secret">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="username"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['username'] ?? '' : '' }}"
                                                    placeholder="username">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control mb-2" name="password"
                                                    value="{{ env('APP_MODE') != 'demo' ? $config['password'] ?? '' : '' }}"
                                                    placeholder="password">
                                            </div>
                                            <div class="text-right">
                                                <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                    onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                    class="btn btn-primary px-5">save</button>
                                            </div>
                                        @else
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary px-5">configure</button>
                                            </div>
                                        @endif
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
@push('admin_scipt')
@endpush
