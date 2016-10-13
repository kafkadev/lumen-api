<div class="col-md-12">
    {!! Form::open(['id' => 'create-category']) !!}
        <div class="row">
            <div class="col-md-12 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-info">Save</button>
        <a href="{{ url('admin/categories') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>



