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
                        <h5 class="card-header">General Setting Details</h5>
                        <form action="{{ route('admin.settings.general.update') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Account -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="{{ asset('storage/uploads/company') }}/{{ setting('site_logo') }}"
                                                class="d-block w-px-250 h-px-100 rounded" id="uploadedAvatar"
                                                onerror="this.src='{{ asset('admin') }}/assets/img/avatars/1.png'">
                                            <div class="button-wrapper">
                                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                                    <span class="d-none d-sm-block">Upload Logo </span>
                                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name='site_logo'
                                                        class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                </label>
                                                <div class="text-muted">Allowed JPG or PNG.(250 PX 100PX) Max size of 100K
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                                            <img src="{{ asset('storage/uploads/company') }}/{{ setting('site_favicon') }}"
                                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar"
                                                onerror="this.src='{{ asset('admin') }}/assets/img/avatars/1.png'">

                                            <div class="button-wrapper">
                                                <label for="uploadFavicon" class="btn btn-primary me-2 mb-3" tabindex="0">
                                                    <span class="d-none d-sm-block">Upload Favicon </span>
                                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                                    <input type="file" id="uploadFavicon" name='site_favicon'
                                                        class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                </label>
                                                <div class="text-muted">Allowed JPG or PNG.(25 PX 25) Max size of 8K</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="site_title" class="form-label">Site Name</label>
                                        <input type="text" id="site_title" value="{{ setting('site_title') }}"
                                            class="form-control @error('site_title') is-invalid  @enderror"
                                            placeholder="enter site title " name="site_title" />
                                        @error('site_title')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="site_address" class="form-label">Site Address</label>
                                        <input type="text" id="site_address" value="{{ setting('site_address') }}"
                                            class="form-control @error('site_address') is-invalid  @enderror"
                                            placeholder="enter site address " name="site_address" value="" />
                                        @error('site_address')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="site_phone" class="form-label">Site Phone</label>
                                        <input type="phone" id="site_phone" value="{{ setting('site_phone') }}"
                                            class="form-control @error('site_phone') is-invalid  @enderror"
                                            placeholder="enter site address " name="site_phone" value="" />
                                        @error('site_phone')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="site_email" class="form-label">Site Email</label>
                                        <input type="email" id="site_email" value="{{ setting('site_email') }}"
                                            class="form-control @error('site_email') is-invalid  @enderror"
                                            placeholder="enter site email " name="site_email" value="" />
                                        @error('site_email')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="site_description" class="form-label">Site Description</label>
                                        <textarea name="site_description" class="form-control @error('site_address') is-invalid  @enderror"
                                            id="site_description" cols="10" rows="5" placeholder="enter site description">{{ setting('site_description') }}</textarea>
                                        @error('site_description')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
@endsection
@push('admin_scipt')
@endpush
