<div class="col-md-12">
    {!! Form::open(['id' => 'create-tag']) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-info">Save</button>
        <a href="{{ url('admin/tags') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>



