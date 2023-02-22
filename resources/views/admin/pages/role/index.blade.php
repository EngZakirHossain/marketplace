@extends('admin.layouts.master')
@section('page_title', 'Role')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Role List</h4>
            <p class="mb-4">
                A role provided access to predefined menus and features so that depending on <br />
                assigned role an administrator can have access to what user needs.
            </p>
            <!-- Role cards -->
            <div class="row g-4">
                @forelse ($roles as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="fw-normal mb-2">Total {{ count($role->user) }} {{ $role->role_name }}</h6>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach ($role->user as $euser)
                                            <?php
                                            $userInfo = App\Models\UserInfo::where('user_id', $euser->id)->first();
                                            ?>
                                            @if ($userInfo != null)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="{{ $euser->name }}"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('storage/uploads/users') }}/{{ $userInfo->user_image }}"
                                                        alt="{{ $euser->name }}" />
                                                </li>
                                            @else
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="{{ $euser->name }}"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="{{ asset('admin') }}/assets/img/avatars/1.png"
                                                        alt="{{ $euser->name }}" />
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1">
                                    <div class="role-heading">
                                        <h4 class="mb-1">{{ $role->role_name }}</h4>
                                        <a href="{{ route('admin.role.edit', $role->role_slug) }}"
                                            class="role-edit-modal"><span>Edit Role</span></a>
                                    </div>
                                    <a href="javascript:void(0);" class="text-muted"><i
                                            class="menu-icon tf-icons ti ti-fingerprint"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <span>No Data Found</span>
                @endforelse

                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card h-100">
                        <div class="row h-100">
                            <div class="col-sm-5">
                                <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                    <img src="{{ asset('admin') }}/assets/img/illustrations/add-new-roles.png"
                                        class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="83" />
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body text-sm-end text-center ps-sm-0">
                                    <a href="{{ route('admin.role.create') }}" type="button"
                                        class="btn btn-primary mb-2 text-nowrap add-new-role">
                                        Add New Role
                                    </a>
                                    <p class="mb-0 mt-1">Add role, if it does not exist</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <!-- Role Table -->
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role Name</th>
                                        <th>Permission To</th>
                                        <th>Updated Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td><strong>{{ $loop->index + 1 }}</strong> </td>
                                            <td>{{ $role->role_name }}</td>
                                            <td>
                                                @foreach ($role->permissions->chunk(6) as $key => $chunks)
                                                    <div class="col m-1">
                                                        @foreach ($chunks as $permission)
                                                            <span
                                                                class="badge bg-label-primary me-1">{{ $permission->permission_slug }}</span>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td> {{ $role->updated_at->format('d-M-y') }} </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        @can('edit-role')
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.role.edit', $role->role_slug) }}">
                                                                <i class="ti ti-pencil me-1"></i> Edit
                                                            </a>
                                                        @endcan

                                                        @if ($role->is_deleteable && Auth::user()->hasPermission('delete-role'))
                                                            <form
                                                                action="{{ route('admin.role.destroy', $role->role_slug) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item show_confirm"
                                                                    id="confirm-color">
                                                                    <i class="ti ti-trash me-1"></i>
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        @endif

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Edit role Modal -->
                                        <div class="modal fade" id="editroleModal{{ $role->role_slug }}" tabindex="1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content p-3 p-md-5">
                                                    <button type="button" class="btn-close btn-pinned"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-4">
                                                            <h3 class="mb-2">Edit role</h3>
                                                            <p class="text-muted">Edit role as per your
                                                                requirements.</p>
                                                        </div>
                                                        <form action="{{ route('admin.role.update', $role->role_slug) }}"
                                                            id="editroleForm" class="row" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-12 mb-3" data-select2-id="114">
                                                                <label for="select2Basic" class="form-label">Select
                                                                    Module</label>
                                                                <div class="position-relative" data-select2-id="113">
                                                                    <select id="select2Basic" name="module_id"
                                                                        class="select2 form-select form-select-lg select2-hidden-accessible"
                                                                        data-allow-clear="true"
                                                                        data-select2-id="select2Basic" tabindex="-1"
                                                                        aria-hidden="true">
                                                                        {{-- @foreach ($modules as $module)
                                                                            <option value="{{ $module->id }}"
                                                                                @if ($module->id == $role->module_id) selected @endif>
                                                                                {{ $module->module_name }}</option>
                                                                        @endforeach --}}
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label" for="role_name">role
                                                                    Name</label>
                                                                <input type="text" id="role_name" name="role_name"
                                                                    value="{{ $role->role_name }}" class="form-control"
                                                                    placeholder="role Name" autofocus
                                                                    @error('role_name') is-invalid   @enderror />
                                                                @error('role_name')
                                                                    <span class="is-invalid text-danger" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="corerole" />
                                                                    <label class="form-check-label" for="corerole"> Set as
                                                                        core role
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 text-center demo-vertical-spacing">
                                                                <button type="submit"
                                                                    class="btn btn-primary me-sm-3 me-1">Update
                                                                    role</button>
                                                                <button type="reset" class="btn btn-label-secondary"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    Discard
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Edit role Modal -->
                                    @empty
                                        <td valign="top" colspan="4" class="dataTables_empty">No data available in
                                            table </td>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="row mx-2">
                                {{ $roles->links() }}
                            </div>
                        </div>
                    </div>
                    <!--/ Role Table -->
                </div>
            </div>
            <!--/ Role cards -->

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
