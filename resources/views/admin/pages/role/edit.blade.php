@extends('admin.layouts.master')
@section('page_title', 'Role Edit')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Role Edit Form</h5>
                        <small class="text-muted float-end">
                            <a class="btn btn-secondary" href="{{ route('admin.role.index') }}">
                                <i class="ti ti-arrow-back-up"></i>
                                Back
                            </a>
                        </small>
                    </div>
                    <div class="card-body">
                        <!-- Add role form -->
                        <form action="{{ route('admin.role.update', $role->role_slug) }}" id="addRoleForm" class="row g-3"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-12 mb-4">
                                <label class="form-label" for="role_name">Role Name</label>
                                <input type="text" id="role_name" name="role_name" value="{{ $role->role_name }}"
                                    class="form-control" placeholder="Enter a role name" tabindex="-1" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Role Note</span>
                                <textarea class="form-control" name="role_note"aria-label="With textarea" placeholder="Comment">{{ $role->role_note }}</textarea>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="select-all">
                                <label class="form-check-label" for="select-all">Select All</label>
                            </div>
                            <div class="col-12">
                                <h5 class="@error('permissions') is-invalid  @enderror">Assign Permission for Role</h5>
                                @error('permissions')
                                    <span class="is-invalid text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            @foreach ($modules->chunk(2) as $key => $chunks)
                                                @foreach ($chunks as $module)
                                                    <tr>
                                                        <td class="text-nowrap fw-semibold">
                                                            {{ $module->module_name }}
                                                            <i class="ti ti-info-circle" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="Allows a full access to the system"></i>
                                                        </td>
                                                        <td>
                                                            {{-- Module permission List --}}
                                                            <div class="d-flex">
                                                                @foreach ($module->permissions as $permission)
                                                                    <div class="form-check me-3 me-lg-5 me-sm-1">
                                                                        <input class="form-check-input" name="permissions[]"
                                                                            value="{{ $permission->id }}" type="checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            @if (isset($role)) @foreach ($role->permissions as $rpermission)
                                                                                {{ $rpermission->id == $permission->id ? 'checked' : '' }}
                                                                                @endforeach @endif />
                                                                        <label class="form-check-label"
                                                                            for="permission_{{ $permission->id }}">
                                                                            {{ $permission->permission_name }} </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <a href="{{ route('admin.role.index') }}" type="button" class="btn btn-label-secondary">
                                    Cancel
                                </a>
                            </div>
                        </form>
                        <!--/ Add role form -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('admin_scipt')
    <script>
        //listern for click on select all item
        $('#select-all').click(function(event) {
            if (this.checked) {
                //loop for check box
                $(':checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                })
            }
        });
    </script>
@endpush
