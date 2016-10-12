@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Update Post</h2>
        </div>
        @include('errors.error_html')
        @include('success.showing_success')
        <div class="col-md-12">
            {!! Form::open(['id' => 'edit-post', 'files' => true]) !!}
                {!! Form::hidden('post-id', $post->id, ['id' => 'post-id']) !!}
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="title">Title</label>
                                {!! Form::text('title', $post->title, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
                            </div>

                            <div class="col-sm-12 form-group">
                                <label for="slug">Slug</label>
                                {!! Form::text('slug', $post->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                            </div>

                            <div class="col-sm-12 form-group">
                                <label for="excerpt">Excerpt</label>
                                {!! Form::textarea('excerpt', $post->excerpt, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>

                            <div class="col-sm-12 form-group">
                                <label for="content">Content</label>
                                {!! Form::textarea('content', $post->content, ['class' => 'form-control', 'id' => 'content']) !!}
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
                                    {{ showOptionsCategories($categories, $post->category->id) }}
                                </select>
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
                <button type="submit" class="btn btn-info">Save</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            {!! Form::close() !!}
        </div>
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

        var postId = {{ $post->id }};
        $('#edit-post').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            console.log(form_data);
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "PATCH",
                url : ADMIN_URL + "/post/" + postId,
                data: new FormData($("#edit-post")[0]),
                processData: false,
                contentType: false,
                async:false,
                success: function(response) {
                    $('.alert.alert-danger').css('display', 'none');
                    $('.alert.alert-success span').html('Category updated!');
                    $('.alert.alert-success').css('display', 'block');
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var postErrors = '';
                    $.each(err, function( index, value ) {
                        postErrors += '<li>';
                        postErrors += value[0];
                        postErrors += '</li>';
                    });
                    $('.alert.alert-danger ul').html(postErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });

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
