@extends('theme.app')

@section('content')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    {{-- <header class="intro-header" style="background-image: url('{{ asset('theme/img/post-bg.jpg') }}')"> --}}
    <header class="intro-header" style="background-image: url('{{ $post->image ? $post->image : asset('theme/img/home-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>{{ $post->title }}</h1>
                        {{-- <h2 class="subheading">Problems look mighty small from 150 miles up</h2> --}}
                        <span class="meta">Posted by <a href="#">{{ $post->user->name }}</a> on {{ $post->created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    {!! $post->content !!}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @foreach ($post->tags as $tag)
                        <a style="margin-bottom: 5px;" href="{{ url("tag/$tag->slug/posts") }}" class="btn btn-default">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </article>
@endsection
