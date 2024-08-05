@extends('client.layouts.master')

@section('title')
    Chi tiết bài viết {{ $post->title }}
@endsection
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9   mb-5 mb-lg-0">
                    <article>
                        <div class="post-slider mb-4">
                            @if (isset($post->image))
                                <img src="{{ \Storage::url($post->image) }}" class="card-img-top" alt="post-thumb">
                            @else
                                <!-- Nếu không có ảnh, có thể để trống src -->
                            @endif
                        </div>

                        <h1 class="h2">{{ $post->title }}</h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="author-single.html" class="card-meta-author">
                                    <img src="images/john-doe.jpg">
                                    <span>{{ $post->author }}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-timer"></i>10 phút đọc
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    @foreach ($post->tags as $tag)
                                        <li class="list-inline-item"><a href="tags.html">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="content">
                            <p class="fw-bolder">{{ $post->description }}</p>
                            <p>{!! $post->content !!}</p>
                        </div>
                    </article>

                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-4">Bình luận</h3>
                        <div class="comment-section" style="max-height: 300px; overflow-y: auto;">
                            @foreach ($post->comments as $comment)
                                <div class="media d-block d-sm-flex mb-4 pb-4">
                                    <div class="media-body">
                                        <a href="#!" class="h4 d-inline-block mb-3">{{ $comment->user->name }}</a>
                                        <p>{{ $comment->content }}</p>
                                        <span class="text-black-800 mr-3 font-weight-600">{{ $comment->created_at }}</span>
                                        <a class="text-primary font-weight-600" href="#!">Reply</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4">Viết bình luận</h3>
                        @auth
                            <form action="{{ route('comments.addcomment', $post->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control shadow-none" name="content" rows="7" required></textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Bình luận</button>
                            </form>
                        @else
                            <div class="alert alert-warning">
                                Bạn chưa đăng nhập. <a href="{{ route('login') }}">Đăng nhập</a> để bình luận.
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
