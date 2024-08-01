@extends('client.layouts.master')
@section('title')
    Danh mục 
@endsection
@section('content')
    <h1>Kết quả tìm kiếm</h1>

    @if(isset($results) && $results->isNotEmpty())
        <ul>
            @foreach($results as $result)
                <li>
                    <a href="">{{ $result->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Không tìm thấy kết quả nào.</p>
    @endif
@endsection
