@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">New Post</h2>
        </div>
        @include('errors.error_html')
        <div class="col-md-12">
            {!! Form::open(['id' => 'create-post', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="title">Title</label>
                                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="slug">Slug</label>
                                {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="excerpt">Excerpt</label>
                                {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="content">Content</label>
                                {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'content']) !!}
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
                                <label for="">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    {{ showOptionsCategories($categories) }}
                                </select>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="">Feature Image</label>
                                {!! Form::file('image', ['id' => 'image', 'class' => 'form-control']) !!}
                                <img id="preview" src="" style="max-width: 100%; max-height: 100%; margin-top: 5px;">
                                <p id="remove-image" style="display: none"><a style="cursor: pointer">Remove image</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Create</button>
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

        $('#create-post').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url : ADMIN_URL + "/post",
                data : form_data,
                success: function(response) {
                    alert('New post created!');
                    window.location.href = ADMIN_URL + '/posts';
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
            $("img#preview").removeAttr('src');
            $(this).css('display', 'none');
        });
    </script>
@endsection
