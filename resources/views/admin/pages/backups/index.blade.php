@extends('admin.layouts.master')
@section('page_title', 'Backup Management')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Backup</h4>
            <!-- Hoverable Table rows -->
            <div class="card">
                <div class="d-flex justify-content-between align-items-center me-2 my-3">
                    <h5 class="card-header">Backup List</h5>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons">
                            <button type="button" class="dt-button create-new btn btn-primary" tabindex="0"
                                onclick="event.preventDefault(); document.getElementById('new-backup-form').submit();">
                                <span>
                                    <i class="ti ti-database-export me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block"> New Backup</span>
                                </span>
                            </button>
                            <form action="{{ route('admin.backup.store') }}" method="POST" class="d-none"
                                id="new-backup-form">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Last Updated</th>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($backups as $backup)
                                <tr>
                                    <td>
                                        <strong>{{ $loop->index + 1 }}</strong>
                                    </td>
                                    <td>{{ $backup['created_at'] }}</td>
                                    <td>
                                        {{ $backup['file_name'] }}
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">{{ $backup['file_size'] }} </span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.backup.download', $backup['file_name']) }}">
                                                    <i class="ti ti-download me-1"></i>
                                                    Download
                                                </a>
                                                <form action="{{ route('admin.backup.destroy', $backup['file_name']) }}"
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
                            @empty
                                <strong>No Data Found</strong>
                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->

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
