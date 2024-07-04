@extends('admin.layouts.master')

@section('title')
    Show Post - {{ $post->title }}
@endsection
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
                            <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="category_id" value="{{ $post->category->name }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title Post</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="title" value="{{ $post->title }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sku" class="col-sm-2 col-form-label">Sku</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="sku" name="sku"
                                            value="{{ $post->sku }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="slug" name="slug"
                                            value="{{ $post->slug }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <img src="{{ \Storage::url($post->image) }}" alt="" width="100px">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="author" name="author" value="{{ $post->author }}" readonly
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10" readonly>{{ $post->description }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" id="content" cols="30" rows="10" readonly>{{ $post->content }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-2 col-form-label">Is active</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            {!! $post->is_active ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!} </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_trending" class="col-sm-2 col-form-label">Is trending</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            {!! $post->is_trending
                                                ? '<span class="badge bg-success">Yes</span>'
                                                : '<span class="badge bg-danger">No</span>' !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_popular" class="col-sm-2 col-form-label">Is popular</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            {!! $post->is_popular
                                                ? '<span class="badge bg-success">Yes</span>'
                                                : '<span class="badge bg-danger">No</span>' !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_show_home" class="col-sm-2 col-form-label">Is show home</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            {!! $post->is_show_home
                                                ? '<span class="badge bg-success">Yes</span>'
                                                : '<span class="badge bg-danger">No</span>' !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label">Tag</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="tags" class="form-control" value="{{ $post->tags->pluck('name')->implode(', ') }}" readonly>
                                    </div>
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
