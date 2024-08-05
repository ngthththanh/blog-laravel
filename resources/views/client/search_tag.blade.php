@extends('client.layouts.master')
@section('title')
    Thẻ {{ $tag->name }}
@endsection
@section('content')
    <div class="pt-3"></div>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4">
                    <h1 class="h2 mb-4">Thẻ <mark>{{ $tag->name }}</mark></h1>
                </div>
                <div class="col-lg-10">
                    @foreach ($search_tags as $post)
                        <article class="card mb-4">
                            <div class="row card-body">
                                @if (isset($post->image))
                                    <div class="col-md-4 mb-4 mb-md-0">
                                        <div class="post-slider slider-sm">
                                            <img src="{{ \Storage::url($post->image) }}" class="card-img" alt="post-thumb"
                                                style="height:200px; object-fit: cover;">

                                        </div>

                                    </div>
                                @else
                                @endif
                                <div class="col-md-8">
                                    <h3 class="h4 mb-3"><a class="post-title"
                                            href="{{ route('post_detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                    </h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="" class="card-meta-author">
                                                @if ($post->user->avatar)
                                                    <img src="{{ \Storage::url($post->user->avatar) }}" alt="Author Avatar">
                                                @else
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
                                                    <li class="list-inline-item"><a href="tags.html">{{ $tag->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <p>{{ $post->description }}</p>
                                    <a href="{{ route('post_detail', ['slug' => $post->slug]) }}"
                                        class="btn btn-outline-primary">Read
                                        More</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    <ul class="pagination justify-content-center">
                        @if ($currentPage > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->url() }}?page={{ $currentPage - 1 }}">&raquo;</a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ request()->url() }}?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($currentPage < $totalPages)
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->url() }}?page={{ $currentPage + 1 }}">&raquo;</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

