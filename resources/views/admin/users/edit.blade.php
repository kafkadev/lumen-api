<div class="col-md-12">
    {!! Form::open(['id' => 'edit-user']) !!}
        {!! Form::hidden('id', $user->id, ['id' => 'user-id']) !!}
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', $user->name, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-sm-6 form-group">
                <label for="username">Username</label>
                {!! Form::text('username', $user->username, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                {!! Form::text('email', $user->email, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col-sm-6 form-group">
                <label for="password">Role</label>
                {!! Form::select('role', $roleOptions, $user->role, ['class' => 'form-control']) !!}
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
        <a class="btn btn-default" href="{{ url('admin/users') }}">Cancel</a>
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>
