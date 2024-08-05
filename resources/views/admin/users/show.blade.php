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
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Tên người dùng</label>
                                    <input type="text" class="form-control" id="employeeName" name="name"
                                    value="{{ $user->name }}">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="employeeName" name="username"
                                    value="{{ $user->username }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="employeeEmail" name="email"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="employeePhone" name="phone"
                                        value="{{ $user->phone }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="employeeName" name="address"
                                        value=" {{ $user->address }}">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Giới thiệu</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="introduct">{{ $user->introduct }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="formFile" class="form-label">Ảnh đại diện</label>
                                    <img class="m-3" src="{{ \Storage::url($user->avatar) }}" alt="" width="100px">
                                    <input class="form-control" type="file" id="formFile" name="avatar">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="employeeName" class="form-label">Vai trò</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="type">
                                    <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin
                                    </option>
                                    <option value="menber" {{ $user->type == 'menber' ? 'selected' : '' }}>Member
                                    </option>
                                </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="employeeName" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" id="employeeName" name="password"
                                    value="{{ $user->password }}">
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
    <script src="https://kit.fontawesome.com/1108eef025.js" crossorigin="anonymous"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var passwordIcon = document.getElementById('password-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
