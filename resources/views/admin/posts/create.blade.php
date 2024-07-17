@extends('admin.layouts.master')

@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
                <h4 class="mb-sm-0">Thêm mới</h4>
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


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới bài viết</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">
                            <label for="vertical-form-showcode" class="form-label text-muted">Show Code</label>
                            <input class="form-check-input code-switcher" type="checkbox" id="vertical-form-showcode">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">
                            <form action="{{ route('admin.posts.store') }}" method="post" id='insert-form' enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Danh mục bài viết</label>
                                    <select class="js-example-basic-single" name="category_id">
                                        @foreach ($categories as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Tiêu đề bài viết</label>
                                    <input type="text" class="form-control" id="employeeName" name="title"
                                        placeholder="Nhập tên">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Ảnh bài viết</label>
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Mã bài viết</label>
                                    <input type="text" class="form-control" id="employeeName" name="sku"
                                        value="{{ strtoupper(Str::random(5)) }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Tác giả bài viết</label>
                                    <input type="text" class="form-control" id="employeeEmail" name="user_id"
                                        placeholder="Nhập tên tác giả" value="{{ $authorName }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="employeeName" class="form-label">Mô tả ngắn bài viết</label>
                                    <textarea name="description" id="description" class="form-control" rows="2px"></textarea>
                                </div>
                                <div class="mb-3">
                                    {{-- <label for="employeeName" class="form-label">Nội dung bài viết</label> --}}
                                    {{-- <textarea name="content" id="content" class="form-control" rows="5px"></textarea> --}}
                                    <div id="editor-container" style="min-height: 300px;"></div>
                                    <textarea name="content" id="content123" style="display: none;"></textarea>
                                </div>
                                <div class="my-3">
                                    <label for="employeeName" class="form-label">Thẻ bài viết</label>
                                    <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                        @foreach ($tags as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 d-flex justify-content-start">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" value="1" role="switch"
                                            id="is_active" name="is_active" checked>
                                        <label class="form-check-label" for="is_active">Is active</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-danger ms-3">
                                        <input class="form-check-input" type="checkbox" value="1" role="switch"
                                            id="is_trending" name="is_trending">
                                        <label class="form-check-label" for="is_trending">Is trending</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-warning ms-3">
                                        <input class="form-check-input" type="checkbox" value="1" role="switch"
                                            id="is_popular" name="is_popular">
                                        <label class="form-check-label" for="is_popular">Is popular</label>
                                    </div>
                                    <div class="form-check form-switch form-switch-secondary ms-3">
                                        <input class="form-check-input" type="checkbox" role="switch" value="1"
                                            id="is_show_home" name="is_show_home" checked>
                                        <label class="form-check-label" for="is_show_home">Is show home</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'link'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        [{ 'color': [] }, { 'background': [] }]
                    ],
                    handlers: {
                        'image': imageHandler
                    }
                }
            }
        });
        function imageHandler() {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = async function() {
                    var file = input.files[0];

                    try {
                        const options = {
                            maxSizeMB: 0.1,
                            maxWidthOrHeight: 300,
                            useWebWorker: true
                        };

                        const compressedFile = await imageCompression(file, options);

                        var formData = new FormData();
                        formData.append('image', compressedFile);

                        fetch('{{ route('admin.news.uploadImage') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            }).then(response => response.json())
                            .then(result => {
                                if (result.url) {
                                    var range = quill.getSelection();
                                    if (range) {
                                        quill.insertEmbed(range.index, 'image', result.url);
                                    } else {
                                        quill.insertEmbed(quill.getLength(), 'image', result.url);
                                    }
                                } else {
                                    console.error('Failed to upload image');
                                }
                            }).catch(error => {
                                console.error('Error:', error);
                            });
                    } catch (error) {
                        console.error('Error:', error);
                    }
                };
            }

        document.querySelector('#insert-form').onsubmit = function() {
            document.querySelector('#content123').value = quill.root.innerHTML;
        };
    </script>
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/resize-observer-polyfill@1.5.1/dist/ResizeObserver.global.js"></script>
    <script src="https://unpkg.com/browser-image-compression@1.0.14/dist/browser-image-compression.js"></script>
@endsection
