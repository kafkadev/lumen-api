@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Update Category</h2>
        </div>
        @include('errors.error_html')
        @include('success.showing_success')
        <div class="col-md-12">
            {!! Form::open(['id' => 'edit-category']) !!}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', $category->name, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="slug">Slug</label>
                        {!! Form::text('slug', $category->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Parent</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="0">None</option>
                            {{ showOptionsCategories($categories, $category->parent_id) }}
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Update</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- /.row -->
@endsection

@section('footer')
    <script type="text/javascript">
        function createSlug()
        {
            var str= document.getElementById("name").value;
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

        var categoryId = {{ $category->id }};
        $('#edit-category').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "PATCH",
                url : ADMIN_URL + "/category/" + categoryId,
                data : form_data,
                success: function(response) {
                    $('.alert.alert-danger').css('display', 'none');
                    $('.alert.alert-success span').html('Category updated!');
                    $('.alert.alert-success').css('display', 'block');
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var categoryErrors = '';
                    $.each(err, function( index, value ) {
                        categoryErrors += '<li>';
                        categoryErrors += value[0];
                        categoryErrors += '</li>';
                    });
                    $('.alert.alert-success').css('display', 'none');
                    $('.alert.alert-danger ul').html(categoryErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });
    </script>
@endsection
