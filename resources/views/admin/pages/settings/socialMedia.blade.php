@extends('admin.layouts.master')
@section('page_title', 'General Setting')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> General Setting</h4>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.pages.settings.generalSettingMenu')
                    <div class="card mb-4">
                        <h5 class="card-header pb-1">Social Accounts</h5>
                        <p class="px-4">Display content from social accounts on your site</p>
                        <form action="{{ route('admin.settings.socialMedia.update') }}" id="formAccountSettings"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <!-- Social Accounts -->
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/assets/img/icons/brands/facebook.png"
                                                alt="facebook" class="me-3" height="38">
                                        </div>
                                        <div class="flex-grow-1 row">
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" id="billingAddress" value="{{ setting('site_facebook_link') }}"
                                                    name="site_facebook_link" placeholder="enter facebook url ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/assets/img/icons/brands/twitter.png"
                                                alt="twitter" class="me-3" height="38">
                                        </div>
                                        <div class="flex-grow-1 row">
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" id="billingAddress" value="{{ setting('site_facebook_link') }}"
                                                    name="site_twitter_link" placeholder="enter twitter url ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/assets/img/icons/brands/instagram.png"
                                                alt="instagram" class="me-3" height="38">
                                        </div>
                                        <div class="flex-grow-1 row">
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" id="billingAddress" value="{{ setting('site_instragram_link') }}"
                                                    name="site_instragram_link" placeholder="enter instagram url ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/assets/img/icons/brands/dribbble.png"
                                                alt="dribbble" class="me-3" height="38">
                                        </div>
                                        <div class="flex-grow-1 row">
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" id="billingAddress" value="{{ setting('site_behance_link') }}"
                                                    name="site_behance_link" placeholder="enter dribbble url ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/assets/img/icons/brands/behance.png"
                                                alt="behance" class="me-3" height="38">
                                        </div>
                                        <div class="flex-grow-1 row">
                                            <div class="col-sm-11">
                                                <input type="text" class="form-control" id="billingAddress" value="{{ setting('site_dribbble_link') }}"
                                                    name="site_dribbble_link" placeholder="enter behance url ">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Social Accounts -->
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
    </div>
@endsection
@push('admin_scipt')
@endpush
