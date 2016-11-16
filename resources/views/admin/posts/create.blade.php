@extends('admin.layouts.app')

@section('content')
    @include('errors.error_html')
    <div class="col-md-12">
        {!! Form::open(['method' => 'post', 'url' => 'admin/post', 'id' => 'create-post', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="title">Title</label>
                            {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();", 'required']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="slug">Slug</label>
                            {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug', 'required']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Tag</label>
                            {!! Form::text('tags', null, ['id' => 'tags-input', 'class' => 'form-control', 'data-role' => 'tagsinput']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="excerpt">Excerpt</label>
                            {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="content">Content</label>
                            {!! Form::textarea('content', null, ['class' => 'form-control content', 'id' => 'content', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="">Author</label>
                            {!! Form::select('user_id', $users, Auth::user()->id, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Status</label>
                            {!! Form::select('status', $allStatus, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="0">None</option>
                                {{ showOptionsCategories($categories) }}
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Feature Image</label>
                            {!! Form::file('image', ['id' => 'image', 'class' => 'form-control', 'accept' => 'image/png, image/jpeg, image/gif']) !!}
                            <img id="preview" src="" style="max-width: 100%; max-height: 100%; margin-top: 5px;">
                            <p id="remove-image" style="display: none"><a style="cursor: pointer">Remove image</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-default" onclick="return confirm('Changes you may not be saved!')" href="{{ url('admin/posts') }}">Cancel</a>
            <button type="reset" onclick="return confirm('Changes you will be deleted!')" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info" id="submit-button">Save</button>
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-tagsinput.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap-tagsinput.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('content');

        function createSlug()
        {
            var str= document.getElementById("title").value;
            str = str.replace(/^\s+|\s+$/g, ''); // trim
            str = str.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "đuúùũụủưứừữựửeéèẽẹẻêếềễệểoóòõọỏôồốỗộổơớờỡợởaàáãạảăằắặẵẳâấầậẫẩiíìĩịỉyýỳỹỵỷ·/_,:;";
            var to   = "duuuuuuuuuuuueeeeeeeeeeeeooooooooooooooooooaaaaaaaaaaaaaaaaaaiiiiiiyyyyyy------";
            for (var i = 0, l = from.length ; i < l ; i++) {
                str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

            document.getElementById("slug").value = str;
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("form").on('keypress', function(e) {
            if (e.which == 13) {
                return false;
            }
        });

        $("input#image").on('change', function (){
            readURL(this);
            $('p#remove-image').css('display', 'block');
        });

        $('p#remove-image').on('click', function (){
            $('input#image').val('');
            $("img#preview").removeAttr('src');
            $(this).css('display', 'none');
        });
    </script>
@endsection
