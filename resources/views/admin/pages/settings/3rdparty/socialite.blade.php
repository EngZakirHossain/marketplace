@extends('admin.layouts.master')
@section('page_title', 'Social Login Setting')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Social Login Setting</h4>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.pages.settings.3rdparty.3rdPartySettingMenu')
                    <div class="card mb-4">
                        {{-- <h5 class="card-header">Socialite Login Setting </h5> --}}
                        <form action="{{ route('admin.settings.socialite.update') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Account -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-header">Github Login Setting </h5>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="github_client_id" class="form-label">GITHUB_CLIENT_ID </label>
                                            <input type="text" id="github_client_id"
                                                value="{{ setting('github_client_id') }}"
                                                class="form-control @error('github_client_id') is-invalid  @enderror"
                                                placeholder="enter GITHUB_CLIENT_ID " name="github_client_id" />
                                            @error('github_client_id')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="github_client_screct"
                                                class="form-label">GITHUB_CLIENT_SECRET</label>
                                            <input type="text" id="github_client_screct"
                                                value="{{ setting('github_client_screct') }}"
                                                class="form-control @error('github_client_screct') is-invalid  @enderror"
                                                placeholder="enter GITHUB_CLIENT_SECRET " name="github_client_screct" />
                                            @error('github_client_screct')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="github_client_redirect"
                                                class="form-label">GITHUB_CLIENT_REDIRECT</label>
                                            <input type="text" id="github_client_redirect"
                                                value="{{ setting('github_client_redirect') }}"
                                                class="form-control @error('github_client_redirect') is-invalid  @enderror"
                                                placeholder="enter GITHUB_CLIENT_SECRET " name="github_client_redirect" />
                                            @error('github_client_redirect')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <h5 class="card-header">Google Login Setting </h5>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="google_client_id" class="form-label">GOOGLE_CLIENT_ID </label>
                                            <input type="text" id="google_client_id"
                                                value="{{ setting('google_client_id') }}"
                                                class="form-control @error('google_client_id') is-invalid  @enderror"
                                                placeholder="enter GOOGLE_CLIENT_ID " name="google_client_id" />
                                            @error('google_client_id')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="google_client_screct"
                                                class="form-label">google_CLIENT_SECRET</label>
                                            <input type="text" id="google_client_screct"
                                                value="{{ setting('google_client_screct') }}"
                                                class="form-control @error('google_client_screct') is-invalid  @enderror"
                                                placeholder="enter GOOGLE_CLIENT_SECRET " name="google_client_screct" />
                                            @error('google_client_screct')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-6 col-md-12 mb-2">
                                            <label for="google_client_redirect"
                                                class="form-label">google_CLIENT_REDIRECT</label>
                                            <input type="text" id="google_client_redirect"
                                                value="{{ setting('google_client_redirect') }}"
                                                class="form-control @error('google_client_redirect') is-invalid  @enderror"
                                                placeholder="enter GOOGLE_CLIENT_SECRET " name="google_client_redirect" />
                                            @error('google_client_redirect')
                                                <span class="is-invalid text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
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
