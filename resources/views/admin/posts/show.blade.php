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
    Chi tiết bài viết
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Chi tiết bài viết</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết bài viết</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
                        <div class="row justify-content-center">
                            <div class="col-xxl-9">
                                <div class="card" id="demo">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card-header border-bottom-dashed p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <h3>{{ $post->title }} - {{ $post->sku }}</h3>
                                                    </div>
                                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                        <h5>{{ $post->user->name }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end card-header-->
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="card-body p-4">
                                                <div class="row">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="form-check form-switch form-switch-success">
                                                            {!! $post->is_active
                                                                ? '<span class="badge bg-success">Active</span>'
                                                                : '<span class="badge bg-black">Not active</span>' !!}

                                                            <label class="form-check-label" for="is_active">Is
                                                                active</label>
                                                        </div>

                                                        <div class="form-check form-switch form-switch-danger ms-3">
                                                            {!! $post->is_trending
                                                                ? '<span class="badge bg-danger">Trending</span>'
                                                                : '<span class="badge bg-black">Not trending</span>' !!}
                                                            <label class="form-check-label" for="is_trending">Is
                                                                trending</label>
                                                        </div>

                                                        <div class="form-check form-switch form-switch-warning ms-3">
                                                            {!! $post->is_popular
                                                                ? '<span class="badge bg-warning">Popular</span>'
                                                                : '<span class="badge bg-black">Not popular</span>' !!}
                                                            <label class="form-check-label" for="is_popular">Is
                                                                popular</label>
                                                        </div>

                                                        <div class="form-check form-switch form-switch-secondary ms-3">
                                                            {!! $post->is_show_home
                                                                ? '<span class="badge bg-info">Show home</span>'
                                                                : '<span class="badge bg-black">Not show home</span>' !!}
                                                            <label class="form-check-label" for="is_show_home">Is show
                                                                home</label>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="card-body p-4 border-top border-top-dashed">
                                                <div class="row">
                                                    <div class="text-center">
                                                        <img class="ms-3 mb-3" src="{{ \Storage::url($post->image) }}"
                                                            width="500px">
                                                    </div>
                                                </div>
                                                <!--end row-->
                                            </div>
                                            <!--end card-body-->
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div class="card-body p-4">
                                                <div class="table-responsive">
                                                    <p class="fw-bold">{{ $post->description }}</p>
                                                </div>
                                                <div class="border-top border-top-dashed mt-2">
                                                    <p>{!! $post->content !!}</p>
                                                    <!--end table-->
                                                </div>
                                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                    <a href="javascript:window.print()" class="btn btn-success"><i
                                                            class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                    <a href="javascript:void(0);" class="btn btn-primary"><i
                                                            class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                                </div>
                                            </div>
                                            <!--end card-body-->
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                        </div>
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
