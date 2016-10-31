<div class="col-md-12">
    {!! Form::open(['id' => 'create-tag']) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 20]) !!}
            </div>
        </div>
        <button type="reset" class="btn btn-default" id="submit-button">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>



