@extends('admin.layouts.master')

@section('title')
    Edit Post - {{ $post->title }}
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
                                <li><a href="{{ route('admin.posts.index') }}">List Posts</a></li>
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
                            <strong class="card-title">Edit Post</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Choose category</option>
                                            @foreach ($categories as $id => $name)
                                                <option value="{{ $id }}" {{ $id == $post->category_id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="title" value="{{ ( $post->title) }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="sku" class="col-sm-2 col-form-label">Sku</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="sku" name="sku" value="{{( $post->sku) }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Current Image</label>
                                    <div class="col-sm-10">
                                        <img src="{{ \Storage::url($post->image) }}" alt="" width="100px">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_image" class="col-sm-2 col-form-label">New Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="new_image" name="new_image" class="form-control-file">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="author" name="author" value="{{ ( $post->author) }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" id="description" cols="30" rows="10">{{ ($post->description) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" id="content" cols="30" rows="10">{{ ($post->content) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_active" class="col-sm-2 col-form-label">Is active</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $post->is_active ? 'checked' : '' }}>
                                            <label for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_trending" class="col-sm-2 col-form-label">Is trending</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_trending" name="is_trending" value="1" {{ $post->is_trending ? 'checked' : '' }}>
                                            <label for="is_trending">Trending</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_popular" class="col-sm-2 col-form-label">Is popular</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_popular" name="is_popular" value="1" {{ $post->is_popular ? 'checked' : '' }}>
                                            <label for="is_popular">Popular</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="is_show_home" class="col-sm-2 col-form-label">Is show home</label>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input type="checkbox" id="is_show_home" name="is_show_home" value="1" {{ $post->is_show_home ? 'checked' : '' }}>
                                            <label for="is_show_home">Show on Home</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tags" class="col-sm-2 col-form-label">Tags</label>
                                    <div class="col-sm-10">
                                        <select name="tags[]" id="tags" class="form-control">
                                            @foreach ($tags as $id => $name)
                                                <option value="{{ $id }}" {{ in_array($id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
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
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('js-libs')

@endsection
