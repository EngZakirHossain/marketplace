@extends('admin.layouts.master')
@section('page_title', 'SMS Setting')
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
                            <div class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center text-uppercase mb-1">
                                        <h5 class="text-center">twilio_sms</h5>
                                        <div class="pl-2">
                                            <img src="{{ asset('admin/assets/img/icons/sms/twilio.png') }}" alt="public"
                                                style="height: 50px">
                                        </div>
                                    </div>
                                    <span class="badge badge-soft-info mb-3 word-break">NB : #OTP# will be
                                        replace with otp</span>
                                    @php($config = \App\Helper\Helpers::get_business_settings('twilio_sms'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.sms_module_update', ['twilio_sms']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="select-all" name="status"
                                                {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="select-all">Active </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-capitalize" class="form-label">sid</label><br>
                                            <input type="text" class="form-control my-2" name="sid"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['sid'] ?? '' : '' }}"
                                                placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                                        </div>

                                        <div class="form-group">
                                            <label class="text-capitalize"
                                                class="form-label">messaging_service_sid</label><br>
                                            <input type="text" class="form-control my-2" name="messaging_service_sid"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['messaging_service_sid'] ?? '' : '' }}"
                                                placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">token</label><br>
                                            <input type="text" class="form-control my-2" name="token"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['token'] ?? '' : '' }}"
                                                placeholder="Ex: ACbf855229b8b2e5d02cad58e116365164">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">from</label><br>
                                            <input type="text" class="form-control my-2" name="from"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['from'] ?? '' : '' }}"
                                                placeholder="Ex: +91-46482373636">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">otp_template</label><br>
                                            <input type="text" class="form-control my-2" name="otp_template"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['otp_template'] ?? '' : '' }}"
                                                placeholder="Ex : Your OTP is #otp#">
                                        </div>
                                        <div class="text-right">
                                            <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                class="btn btn-primary px-lg-5 my-3">save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center text-uppercase mb-1">
                                        <h5 class="text-center">nexmo_sms</h5>
                                        <div class="pl-2">
                                            <img src="{{ asset('admin/assets/img/icons/sms/nexmo.png') }}" alt="public"
                                                style="height: 50px">
                                        </div>
                                    </div>
                                    <span class="badge badge-soft-info mb-3 word-break">NB : #OTP# will be replace with
                                        otp</span>
                                    @php($config = \App\Helper\Helpers::get_business_settings('nexmo_sms'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.sms_module_update', ['nexmo_sms']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input mb-2" type="checkbox" id="select-all"
                                                name="status" {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="select-all">Active </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-capitalize" class="form-label">api_key</label><br>
                                            <input type="text" class="form-control mb-2" name="api_key"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['api_key'] ?? '' : '' }}"
                                                placeholder="Ex :5923ec0959">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">api_secret</label><br>
                                            <input type="text" class="form-control mb-2" name="api_secret"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['api_secret'] ?? '' : '' }}"
                                                placeholder="Ex : RYysbkdscnUIizx">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">from</label><br>
                                            <input type="text" class="form-control mb-2" name="from"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['from'] ?? '' : '' }}"
                                                placeholder="Ex : RYysbkdscnUIizx">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">otp_template</label><br>
                                            <input type="text" class="form-control mb-2" name="otp_template"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['otp_template'] ?? '' : '' }}"
                                                placeholder="Ex : Your OTP is #otp#">
                                        </div>
                                        <div class="text-right">
                                            <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                class="btn btn-primary px-lg-5">save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center text-uppercase mb-1">
                                        <h5 class="text-center">2factor_sms</h5>
                                        <div class="pl-2">
                                            <img src="{{ asset('admin/assets/img/icons/sms/2factor.png') }}"
                                                alt="public" style="height: 50px">
                                        </div>
                                    </div>
                                    <span class="badge badge-soft-info word-break">EX of SMS provider's template : your OTP
                                        is XXXX here, please check.</span><br>
                                    <span class="badge badge-soft-info mb-3 word-break">NB : XXXX will be replace with
                                        otp</span>
                                    @php($config = \App\Helper\Helpers::get_business_settings('2factor_sms'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.sms_module_update', ['2factor_sms']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="select-all"
                                                name="status" {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="select-all">Active </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-capitalize" class="form-label">api_key</label><br>
                                            <input type="text" class="form-control mb-2" name="api_key"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['api_key'] ?? '' : '' }}"
                                                placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164">
                                        </div>
                                        <div class="text-right">
                                            <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                class="btn btn-primary px-lg-5">save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div
                                        class="d-flex flex-wrap justify-content-between align-items-center text-uppercase mb-1">
                                        <h5 class="text-center">msg91_sms</h5>
                                        <div class="pl-2">
                                            <img src="{{ asset('admin/assets/img/icons/sms/msg91.png') }}" alt="public"
                                                style="height: 50px">
                                        </div>
                                    </div>
                                    <span class="badge badge-soft-info mb-3 word-break">NB : Keep an OTP variable in your
                                        SMS providers OTP Template.</span><br>
                                    @php($config = \App\Helper\Helpers::get_business_settings('msg91_sms'))
                                    <form
                                        action="{{ env('APP_MODE') != 'demo' ? route('admin.settings.sms_module_update', ['msg91_sms']) : 'javascript:' }}"
                                        method="post">
                                        @csrf
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="select-all"
                                                name="status" {{ isset($config) && $config['status'] ? 'checked' : '' }}>
                                            <label class="form-check-label" for="select-all">Active </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-capitalize" class="form-label">template_id</label><br>
                                            <input type="text" class="form-control mb-2" name="template_id"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['template_id'] ?? '' : '' }}"
                                                placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-capitalize" class="form-label">authkey</label><br>
                                            <input type="text" class="form-control mb-2" name="authkey"
                                                value="{{ env('APP_MODE') != 'demo' ? $config['authkey'] ?? '' : '' }}"
                                                placeholder="Ex :ACbf855229b8b2e5d02cad58e116365164">
                                        </div>
                                        <div class="text-right">
                                            <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                                                onclick="{{ env('APP_MODE') != 'demo' ? '' : 'call_demo()' }}"
                                                class="btn btn-primary px-lg-5">save</button>
                                        </div>
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
