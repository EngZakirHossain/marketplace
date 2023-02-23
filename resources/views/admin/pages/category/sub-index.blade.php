@extends('admin.layouts.master')
@section('page_title', 'Add Sub Category')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/category.png') }}" class="w--24" alt="">
                </span>
                <span>
                    sub_category_setup
                </span>
            </h1>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="post">
                            @csrf
                            <div class="col-sm-6 lang_form" id="">
                                <label class="form-label" for="exampleFormControlInput1">Sub_category
                                    name</label>
                                <input type="text" name="name" class="form-control mb-3"
                                    placeholder="New Sub Category" required>
                            </div>
                            <input name="position" value="1" hidden>
                            <div class="col-sm-6">
                                <div class="col-12 mb-3" data-select2-id="114">
                                    <label for="select2Basic" class="form-label">Select Category</label>
                                    <div class="position-relative" data-select2-id="113">
                                        <select id="select2Basic" name="parent_id"
                                            class="select2 form-select form-select-lg select2-hidden-accessible"
                                            data-allow-clear="true" data-select2-id="select2Basic" tabindex="-1"
                                            aria-hidden="true">
                                            @foreach (\App\Models\Category::where('position', 0)->get() as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="btn--container justify-content-end mt-2">
                                    <button type="submit" class="btn btn-primary">submit</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card--header">
                        <h5 class="card-title">Sub Category Table <span
                                class="badge badge-soft-secondary">{{ $categories->total() }}</span> </h5>
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" class="form-control pl-5"
                                    placeholder="Search_by_Name" aria-label="Search" value="{{ $search }}" required
                                    autocomplete="off">
                                <i class="tio-search tio-input-search"></i>
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text">
                                        search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>main category</th>
                                <th>sub_category</th>
                                <th>status</th>
                                <th class="text-center">action</th>
                            </tr>

                        </thead>

                        <tbody id="set-rows">
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td class="text-center">{{ $categories->firstItem() + $key }}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{ $category->parent->name }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{ $category->name }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="select-all"
                                                onclick="status_change_alert('{{ route('admin.category.status', [$category->id, $category->status ? 0 : 1]) }}', '{{ $category->status ? 'you want to disable this category' : 'you want to active this category' }}', event)"
                                                class="toggle-switch-input" id="stocksCheckbox{{ $category->id }}"
                                                {{ $category->status ? 'checked' : '' }}>
                                        </div>

                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.category.edit', $category->id) }}">
                                                    <i class="ti ti-pencil me-1"></i>Edit</a>
                                                <form action="{{ route('admin.category.delete', $category->id) }}"
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
                            @endforeach
                        </tbody>
                    </table>

                    @if (count($categories) == 0)
                        <div class="text-center p-4">
                            <img class=" mb-3" height="140"
                                src="{{ asset('/admin/assets/svg/illustrations/sorry.svg') }}" alt="Image Description">
                            <p class="mb-0">No_data_to_show</p>
                        </div>
                    @endif

                    <div class="page-area">
                        <table>
                            <tfoot>
                                {!! $categories->links() !!}
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
@endsection

@push('admin_scipt')
    <script>
        function status_change_alert(url, message, e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#107980',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
    </script>

    <script>
        $('#search-form').on('submit', function() {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.category.search') }}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        });
    </script>
    <script>
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
