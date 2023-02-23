@extends('admin.layouts.master')
@section('page_title', 'Add new category')
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
                    Category Setup </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="row g-2">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body pt-sm-0 pb-sm-4">
                        <form action="{{ route('admin.category.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="lang_form col-sm-6 mt-2" id="">
                                <label class="form-label" for="exampleFormControlInput1">Category Name </label>
                                <input type="text" name="name" class="form-control" maxlength="150"
                                    placeholder="New Category" required>
                            </div>
                            <input name="position" value="0" hidden>
                            <div class="col-sm-6">
                                <div>
                                    <div class="text-left m-3">
                                        <img id="viewer" class="img--105"
                                            src="{{ asset('/admin/assets/img/default/img2.jpg') }}" alt="image"
                                            height="50px" width="150px" />
                                    </div>
                                </div>
                                <label class="form-label text-capitalize">category image</label><small class="text-danger">*
                                    ratio 3:1</small>
                                <div class="custom-file">
                                    <label for="customFileEg1" class="btn btn-primary me-2 mb-3" tabindex="0">
                                        <span class="d-none d-sm-block">Upload photo</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" id="customFileEg1" name='image' class="account-file-input"
                                            hidden accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*"
                                            oninvalid="document.getElementById('en-link').click()" />
                                    </label>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="btn--container justify-content-end">
                                    <button type="submit" class="btn btn-primary mt-2">submit</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card--header">
                        <h5 class="card-title">Category Table <span
                                class="badge badge-soft-secondary">{{ $categories->total() }}</span> </h5>
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="input-group">
                                <input id="datatableSearch_" type="search" name="search" maxlength="255"
                                    class="form-control pl-5" placeholder="Search_by_Name" aria-label="Search"
                                    value="{{ $search }}" required autocomplete="off">
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
                                <th>category_image</th>
                                <th>name</th>
                                <th>status</th>
                                <th class="text-center">action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td class="text-center">{{ $categories->firstItem() + $key }}</td>
                                    <td>
                                        <img src="{{ asset('storage/uploads/category') }}/{{ $category['image'] }}"
                                            onerror="this.src='{{ asset('/admin/assets/img/default/img2.jpg') }}'"
                                            class="img--50 ml-3" width="150" height="50" alt="">
                                    </td>
                                    <td>
                                        <span class="d-block font-size-sm text-body text-trim-50">
                                            {{ $category['name'] }}
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

                    <table>
                        <tfoot>
                            {!! $categories->links() !!}
                        </tfoot>
                    </table>

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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
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
