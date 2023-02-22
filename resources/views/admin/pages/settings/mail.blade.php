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
                        <h5 class="card-header">Mail Setting </h5>
                        <form action="{{ route('admin.settings.mail.update') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Account -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_mailer" class="form-label">Mail Mailer</label>
                                        <input type="text" id="mail_mailer" value="{{ setting('mail_mailer') }}"
                                            class="form-control @error('mail_mailer') is-invalid  @enderror"
                                            placeholder="enter mail mailer " name="mail_mailer" />
                                        @error('mail_mailer')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_host" class="form-label">Mail Host</label>
                                        <input type="text" id="mail_host" value="{{ setting('mail_host') }}"
                                            class="form-control @error('mail_host') is-invalid  @enderror"
                                            placeholder="enter mail host " name="mail_host" />
                                        @error('mail_host')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_port" class="form-label">Mail Port</label>
                                        <input type="text" id="mail_port" value="{{ setting('mail_port') }}"
                                            class="form-control @error('mail_port') is-invalid  @enderror"
                                            placeholder="enter mail port number " name="mail_port" />
                                        @error('mail_port')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_username" class="form-label">Mail User Name</label>
                                        <input type="text" id="mail_username" value="{{ setting('mail_username') }}"
                                            class="form-control @error('mail_username') is-invalid  @enderror"
                                            placeholder="enter mail user name " name="mail_username" />
                                        @error('mail_username')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_password" class="form-label">Mail Password </label>
                                        <input type="text" id="mail_password" value="{{ setting('mail_password') }}"
                                            class="form-control @error('mail_password') is-invalid  @enderror"
                                            placeholder="enter mail user password " name="mail_password" />
                                        @error('mail_password')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_encryption" class="form-label">Mail ENCRYPTION </label>
                                        <input type="text" id="mail_encryption" value="{{ setting('mail_encryption') }}"
                                            class="form-control @error('mail_encryption') is-invalid  @enderror"
                                            placeholder="enter mail encryption " name="mail_encryption" />
                                        @error('mail_encryption')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mail_from_address" class="form-label">Mail From Address </label>
                                        <input type="text" id="mail_from_address"
                                            value="{{ setting('mail_from_address') }}"
                                            class="form-control @error('mail_from_address') is-invalid  @enderror"
                                            placeholder="enter mail from address " name="mail_from_address" />
                                        @error('mail_from_address')
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
