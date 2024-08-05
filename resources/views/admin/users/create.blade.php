@extends('admin.layouts.master')
@section('title')
    Thêm mới người dùng
@endsection
@section('style-libs')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Thêm mới</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới người dùng</h4>
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
                        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" id="employeeName" name="name"
                                        placeholder="Nhập tên">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="employeeName" name="username"
                                        placeholder="Nhập tên đăng nhập">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="employeeEmail" name="email"
                                        placeholder="Nhập email">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="employeePhone" name="phone"
                                        placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="address" class="form-label">Tỉnh Thành Phố</label>
                                    <select class="js-example-basic-single" id="address" name="address">
                                        <option value="">Chọn tỉnh thành phố</option>
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->name }}">{{ $address->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Giới thiệu</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="introduct"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="employeeName" name="password"
                                        placeholder="Nhập mật khẩu">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" id="employeeName"
                                        name="password-confirm" placeholder="Nhập xác nhận mật khẩu">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Ảnh đại diện</label>
                                    <input class="form-control" type="file" id="formFile" name="avatar">
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Vai trò</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="type">
                                        <option selected value="menber">Member</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>

                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Thêm </button>
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
@endsection
