@extends('admin.layouts.app')

@section('content')
    <div class="col-md-12">
        <a href="{{ url('admin/post/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New</a>
    </div>
    <div class="col-md-12">
        <div class="table-responsive row-grid">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Categories</th>
                        <th>Tags</th>
                        <th>Publish</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="gradeU">
                            <td><a href="{{ url("$post->slug") }}">{{ $post->title }}</a></td>
                            <td><a href="{{ url('admin/user/' . $post->user_id . '/posts') }}">{{ $post->user->name }}</a></td>
                            <td>
                                @if (isset($post->category))
                                    <a href="{{ url('admin/category/' . $post->category_id . '/posts') }}">{{ $post->category->name }}</a>
                                @endif
                            </td>
                            <td>
                                @foreach ($post->tags as $tag)
                                    <li><a href="{{ url('admin/tag/' . $tag->id . '/posts') }}">{{ $tag->name }}</a></li>
                                @endforeach
                            </td>
                            <td>{{ $post->getStatus() }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td align="center">
                                {!! Form::open(['method' => 'DELETE', 'url' => "admin/post/$post->id"]) !!}
                                    <a href="{{ url("admin/post/$post->id/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this post?')"><i class="fa fa-trash-o "></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-right">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
