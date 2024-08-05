@extends('admin.layouts.master')
@section('title')
    Chi tiết danh mục {{ $model->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Layout</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết danh mục</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Danh mục</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="vertical-form-showcode" class="form-label text-muted">Show
                                Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="vertical-form-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Tên danh mục</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $model->name }}">
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <label class="form-check-label mb-0" for="flexSwitchCheckRightDisabled">Trạng
                                        thái</label>
                                    <div class="ms-3">
                                        {!! $model->is_active
                                            ? '<span class="badge bg-success">Active</span>'
                                            : '<span class="badge bg-black">Not active</span>' !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="formFile" class="form-label">Ảnh danh mục</label><br>
                                <img src="{{ \Storage::url($model->cover) }}" alt="" width="100px" class="">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-libs')
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
@endsection
