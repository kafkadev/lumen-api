@extends('admin.layouts.app')

@section('content')
    @include('errors.error_html')
    @include('success.showing_success')
    <div class="col-md-12">
        {!! Form::open(['method' => 'PATCH', 'id' => 'edit-post', 'url' => "admin/post/$post->id", 'files' => true]) !!}
            {!! Form::hidden('post-id', $post->id, ['id' => 'post-id']) !!}
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="title">Title</label>
                            {!! Form::text('title', $post->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();", 'required']) !!}
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="slug">Slug</label>
                            {!! Form::text('slug', $post->slug, ['class' => 'form-control', 'id' => 'slug', 'required']) !!}
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="excerpt">Excerpt</label>
                            {!! Form::textarea('excerpt', $post->excerpt, ['class' => 'form-control', 'rows' => 3, 'required']) !!}
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="content">Content</label>
                            {!! Form::textarea('content', $post->content, ['class' => 'form-control', 'id' => 'content', 'required']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <label for="">Author</label>
                            {!! Form::select('user_id', $users, $post->user_id, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Status</label>
                            {!! Form::select('status', $allStatus, $post->status, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="">Category</label>
                            <select name="category_id" id="" class="form-control">
                                <option value="0">None</option>
                                {{ showOptionsCategories($categories, $post->category_id) }}
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="">Tag</label>
                            @foreach ($tags as $tag)
                                <div class="checkbox">
                                    <label>{!! Form::checkbox('tag', $tag->id, $post->tags->contains($tag->id)) !!} {{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-sm-12 form-group">
                            <label for="">Feature Image</label>
                            {!! Form::file('image', ['id' => 'image', 'class' => 'form-control']) !!}
                            {!! Form::hidden('remove_image', null, ['id' => 'remove-image']) !!}
                            <img id="preview" src="{{ $post->image }}" style="max-width: 100%; max-height: 100%; margin-top: 5px;">
                            <p id="remove-image" style="display: @if ($post->image != null) block @else none @endif"><a style="cursor: pointer">Remove image</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-default" onclick="return confirm('Changes you may not be saved!')" href="{{ url('admin/posts') }}">Cancel</a>
            <button type="reset" onclick="return confirm('Changes you will be deleted!')" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info" id="submit-button">Save</button>
        {!! Form::close() !!}
    </div>
    <!-- /.row -->
@endsection

@section('footer')
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace( 'content' );

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

        $("input#image").change(function (){
            readURL(this);
            $('p#remove-image').css('display', 'block');
        });

        $('p#remove-image').click(function (){
            $('input#image').val('');
            $('img#preview').removeAttr('src');
            $('input#remove-image').val('remove');
            $(this).css('display', 'none');
        });
    </script>
@endsection
