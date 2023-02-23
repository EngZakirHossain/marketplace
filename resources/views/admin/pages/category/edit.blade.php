@extends('admin.layouts.master')
@section('page_title', 'Edit new category')
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
                    @if ($category->parent_id == 0)
                        Category Update
                    @else
                        Sub Category Update
                    @endif
                </span>
            </h1>
        </div>
        <!-- End Page Header -->


        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.category.update', $category->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="lang_form col-sm-6 mt-2 mb-2" id="">
                        <label class="form-label" for="exampleFormControlInput1">Category Name </label>
                        <input type="text" name="name" value='{{ $category->name }}' class="form-control"
                            maxlength="150" placeholder="New Category" required>
                    </div>
                    <input name="position" value="0" hidden>
                    @if ($category->parent_id == 0)
                        <div class="col-sm-6">
                            <div class="text-left m-3">
                                <img class="img-105" id="viewer"
                                    onerror="this.src='{{ asset('/admin/assets/img/default/img2.jpg') }}'"
                                    src="{{ asset('storage/uploads/category') }}/{{ $category->image }}" alt="image"
                                    height="50px" width="150px" />
                            </div>
                            <label></label><small style="color: red">Image Ration* 3:1 </small>
                            <div class="custom-file">
                                <label for="customFileEg1" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Upload photo</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="customFileEg1" name='image' class="account-file-input"
                                        hidden accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" />
                                </label>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="btn--container justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>

@endsection

@push('admin_scipt')
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
@endpush
