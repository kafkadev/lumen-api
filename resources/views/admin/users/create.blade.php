@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">New User</h2>
        </div>
        @include('errors.error_html')
        <div class="col-md-12">
            {!! Form::open(['id' => 'create-user']) !!}
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="username">Username</label>
                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="email">Email</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="password">Role</label>
                        {!! Form::select('role', $roleOptions, null, ['class' => 'form-control']) !!}
                        <span class="help-block">
                            <strong></strong>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="password">Password</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
                </div>
                <button type="submit" class="btn btn-info" id="submit-button">Create</button>
            {!! Form::close() !!}
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
                    window.location.href = ADMIN_URL + '/users';
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
    </script>
@endsection
