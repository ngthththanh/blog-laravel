@extends('admin.layouts.master')

@section('title', 'Add new Posts')

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
                                <li><a href="{{ route('admin.posts.index') }}">List category</a></li>
                                <li class="active">@yield('title')</li>
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
                            <strong class="card-title">Add New Category</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.posts.store') }}" method="post"
                                enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control standardSelect"
                                            data-placeholder="Choose a Category..." tabindex="1">
                                            <option value="" label="default">Choose category</option>
                                            @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title Post</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="title" placeholder="Enter title"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sku" class="col-sm-2 col-form-label">Sku</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="sku" name="sku" placeholder="Enter sku"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="image" name="image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="author" name="author" placeholder="Enter author"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-2 col-form-label">Is active</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_active" name="is_active"
                                                class="form-check-input" value="1" checked>
                                            <label for="is_active" class="form-check-label">Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_trending" class="col-sm-2 col-form-label">Is trending</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_trending" name="is_trending"
                                                class="form-check-input" value="1">
                                            <label for="is_trending" class="form-check-label">Trending</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_popular" class="col-sm-2 col-form-label">Is popular</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_popular" name="is_popular"
                                                class="form-check-input" value="1">
                                            <label for="is_popular" class="form-check-label">Popular</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_show_home" class="col-sm-2 col-form-label">Is show home</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_show_home" name="is_show_home"
                                                class="form-check-input" value="1">
                                            <label for="is_show_home" class="form-check-label">Show home</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <select name="tags[]" id="tags" data-placeholder="Choose a tag..."
                                            class="form-control">
                                            <option value="">Choose tag</option>
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('js-libs')

@endsection
