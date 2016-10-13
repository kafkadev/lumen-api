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
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
        <a href="{{ url('admin/users') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>
