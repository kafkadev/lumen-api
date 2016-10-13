@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Users</h2>
        </div>
        @include('errors.error_html')
        @if (isset($user))
            @include('admin.users.edit')
        @else
            @include('admin.users.create')
        @endif
        <div class="col-md-12 row-grid">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Posts</th>
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
                                <td align="right"><a href="{{ url("admin/user/$user->id/posts") }}">{{ $user->posts->count() }}</a></td>
                                <td>{{ $user->getRoleName() }}</td>
                                <td align="center">
                                    {!! Form::open(['method' => 'DELETE', 'url' => "admin/user/$user->id"]) !!}
                                        <a href="{{ url("admin/user/$user->id/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this user?')"><i class="fa fa-trash-o "></i></button>
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


@section('footer')
    <script type="text/javascript">
        $('#create-user').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url : ADMIN_URL + "/user",
                data : form_data,
                success: function(response) {
                    alert('New user created!');
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var userErrors = '';
                    $.each(err, function( index, value ) {
                        userErrors += '<li>';
                        userErrors += value[0];
                        userErrors += '</li>';
                    });
                    $('.alert.alert-danger ul').html(userErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });

        var userId = $('#user-id').val();
        $('#edit-user').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "PATCH",
                url : ADMIN_URL + "/user/" + userId,
                data : form_data,
                success: function(response) {
                    alert('User updated!');
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var userErrors = '';
                    $.each(err, function( index, value ) {
                        userErrors += '<li>';
                        userErrors += value[0];
                        userErrors += '</li>';
                    });
                    $('.alert.alert-success').css('display', 'none');
                    $('.alert.alert-danger ul').html(userErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });
    </script>
@endsection
