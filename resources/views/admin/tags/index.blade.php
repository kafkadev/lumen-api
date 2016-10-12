@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Categories List</h2>
        </div>

        <div class="col-md-12">
            <p><a href="{{ url('admin/tag/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New</a></p>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Tag</th>
                            <th align="center">Posts</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td align="center">
                                    {!! Form::open(['method' => 'DELETE', 'url' => "admin/tag/$tag->id"]) !!}
                                        <a href="{{ url("admin/tag/$tag->id/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this tag?')"><i class="fa fa-trash-o "></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
