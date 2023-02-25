@extends('admin.layouts.master')
@section('page_title', 'Product List')
@push('admin_style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/libs/dropzone/dropzone.css" />
@endpush
@section('admin_content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="{{ asset('public/assets/admin/img/add-product.png') }}" class="w--24" alt="">
                </span>
                <span>
                    Add New Product
                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <form action="{{ route('admin.product.store') }}" method="post" id="product_form" enctype="multipart/form-data"
            class="row g-2">
            @csrf
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body mt-2">
                        <div id="form">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">Name
                                </label>
                                <input type="text" name="name[]" class="form-control" placeholder="New Product"
                                    required>
                            </div>
                            <input type="hidden" name="lang[]" value="en">
                            <div class="form-group mt-2">
                                <label class="input-label" for="exampleFormControlInput1">Short
                                    Description</label>
                                <textarea name="description[]" class="form-control" id="hiddenArea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body mt-2">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">Category<span
                                            class="text-danger">*</span></label>
                                    <select name="category_id" class="form-control js-select2-custom"
                                        onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-categories')">
                                        <option value="">---select---</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlSelect1">sub_category<span
                                            class="input-label-secondary"></span></label>
                                    <select name="sub_category_id" id="sub-categories"
                                        class="form-control js-select2-custom"
                                        onchange="getRequest('{{ url('/') }}/admin/product/get-categories?parent_id='+this.value,'sub-sub-categories')">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">unit</label>
                                    <select name="unit" class="form-control js-select2-custom">
                                        <option value="kg">kg</option>
                                        <option value="gm">gm</option>
                                        <option value="ltr">ltr</option>
                                        <option value="pc">pc</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">capacity</label>
                                    <input type="number" min="0" step="0.01" value="1" name="capacity"
                                        class="form-control" placeholder="Ex : 54ml" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">product image <small class="text-danger">* ( ratio 1:1 )</small></h5>
                        <div class="product--coba">
                            <div class="row g-2" id="coba"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-dollar"></i>
                            </span>
                            <span>
                                price_information
                            </span>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="p-2">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">default_unit_price</label>
                                        <input type="number" min="0" max="100000000" step="any"
                                            value="1" name="price" class="form-control" placeholder="Ex : 349"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">product_stock</label>
                                        <input type="number" min="0" max="100000000" value="0"
                                            name="total_stock" class="form-control" placeholder="Ex : 100">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">discount_type</label>
                                        <select name="discount_type" id="discount_type"
                                            class="form-control js-select2-custom">
                                            <option value="percent">percent</option>
                                            <option value="amount">amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">discount <span
                                                id="discount_symbol">(%)</span></label>
                                        <input type="number" min="0" max="100000" value="0"
                                            name="discount" step="any" id="discount" class="form-control"
                                            placeholder="Ex : 5%" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">tax_type</label>
                                        <select name="tax_type" id="tax_type" class="form-control js-select2-custom">
                                            <option value="percent">percent</option>
                                            <option value="amount">amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">tax_rate <span
                                                id="tax_symbol">(%)</span></label>
                                        <input type="number" min="0" value="0" step="0.01"
                                            max="100000" name="tax" class="form-control" placeholder="Ex : $ 100"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-puzzle"></i>
                            </span>
                            <span>
                                attribute
                            </span>
                        </h5>
                    </div>
                    <div class="card-body pb-0">
                        <div class="form-group __select-attr">
                            <label class="input-label" for="exampleFormControlSelect1">Select attribute<span
                                    class="input-label-secondary"></span></label>
                            <select name="attribute_id[]" id="choice_attributes" class="form-control js-select2-custom"
                                multiple="multiple">
                                @foreach (\App\Models\Attribute::orderBy('name')->get() as $attribute)
                                    <option value="{{ $attribute['id'] }}">{{ $attribute['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="customer_choice_options" id="customer_choice_options"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="variant_combination" id="variant_combination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="btn--container justify-content-end">
                    <a href="" class="btn btn-danger min-w-120px">reset</a>
                    <button type="submit" class="btn btn-primary">submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('admin_scipt')
    <script>
        $('#product_form').on('submit', function() {


        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '{{ route('admin.product.store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('product uploaded successfully!')
                }
            }
            ', {
            CloseButton: true,
            ProgressBar: true
        });
        setTimeout(function() {
            location.href = '{{ route('admin.product.list') }}';
        }, 2000);
        }
        }
        });
        });
    </script>

    <script type="text/javascript">
        $(function() {
                    $("#coba").spartanMultiImagePicker({
                            fieldName: 'images[]',
                            maxCount: 4,
                            rowHeight: '150px',
                            groupClassName: '',
                            maxFileSize: '',
                            placeholderImage: {
                                image: '{{ asset('/admin/assets/svg/illustrations/sorry.svg') }}',
                                width: '100%'
                            },
                            dropFileLabel: "Drop Here",
                            onAddRow: function(index, file) {

                            },
                            onRenderedPreview: function(index) {

                            },
                            onRemoveRow: function(index) {

                            },
                            onExtensionErr: function(index, file) {
                                toastr.error('Please only input png or jpg type file')
                            }
                        }
                        ', {
                        CloseButton: true,
                        ProgressBar: true
                    });
            },
            onSizeErr: function(index, file) {
                toastr.error('File size too big')
            }
        }
        ', {
        CloseButton: true,
            ProgressBar: true
        });
        }
        });
        });
    </script>

    <script>
        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }
    </script>

    <script>
        $(document).on('ready', function() {
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>


    <script>
        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="row g-1"><div class="col-md-3 col-sm-4"><input type="hidden" name="choice_no[]" value="' +
                i + '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="Choice Title" readonly></div><div class="col-lg-9 col-sm-8"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="Enter choice values" data-role="tagsinput" onchange="combination_update()"></div></div>'
            );
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        function combination_update() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{ route('admin.product.variant-combination') }}',
                data: $('#product_form').serialize(),
                success: function(data) {
                    $('#variant_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }
    </script>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $('#product_form').on('submit', function() {

        var myEditor = document.querySelector('#editor')
        $("#hiddenArea").val(myEditor.children[0].innerHTML);

        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '{{ route('admin.product.store') }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.errors) {
                    for (var i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('product uploaded successfully!')
                }
            }
            ', {
            CloseButton: true,
            ProgressBar: true
        });
        setTimeout(function() {
            location.href = '{{ route('admin.product.list') }}';
        }, 2000);
        }
        }
        });
        });
    </script>
@endpush
