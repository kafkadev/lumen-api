<div class="col-md-12">
    {!! Form::open(['id' => 'edit-category']) !!}
        {!! Form::hidden('id', $category->id, ['id' => 'category-id']) !!}
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();", 'required', 'maxlength' => 20]) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="slug">Slug</label>
                {!! Form::text('slug', $category->slug, ['class' => 'form-control', 'id' => 'slug', 'required']) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="">Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="0">None</option>
                    {{ showOptionsCategories($optionCategories, $category->parent_id) }}
                </select>
            </div>
        </div>
        <a class="btn btn-default" href="{{ url('admin/categories') }}">Cancel</a>
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>
