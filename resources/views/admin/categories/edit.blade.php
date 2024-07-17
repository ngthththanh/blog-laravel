@extends('admin.layouts.master')
@section('title')
    Cập nhật {{ $model->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Cập nhật danh mục {{ $model->name }}</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Danh mục - {{ $model->name }}</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="vertical-form-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="vertical-form-showcode">
                        </div>
                    </div>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('admin.categories.update', $model->id) }}" method="post"
                            enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control" id="employeeName" name="name"
                                    value="{{ $model->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh danh mục</label>
                                <input class="form-control" type="file" id="formFile" name="cover">
                                <img src="{{ \Storage::url($model->cover) }}" alt="" width="100px" class="mt-3">
                            </div>
                            <div class="form-check form-switch form-switch-success form-check-right mb-3">
                                <input type="hidden" name="is_active" value="0"> <!-- Add this hidden input -->
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                    @if ($model->is_active) checked @endif name="is_active" value="1">
                                <label class="form-check-label" for="is_active">Trạng thái</label>
                            </div>

                            <div class="mb-3">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script-libs')
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
@endsection
