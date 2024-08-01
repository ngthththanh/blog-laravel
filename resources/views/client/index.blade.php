@extends('client.layouts.master')
@section('title')
    Reader | Hugo Personal Blog
@endsection
@section('content')
    @include('client.layouts.banner')
    <!-- end of banner -->
    <section class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Bài viết mới nhất</h2>
                    @if ($post_new)
                        <article class="card">
                            <div class="post-slider slider-sm">
                                @if ($post_new->image)
                                    <img src="{{ \Storage::url($post_new->image) }}" class="card-img-top" alt="post-thumb">
                                @else
                                    <!-- Nếu không có ảnh, có thể để trống src -->
                                @endif
                            </div>

                            <div class="card-body">
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="{{ route('post_detail',['slug' => $post_new->slug])  }}">{{ $post_new->title }}</a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('post_detail',['slug' => $post_new->slug])  }}"
                                            class="card-meta-author">
                                            @if ($post_new->user->avatar)
                                                <img src="{{ \Storage::url($post_new->user->avatar) }}" alt="Author Avatar">
                                            @else
                                            @endif
                                            <span>{{ $post_new->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i> 10 phút đọc
                                    </li>
                                    <li class="list-inline-item">
                                        <i
                                            class="ti-calendar"></i>{{ \Carbon\Carbon::parse($post_new->created_at)->format('d M, Y') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ($post_new->tags as $tag)
                                                <li class="list-inline-item"><a href="tags.html">{{ $tag->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $post_new->description }}</p>
                                <a href="{{ route('post_detail', ['slug' => $post_new->slug]) }}"
                                    class="btn btn-outline-primary">Đọc thêm</a>
                            </div>
                        </article>
                    @endif
                </div>

                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Bài viết thịnh hành</h2>
                    @foreach ($post_trending as $post)
                        <article class="card mb-4">
                            <div class="card-body d-flex">
                                <div class="post-slider slider-sm">
                                    @if (isset($post->image))
                                        <img src="{{ \Storage::url($post->image) }}" class="card-img-top" alt="post-thumb">
                                    @else
                                        <!-- Nếu không có ảnh, có thể để trống src -->
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <h4><a href="{{ route('post_detail',['slug' => $post->slug]) }}"
                                            class="post-title">{{ $post->title }}</a>
                                    </h4>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i
                                                class="ti-calendar"></i>{{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}
                                        </li>
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-timer"></i>2 phút đọc
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>

                <div class="col-lg-4 mb-5">
                    <h2 class="h5 section-title">Bài viết phổ biến</h2>
                    @if ($post_popular)
                        <article class="card">
                            <div class="post-slider slider-sm">
                                @if (isset($post_popular->image))
                                    <img src="{{ \Storage::url($post_popular->image) }}" class="card-img-top"
                                        alt="post-thumb">
                                @else
                                    <!-- Nếu không có ảnh, có thể để trống src -->
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="h4 mb-3"><a class="post-title"
                                        href="{{ route('post_detail', ['slug' => $post_popular->slug])  }}">{{ $post_popular->title }}</a>
                                </h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route('post_detail',['slug' => $post->slug])  }}"
                                            class="card-meta-author">
                                            @if ($post_new->user->avatar)
                                                <img src="{{ \Storage::url($post_new->user->avatar) }}"
                                                    alt="Author Avatar">
                                            @else
                                            @endif
                                            <span>{{ $post_new->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>2 phút đọc
                                    </li>
                                    <li class="list-inline-item">
                                        <i
                                            class="ti-calendar"></i>{{ \Carbon\Carbon::parse($post_popular->created_at)->format('d M, Y') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ($post_popular->tags as $tag)
                                                <li class="list-inline-item"><a href="tags.html">{{ $tag->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $post_popular->description }}</p>
                                <a href="{{ route('post_detail', ['slug' => $post->slug]) }}"
                                    class="btn btn-outline-primary">Đọc thêm</a>
                            </div>
                        </article>
                    @endif

                </div>
                <div class="col-12">
                    <div class="border-bottom border-default"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-sm">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <h2 class="h5 section-title">Tất cả bài viết</h2>
                    @foreach ($posts as $post)
                        <article class="card mb-4">
                            <div class="post-slider">
                                @if (isset($post->image))
                                    <div class="col-md-4 mb-4 mb-md-0">
                                        <div class="post-slider slider-sm">
                                            <img src="{{ \Storage::url($post->image) }}" class="card-img" alt="post-thumb" style="height:200px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="mb-3"><a class="post-title" href="{{ route('post_detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                                <ul class="card-meta list-inline">
                                    <li class="list-inline-item">
                                        <a href="author-single.html" class="card-meta-author">
                                            @if ($post->user->avatar)
                                                <img src="{{ \Storage::url($post->user->avatar) }}" alt="Author Avatar">
                                            @endif
                                            <span>{{ $post->user->name }}</span>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-timer"></i>10 Min To Read
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ti-calendar"></i>{{ $post->created_at->format('d M, Y') }}
                                    </li>
                                    <li class="list-inline-item">
                                        <ul class="card-meta-tag list-inline">
                                            @foreach ($post->tags as $tag)
                                                <li class="list-inline-item"><a href="tags.html">{{ $tag->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <p>{{ $post->description }}</p>
                                <a href="{{ route('post_detail', ['slug' => $post->slug]) }}" class="btn btn-outline-primary">Read More</a>
                            </div>
                        </article>
                    @endforeach

                    <!-- Thêm phân trang thủ công -->
                    <ul class="pagination justify-content-center">
                        @if ($currentPage > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->url() }}?page={{ $currentPage - 1 }}">&raquo;</a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                <a class="page-link" href="{{ request()->url() }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($currentPage < $totalPages)
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->url() }}?page={{ $currentPage + 1 }}">&raquo;</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <aside class="col-lg-4 sidebar-home">
                    <!-- Search -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Search</span></h4>
                        <form action="#!" class="widget-search">
                            <input class="mb-3" id="search-query" name="s" type="search"
                                placeholder="Type &amp; Hit Enter...">
                            <i class="ti-search"></i>
                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                        </form>
                    </div>

                    <!-- about me -->
                    <div class="widget widget-about">
                        <h4 class="widget-title">Hi, {{ Auth::user()?->name }}!</h4>
                        <img class="img-fluid"
                            src="  {{ auth()->user()?->avatar ? \Storage::url(auth()->user()?->avatar) : asset('images/default-avatar.jpg') }}"
                            alt="Themefisher">
                        <p> {{ Auth::user()?->introduct }}</p>
                        <ul class="list-inline social-icons mb-3">

                            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>

                            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>

                            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>

                            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>

                            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>

                        </ul>
                        <a href="about-me.html" class="btn btn-primary mb-2">About me</a>
                    </div>

                    <!-- Promotion -->
                    <div class="promotion">
                        <img src="images/promotion.jpg" class="img-fluid w-100">
                        <div class="promotion-content">
                            <h5 class="text-white mb-3">Create Stunning Website!!</h5>
                            <p class="text-white mb-4">Lorem ipsum dolor sit amet, consectetur sociis. Etiam nunc amet
                                id dignissim. Feugiat id tempor vel sit ornare turpis posuere.</p>
                            <a href="https://themefisher.com/" class="btn btn-primary">Get Started</a>
                        </div>
                    </div>

                    <!-- authors -->
                    <div class="widget widget-author">
                        <h4 class="widget-title">Authors</h4>
                        <div class="media align-items-center">
                            <div class="mr-3">
                                <img class="widget-author-image"
                                    src="{{ auth()->user()?->avatar ? \Storage::url(auth()->user()?->avatar) : asset('images/default-avatar.jpg') }}">
                            </div>
                            <div class="media-body">
                                <h5 class="mb-1"><a class="post-title" href="author-single.html">
                                        {{ Auth::user()?->name }}</a></h5>
                                <span> {{ Auth::user()?->introduct }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Search -->

                    <div class="widget">
                        <h4 class="widget-title"><span>Never Miss A News</span></h4>
                        <form action="#!" method="post" name="mc-embedded-subscribe-form" target="_blank"
                            class="widget-search">
                            <input class="mb-3" id="search-query" name="s" type="search"
                                placeholder="Your Email Address">
                            <i class="ti-email"></i>
                            <button type="submit" class="btn btn-primary btn-block" name="subscribe">Subscribe
                                now</button>
                            <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                <input type="text" name="b_463ee871f45d2d93748e77cad_a0a2c6d074" tabindex="-1">
                            </div>
                        </form>
                    </div>

                    <!-- categories -->
                    <div class="widget widget-categories">
                        <h4 class="widget-title"><span>Categories</span></h4>
                        <ul class="list-unstyled widget-list">

                            @foreach ($categories as $category)
                                <li><a href="{{ route('search_category', $category->id) }}""
                                        class="d-flex">{{ $category->name }} <small class="ml-auto">({{ $category->posts_count }})</small></a>
                                </li>
                            @endforeach
                        </ul>
                    </div><!-- tags -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Tags</span></h4>
                        <ul class="list-inline widget-list-inline widget-card">
                            @foreach ($tags as $tag)
                                <li class="list-inline-item"><a href="tags.html">{{ $tag }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- recent post -->
                    <div class="widget">
                        <h4 class="widget-title">Recent Post</h4>

                        <!-- post-item -->
                        {{-- <article class="widget-card">
                            <div class="d-flex">
                                <img class="card-img-sm" src="images/post/post-10.jpg">
                                <div class="ml-3">
                                    <h5><a class="post-title" href="post/elements/">Elements That You Can Use In This
                                            Template.</a></h5>
                                    <ul class="card-meta list-inline mb-0">
                                        <li class="list-inline-item mb-0">
                                            <i class="ti-calendar"></i>15 jan, 2020
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article> --}}

                    </div>

                    <!-- Social -->
                    <div class="widget">
                        <h4 class="widget-title"><span>Social Links</span></h4>
                        <ul class="list-inline widget-social">
                            <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ti-youtube"></i></a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
