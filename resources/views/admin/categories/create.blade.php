<div class="col-md-12">
    {!! Form::open(['id' => 'create-category']) !!}
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="name">Name</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();", 'required', 'maxlength' => 20]) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="slug">Slug</label>
                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'required']) !!}
            </div>
            <div class="col-md-4 form-group">
                <label for="">Parent</label>
                <select name="parent_id" id="" class="form-control">
                    <option value="0">None</option>
                    {{ showOptionsCategories($optionCategories) }}
                </select>
            </div>
        </div>
        <button type="reset" class="btn btn-default" id="submit-button">Reset</button>
        <button type="submit" class="btn btn-info" id="submit-button">Save</button>
    {!! Form::close() !!}
</div>
