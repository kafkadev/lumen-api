<div class="col-md-12">
    {!! Form::open(['id' => 'create-category']) !!}
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="slug">Slug</label>
                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="">Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="0">None</option>
                    {{ showOptionsCategories($optionCategories) }}
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-info">Save</button>
        <a href="{{ url('admin/categories') }}" class="btn btn-default">Cancel</a>
    {!! Form::close() !!}
</div>
