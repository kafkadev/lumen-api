@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Users List</h2>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><img src="{{ getGravatar($user->email) }}" alt=""></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->getRoleName() }}</td>
                                <td align="center">
                                    {!! Form::open(['method' => 'DELETE', 'url' => "admin/user/$user->id"]) !!}
                                        <a href="{{ url("admin/user/$user->id/edit") }}" class="btn btn-link btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-link btn-xs" onclick="return confirm('Are you sure to delete this user?')"><i class="fa fa-trash-o "></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right">
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
