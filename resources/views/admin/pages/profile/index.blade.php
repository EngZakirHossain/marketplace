@extends('admin.layouts.master')
@section('page_title', 'User Profile')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Update Profile</h4>
            <div class="row">
                <div class="col-md-12">
                    @include('admin.pages.profile.profileMenu')
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <form action="{{ route('admin.user.profile.store') }}" id="formAccountSettings" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if ($user->userInfo != null)
                                        <img src="{{ asset('storage/uploads/users') }}/{{ $user->userInfo->user_image }}"
                                            class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                    @else
                                        <img src="{{ asset('admin') }}/assets/img/avatars/1.png" alt="user-avatar"
                                            class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                    @endif

                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                            <span class="d-none d-sm-block">Upload new photo</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" name='user_image'
                                                class="account-file-input" hidden accept="image/png, image/jpeg" />
                                        </label>
                                        {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button> --}}

                                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <input type="hidden" name="id" value="{{ $user->id }}" />
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="firstName" class="form-label">Name</label>
                                        <input class="form-control" type="text" id="firstName" name="name"
                                            value="{{ $user->name }}" autofocus />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input class="form-control" type="text" id="email" name="email"
                                            value="{{ $user->email }}" placeholder="john.doe@example.com" disabled />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="phoneNumber">Phone Number</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text">BD (+88)</span>
                                            <input type="text" id="phoneNumber" name="phone"
                                                @if ($user->userInfo != null) value="{{ $user->userInfo->phone }}" @endif
                                                class="form-control" placeholder="01718 297 506" />
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            @if ($user->userInfo != null) value="{{ $user->userInfo->address }}" @endif
                                            value="" placeholder="Address" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="state" class="form-label">State</label>
                                        <input class="form-control" type="text" id="state" name="state"
                                            @if ($user->userInfo != null) value="{{ $user->userInfo->state }}" @endif
                                            value="" placeholder="Dhaka" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zipCode" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zipCode" name="zipCode"
                                            @if ($user->userInfo != null) value="{{ $user->userInfo->zipCode }}" @endif
                                            value="" placeholder="1200" maxlength="6" />
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
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be
                                    certain.</p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate
                                Account</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@push('admin_scipt')
    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            let form = $(this).closest("form");
            event.preventDefault();
            Swal.fire({
                    title: `Are you sure ?`,
                    text: "You won't able to revert this !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted',
                            'your File Has Been Deleted',
                            'success'
                        )
                    }
                });
        });
    </script>
@endpush
