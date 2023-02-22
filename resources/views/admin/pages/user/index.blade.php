@extends('admin.layouts.master')
@section('page_title', 'User')
@push('admin_style')
@endpush
@section('admin_content')

    <div class="row">
        <div class="col">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row g-4 mb-4">
                    <div class="col-sm-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span>Total Register User</span>
                                        <div class="d-flex align-items-center my-1">
                                            <h4 class="mb-0 me-2">{{ $users->count() }}</h4>
                                            <span class="text-success">(+{{$users->where('created_at', '>=', Carbon\Carbon::now()->subdays(30))->count()}} )</span>
                                        </div>
                                        <span> Last Month analytics</span>
                                    </div>
                                    <span class="badge bg-label-primary rounded p-2">
                                        <i class="ti ti-user ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span>Active Users</span>
                                        <div class="d-flex align-items-center my-1">
                                            <h4 class="mb-0 me-2">{{ $users->where('is_active', 1)->count() }}</h4>
                                            <span class="text-success">({{ round(($users->where('is_active', 1)->count() / $users->count()) * 100)}}%)</span>
                                        </div>
                                        <span>Active data analytics</span>
                                    </div>
                                    <span class="badge bg-label-success rounded p-2">
                                        <i class="ti ti-user-check ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span>In-Active Users</span>
                                        <div class="d-flex align-items-center my-1">
                                            <h4 class="mb-0 me-2">{{ $users->where('is_active', 0)->count() }}</h4>
                                            <span class="text-success">({{ round(($users->where('is_active', 0)->count() / $users->count()) * 100)}}%)</span>
                                        </div>
                                        <span>In-active data analytics</span>
                                    </div>
                                    <span class="badge bg-label-danger rounded p-2">
                                        <i class="ti ti-user-plus ti-sm"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Users List Table -->
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-3">Search Filter</h5>
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons">
                                <button class="dt-button add-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasAddUser"><span><i
                                            class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                                            class="d-none d-sm-inline-block">Add New User</span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Updated Date</th>
                                    <th>Assign As </th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($users as $user)
                                    <tr>
                                        <td><strong>{{ $loop->index + 1 }}</strong> </td>
                                        <td> {{ $user->updated_at->format('d-M-y') }} </td>
                                        <td><span class="badge bg-label-primary me-1">{{ $user->role->role_name }}</span>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="form-check form-switch mb-2">
                                                <input class="form-check-input toggle-class" type="checkbox"
                                                    data-id="{{ $user->id }}" id="user_{{ $user->id }}"
                                                    {{ $user->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button class="dropdown-item add-new" tabindex="0"
                                                        aria-controls="DataTables_Table_0" type="button"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasAddUser{{ $user->id }}"><i
                                                            class="ti ti-pencil me-1"></i>Edit
                                                    </button>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
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
                                    </tr>
                                    <!-- Edit User  Modal -->
                                    <div class="offcanvas offcanvas-end" tabindex="-1"
                                        id="offcanvasAddUser{{ $user->id }}" aria-labelledby="offcanvasAddUserLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Update User</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                                            <form class="add-new-user pt-0"
                                                action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label" for="add-user-fullname">Name</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid  @enderror"
                                                        id="add-user-fullname" placeholder="Zakir Hossain" name="name"
                                                        value="{{ $user->name }}" aria-label="John Doe" />
                                                    @error('name')
                                                        <span class="is-invalid text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="add-user-email">Email</label>
                                                    <input type="email" id="add-user-email" name="email"
                                                        value="{{ $user->email }}"
                                                        class="form-control @error('email') is-invalid  @enderror"
                                                        placeholder="zakir.doe@example.com"
                                                        aria-label="zakir.doe@example.com" />
                                                    @error('email')
                                                        <span class="is-invalid text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" id="password" value="{{ $user->password }}"
                                                        class="form-control @error('password') is-invalid  @enderror"
                                                        placeholder="enter user password  " name="password" />
                                                    @error('password')
                                                        <span class="is-invalid text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label" for="user-role">User Role</label>
                                                    <select id="user-role" class="form-select" name="role_id">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}"
                                                                @if ($role->id == $user->role_id) selected @endif>
                                                                {{ $role->role_name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-primary me-sm-3 me-1 data-submit">Update</button>
                                                <button type="reset" class="btn btn-label-secondary"
                                                    data-bs-dismiss="offcanvas">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!--/ Edit User Modal -->
                                @empty
                                    <td valign="top" colspan="4" class="dataTables_empty">No data available in
                                        table </td>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row mx-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                    <!-- Offcanvas to add new user -->
                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                        aria-labelledby="offcanvasAddUserLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                            <form class="add-new-user pt-0" action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="add-user-fullname">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid  @enderror"
                                        id="add-user-fullname" placeholder="Zakir Hossain" name="name"
                                        aria-label="John Doe" />
                                    @error('name')
                                        <span class="is-invalid text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="add-user-email">Email</label>
                                    <input type="email" id="add-user-email"
                                        class="form-control @error('email') is-invalid  @enderror"
                                        placeholder="zakir.doe@example.com" aria-label="zakir.doe@example.com"
                                        name="email" />
                                    @error('email')
                                        <span class="is-invalid text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password"
                                        class="form-control @error('password') is-invalid  @enderror"
                                        placeholder="enter user password  " name="password" />
                                    @error('password')
                                        <span class="is-invalid text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="user-role">User Role</label>
                                    <select id="user-role" class="form-select" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->role_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                                <button type="reset" class="btn btn-label-secondary"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </form>
                        </div>
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

    <script>
        //status change
        $(function() {
            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('admin.user.is_active') }}',
                    data: {
                        'is_active': is_active,
                        'user_id': item_id
                    },
                    success: function(data){
                console.log(data);
                Swal.fire({
                    title: `${ data.message}`,
                    text: `${ data.message }`,
                    icon: `${data.type}`,
                })
            },
            errro: function(err){
                if(err){
                    console.log(err);
                }
            }
        });
        });
    });
    </script>
@endpush
