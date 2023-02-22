@extends('admin.layouts.master')
@section('page_title', 'Module Edit')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <div class="col">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Module Edit Form</h5>
                        <small class="text-muted float-end">
                            <a class="btn btn-secondary" href="{{ route('admin.module.index') }}">
                                <i class="ti ti-arrow-back-up"></i>
                                Back to module list
                            </a>
                        </small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.module.update', $module->module_slug) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="module_name">Modul Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="module_name" class="input-group-text"><i class="ti ti-building"></i></span>
                                    <input type="text" class="form-control" id="module_name" name="module_name"
                                        placeholder="enter module name" aria-label="module name"
                                        value="{{ $module->module_name }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('admin_scipt')
@endpush
