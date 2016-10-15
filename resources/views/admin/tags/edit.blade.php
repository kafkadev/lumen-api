<div class="col-md-12">
    {!! Form::open(['id' => 'edit-tag']) !!}
        {!! Form::hidden('id', $tag->id, ['id' => 'tag-id']) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', $tag->name, ['class' => 'form-control']) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-info">Save</button>
        <a href="{{ url('admin/tags') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>



