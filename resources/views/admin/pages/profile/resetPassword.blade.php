@extends('admin.layouts.master')
@section('page_title', 'Password Reset')
@push('admin_style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/pages/page-account-settings.css" />
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> User Password Reset</h4>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.pages.profile.profileMenu')
                    <!-- Change Password -->
                    <div class="card mb-4">
                        <h5 class="card-header">Change Password</h5>
                        <div class="card-body">
                            <form action="{{ route('admin.user.password.reset') }}" id="formAccountSettings" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="old_password">Current Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control @error('old_password') is-invalid  @enderror"
                                                type="password" name="old_password" id="old_password"
                                                placeholder="enter current Password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        @error('old_password')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="password">New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control @error('password') is-invalid  @enderror"
                                                type="password" id="password" name="password"
                                                placeholder="enter new Password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        @error('password')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-6 form-password-toggle">
                                        <label class="form-label" for="password_confirmation">Confirm New Password</label>
                                        <div class="input-group input-group-merge">
                                            <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password" name="password_confirmation" id="password_confirmation"
                                                placeholder="Confirm Password" />
                                            <span class="input-group-text cursor-pointer"><i
                                                    class="ti ti-eye-off"></i></span>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="is-invalid text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-4">
                                        <h6>Password Requirements:</h6>
                                        <ul class="ps-3 mb-0">
                                            <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                                            <li class="mb-1">At least one lowercase character</li>
                                            <li>At least one number, symbol, or whitespace character</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        {{-- <button type="reset" class="btn btn-label-secondary">Cancel</button> --}}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ Change Password -->

                    <!-- Two-steps verification -->
                    <div class="card mb-4">
                        <h5 class="card-header">Two-steps verification</h5>
                        <div class="card-body">
                            <h6 class="fw-semibold mb-3">Two factor authentication is not enabled yet.</h6>
                            <p class="w-50">
                                Two-factor authentication adds an additional layer of security to your account by
                                requiring more
                                than just a password to log in.
                                <a href="javascript:void(0);">Learn more.</a>
                            </p>
                            <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#enableOTP">
                                Enable two-factor authentication
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->

                    <!-- Recent Devices -->
                    <div class="card mb-4">
                        <h5 class="card-header">Recent Devices</h5>
                        <div class="table-responsive">
                            <table class="table border-top">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-truncate">Browser</th>
                                        <th class="text-truncate">Device</th>
                                        <th class="text-truncate">Location</th>
                                        <th class="text-truncate">Recent Activities</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-brand-windows text-info me-2 ti-sm"></i>
                                            <strong>Chrome on Windows</strong>
                                        </td>
                                        <td class="text-truncate">HP Spectre 360</td>
                                        <td class="text-truncate">Switzerland</td>
                                        <td class="text-truncate">10, July 2021 20:07</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-device-mobile text-danger me-2 ti-sm"></i>
                                            <strong>Chrome on iPhone</strong>
                                        </td>
                                        <td class="text-truncate">iPhone 12x</td>
                                        <td class="text-truncate">Australia</td>
                                        <td class="text-truncate">13, July 2021 10:10</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-brand-android text-success me-2 ti-sm"></i>
                                            <strong>Chrome on Android</strong>
                                        </td>
                                        <td class="text-truncate">Oneplus 9 Pro</td>
                                        <td class="text-truncate">Dubai</td>
                                        <td class="text-truncate">14, July 2021 15:15</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-brand-apple me-2 ti-sm"></i> <strong>Chrome on
                                                MacOS</strong>
                                        </td>
                                        <td class="text-truncate">Apple iMac</td>
                                        <td class="text-truncate">India</td>
                                        <td class="text-truncate">16, July 2021 16:17</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-brand-windows text-info me-2 ti-sm"></i>
                                            <strong>Chrome on Windows</strong>
                                        </td>
                                        <td class="text-truncate">HP Spectre 360</td>
                                        <td class="text-truncate">Switzerland</td>
                                        <td class="text-truncate">20, July 2021 21:01</td>
                                    </tr>
                                    <tr>
                                        <td class="text-truncate">
                                            <i class="ti ti-brand-android text-success me-2 ti-sm"></i>
                                            <strong>Chrome on Android</strong>
                                        </td>
                                        <td class="text-truncate">Oneplus 9 Pro</td>
                                        <td class="text-truncate">Dubai</td>
                                        <td class="text-truncate">21, July 2021 12:22</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/ Recent Devices -->
                </div>
            </div>

        </div>
    </div>
@endsection
@push('admin_scipt')
    <script src="{{ asset('admin') }}/assets/js/pages-account-settings-security.js"></script>
@endpush
