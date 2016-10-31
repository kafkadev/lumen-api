<div class="col-md-12">
    {!! Form::open(['id' => 'edit-tag']) !!}
        {!! Form::hidden('id', $tag->id, ['id' => 'tag-id']) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', $tag->name, ['class' => 'form-control', 'required', 'maxlength' => 20]) !!}
            </div>
        </div>
        <a class="btn btn-default" href="{{ url('admin/tags') }}">Cancel</a>
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>



