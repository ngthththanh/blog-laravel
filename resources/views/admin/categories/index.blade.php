@extends('admin.layouts.master')

@section('title', 'List Category')

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
                                <li><a href="#">Dashboard</a></li>
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
                        <div class="card-header d-flex justify-content-between">
                            <strong class="card-title ">Data Table</strong>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.categories.create') }}">Add new</a>
                        </div>

                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Cover</th>
                                        <th>Is Active</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ Storage::url($item->cover) }}" alt="Cover Image"
                                                    width="100px">
                                            </td>
                                            <td>{!! $item->is_active
                                                ? '<span class="badge bg-success">Active</span>'
                                                : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                            <td>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.categories.show', $item->id) }}">Show</a>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.categories.edit', $item->id) }}">Edit</a>

                                                <form action="{{ route('admin.categories.destroy', $item->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
