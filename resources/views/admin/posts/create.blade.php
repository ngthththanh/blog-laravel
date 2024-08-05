@extends('admin.layouts.master')

@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Thêm mới bài viết
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới bài viết</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới bài viết</h4>
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
                        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data"
                            novalidate class="needs-validation">
                            @csrf
                            <div class="row">

                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label" for="title">Tiêu đề bài viết</label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                                    name="title" value="{{ old('title') }}">
                                                @error('title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="image">Ảnh bài viết</label>
                                                <input class="form-control" id="image" type="file" name="image"
                                                    accept="image/png, image/gif, image/jpeg">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="sku">Mã bài viết</label>
                                                <input type="text" class="form-control" id="sku" name="sku"
                                                    value="{{ strtoupper(Str::random(5)) }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="description">Mô tả ngắn bài viết</label>
                                                <textarea name="description" id="description" class="form-control" rows="2"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="content">Nội dung bài viết</label>
                                                <textarea class="form-control" name="content" id="content"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-check form-switch form-switch-success">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            role="switch" id="is_active" name="is_active" checked>
                                                        <label class="form-check-label" for="is_active">Is active</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-check form-switch form-switch-danger ms-3">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            role="switch" id="is_trending" name="is_trending">
                                                        <label class="form-check-label" for="is_trending">Is
                                                            trending</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-check form-switch form-switch-warning ms-3">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                            role="switch" id="is_popular" name="is_popular">
                                                        <label class="form-check-label" for="is_popular">Is
                                                            popular</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-check form-switch form-switch-secondary ms-3">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            value="1" id="is_show_home" name="is_show_home" checked>
                                                        <label class="form-check-label" for="is_show_home">Is show
                                                            home</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Danh mục bài viết</h5>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <label for="category_id" class="form-label">Danh mục</label>
                                                <select class="js-example-basic-single" name="category_id">
                                                    @foreach ($categories as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Thẻ bài viết</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="tags" class="form-label">Thẻ</label>
                                                <select class="js-example-basic-multiple" name="tags[]"
                                                    multiple="multiple">
                                                    @foreach ($tags as $id => $name)
                                                        <option value="{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Tác giả</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="user_id" class="form-label">Tên</label>
                                                <input type="text" class="form-control" id="user_id" name="user_id"
                                                    value="{{ $authorName }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
