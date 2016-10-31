<div class="col-md-12">
    {!! Form::open(['id' => 'create-user']) !!}
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'minlength' => 5, 'maxlength' => 15]) !!}
            </div>
            <div class="col-sm-6 form-group">
                <label for="username">Username</label>
                {!! Form::text('username', null, ['class' => 'form-control', 'required', 'minlength' => 5, 'maxlength' => 15]) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
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
                {!! Form::password('password', ['class' => 'form-control', 'required', 'minlength' => 5]) !!}
            </div>
            <div class="col-sm-6 form-group">
                <label for="password_confirmation">Password Confirmation</label>
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required', 'minlength' => 5]) !!}
            </div>
        </div>
        <button type="reset" class="btn btn-default" id="submit-button">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>
