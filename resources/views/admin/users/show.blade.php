@extends('admin.layouts.master')
@section('title')
    Chi tiết người dùng {{ $user->name }}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Layout</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chi tiết người dùng {{ $user->name }}</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Người dùng - {{ $user->name }}</h4>
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
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Tên</label>
                                <input type="text" class="form-control" id="employeeName" name="name" readonly
                                    value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="employeeName" name="username" readonly
                                    value="{{ $user->username }}">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Email</label>
                                <input type="text" class="form-control" id="employeeEmail" name="email" readonly
                                    value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="employeePhone" name="phone" readonly
                                    value="{{ $user->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Ảnh đại diện</label>
                                <img class="ms-3" src="{{ \Storage::url($user->avatar) }}" alt="" width="100px">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Giới thiệu</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" readonly rows="5" name="introduct"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="employeeName" name="password" readonly
                                    value="{{ $user->password }}">
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Vai trò</label>
                                <input type="text" class="form-control" id="employeeName" name="type" readonly
                                    value="{{ $user->type }}">
                            </div>

                            {{-- <div class="mb-3">
                                <label for="employeeName" class="form-label">Địa chỉ</label>
                                <input type="password" class="form-control" id="employeeName" name="address"
                                    placeholder="Nhập địa chỉ">
                            </div> --}}

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
