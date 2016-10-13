<div class="col-md-12">
    {!! Form::open(['id' => 'edit-category']) !!}
        {!! Form::hidden('id', $category->id, ['id' => 'category-id']) !!}
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="slug">Slug</label>
                {!! Form::text('slug', $category->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="">Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="0">None</option>
                    {{ showOptionsCategories($optionCategories, $category->parent_id) }}
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-info">Save</button>
        <button type="reset" class="btn btn-default">Cancel</button>
    {!! Form::close() !!}
</div>
