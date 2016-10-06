@extends('theme.app')

@section('content')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ asset('theme/img/home-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Personal Blog</h1>
                        <hr class="small">
                        <span class="subheading">A Personal Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        {{-- <div class="row"> --}}
            @foreach ($posts as $post)
                <div class="col-md-6">
                    <div class="post-preview">
                        <a href="{{ url("$post->slug") }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <p><img src="{{ $post->image }}" alt="" width='100%'></p>
                            {{-- <h3 class="post-subtitle">
                                Problems look mighty small from 150 miles up
                            </h3> --}}
                        </a>
                        <p class="post-meta">Posted by <a href="#">{{ $post->user->name }}</a> on {{ $post->created_at }}</p>
                    </div>
                    <hr>
                </div>
            @endforeach
        {{-- </div> --}}
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <!-- Pager -->
                <div class="text-right">
                    {!! $posts->links() !!}
                </div>
                {{-- <ul class="pager">
                    <li class="next">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
@endsection
