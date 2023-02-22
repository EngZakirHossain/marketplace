@extends('admin.layouts.master')
@section('page_title', 'Permission')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Permission</h4>
            <!-- Hoverable Table rows -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center me-2 my-3">
                    <h5 class="card-header">Permission List</h5>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons"><button class="dt-button add-new btn btn-primary mb-3 mb-md-0" tabindex="0"
                                aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                data-bs-target="#addPermissionModal"><span>Add
                                    Permission</span></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Module Name</th>
                                <th>Permission To</th>
                                <th>Updated Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($permissions as $permission)
                                <tr>
                                    <td><strong>{{ $permissions->firstItem() + $loop->index }}</strong> </td>
                                    <td>{{ $permission->module->module_name }}</td>
                                    <td><span class="badge bg-label-primary me-1">{{ $permission->permission_slug }}</span>
                                    </td>
                                    <td> {{ $permission->updated_at->format('d-M-y') }} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <button class="dropdown-item" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editPermissionModal{{ $permission->id }}"><i
                                                        class="ti ti-pencil me-1"></i><span>Edit</span>
                                                </button>

                                                <form
                                                    action="{{ route('admin.permission.destroy', $permission->permission_slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item show_confirm"
                                                        id="confirm-color">
                                                        <i class="ti ti-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <!-- Edit Permission Modal -->
                                    <div class="modal fade" id="editPermissionModal{{ $permission->id }}" tabindex="1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content p-3 p-md-5">
                                                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="modal-body">
                                                    <div class="text-center mb-4">
                                                        <h3 class="mb-2">Edit Permission</h3>
                                                        <p class="text-muted">Edit permission as per your
                                                            requirements.</p>
                                                    </div>
                                                    <form
                                                        action="{{ route('admin.permission.update', $permission->permission_slug) }}"
                                                        id="editPermissionForm{{ $permission->permission_slug }}"
                                                        class="row" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12 mb-3">
                                                            <label for="select2Basicedit" class="form-label">Select
                                                                Module</label>
                                                            <div class="position-relative">
                                                                <select id="select2Basicedit" name="module_id"
                                                                    class="form-control form-select form-select-lg"
                                                                    data-allow-clear="true"
                                                                    data-select2-id="select2Basicedit" tabindex="-1"
                                                                    aria-hidden="true">
                                                                    @foreach ($modules as $module)
                                                                        <option class="form-control"
                                                                            value="{{ $module->id }}"
                                                                            @if ($module->id == $permission->module_id) selected @endif>
                                                                            {{ $module->module_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label class="form-label" for="permission_name">Permission
                                                                Name</label>
                                                            <input type="text" id="permission_name"
                                                                name="permission_name"
                                                                value="{{ $permission->permission_name }}"
                                                                class="form-control" placeholder="Permission Name" autofocus
                                                                @error('permission_name') is-invalid   @enderror />
                                                            @error('permission_name')
                                                                <span class="is-invalid text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-12 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="corePermission" />
                                                                <label class="form-check-label" for="corePermission"> Set as
                                                                    core permission
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center demo-vertical-spacing">
                                                            <button type="submit"
                                                                class="btn btn-primary me-sm-3 me-1">Update
                                                                Permission</button>
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
                                    <!--/ Edit Permission Modal -->
                                </tr>
                            @empty
                                <td valign="top" colspan="4" class="dataTables_empty">No data available in
                                    table </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row mx-2">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
            <!--/ Hoverable Table rows -->
            <!-- Modal -->
            <!-- Add Permission Modal -->
            <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content p-3 p-md-5">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <h3 class="mb-2">Add New Permission</h3>
                                <p class="text-muted">Permissions you may use and assign to your users.</p>
                            </div>
                            <form action="{{ route('admin.permission.store') }}" id="addPermissionForm" class="row"
                                method="POST">
                                @csrf
                                <div class="col-12 mb-3" data-select2-id="114">
                                    <label for="select2Basic" class="form-label">Select Module</label>
                                    <div class="position-relative" data-select2-id="113">
                                        <select id="select2Basic" name="module_id"
                                            class="select2 form-select form-select-lg select2-hidden-accessible"
                                            data-allow-clear="true" data-select2-id="select2Basic" tabindex="-1"
                                            aria-hidden="true">
                                            @foreach ($modules as $module)
                                                <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="permission_name">Permission Name</label>
                                    <input type="text" id="permission_name" name="permission_name"
                                        class="form-control" placeholder="Permission Name" autofocus
                                        @error('permission_name') is-invalid
                                @enderror />
                                    @error('permission_name')
                                        <span class="is-invalid text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="corePermission" />
                                        <label class="form-check-label" for="corePermission"> Set as core permission
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center demo-vertical-spacing">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Create Permission</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        Discard
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Add Permission Modal -->
            <!-- /Modal -->
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
