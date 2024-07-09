@extends('admin.layouts.master')

@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- quill css -->
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    Cập nhật bài viết {{ $post->title }}
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Cập nhật</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Cập nhật bài viết {{ $post->title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('admin.posts.update', $post->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Bài viết - {{ $post->title }}</h4>
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
                                <!-- Row 1 -->
                                <div class="mb-3">
                                    <label class="form-label">Danh mục bài viết</label>
                                    <select class="js-example-basic-single" name="category_id">
                                        @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}" {{ $id == $post->category_id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" id="employeeName" name="title"
                                        value="{{ ( $post->title) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Ảnh bài viết</label>
                                    <img class="ms-3 mb-3" src="{{ \Storage::url($post->image) }}" width="100px">

                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Mã bài viết</label>
                                    <input type="text" class="form-control" id="employeeName" name="sku" value="{{ $post->sku }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Slug bài viết</label>
                                    <input type="text" class="form-control" id="employeeName" name="sku" value="{{ $post->slug }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Tác giả</label>
                                    <input type="text" class="form-control" id="employeeEmail" name="author" placeholder="Nhập tên tác giả" value="{{ $post->author }}">
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Mô tả ngắn</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="5" name="description">{{ $post->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Nội dung</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="5" name="content">{{ $post->content }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Thẻ bài viết</label>
                                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                        @foreach ($tags as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Row 2 -->
                                <div class="mb-3 d-flex justify-content-start">
                                    <div class="form-check form-switch form-switch-success">
                                        <input type="hidden" name="is_active" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                            @if ($post->is_active) checked @endif name="is_active" value="1">
                                        <label class="form-check-label" for="is_active">Trạng thái</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-danger ms-3">
                                        <input type="hidden" name="is_trending" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_trending" name="is_trending" value="1">
                                        <label class="form-check-label" for="is_trending">Is trending</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-warning ms-3">
                                        <input type="hidden" name="is_popular" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_popular" name="is_popular" value="1">
                                        <label class="form-check-label" for="is_popular">Is popular</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-secondary ms-3">
                                        <input type="hidden" name="is_show_home" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_show_home" name="is_show_home" value="1" checked>
                                        <label class="form-check-label" for="is_show_home">Is show home</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
@section('script-libs')
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- select2 cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!-- quill js -->
    <script src="{{ asset('theme/admin/assets/libs/quill/quill.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('theme/admin/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
@endsection
