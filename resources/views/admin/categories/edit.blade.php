@extends('admin.layouts.master')
@section('title', 'Edit Category ' . $model->name)
@section('css-libs')
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Dashboard</h1>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a href="{{ route('admin.categories.index') }}">List category</a></li>
                                <li><a href="#">@yield('title')</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>

                        <div class="card-body">

                            <div class="card-body card-block">
                                <form action="{{ route('admin.categories.update', $model->id) }}" method="post"
                                    enctype="multipart/form-data" class="form-horizontal">
                                    @csrf
                                    @method('PUT') <!-- Corrected syntax here -->

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Name Category</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" value="{{ $model->name }}"
                                                placeholder="Enter category name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                                        <div class="col-sm-10">
                                            <input type="file" id="cover" name="cover" class="form-control-file">
                                            <img src="{{ \Storage::url($model->cover) }}" alt="" width="100px" class="mt-3">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_active" class="col-sm-2 col-form-label">Is Active</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" value="1"
                                                    @if ($model->is_active) checked @endif name="is_active">
                                                <label for="is_active" class="form-check-label">Active</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Submit
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('js-libs')

    <script src="{{ asset('theme/admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/init/datatables-init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
@endsection
