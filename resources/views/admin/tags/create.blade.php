@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">New Category</h2>
        </div>
        @include('errors.error_html')
        <div class="col-md-12">
            {!! Form::open(['id' => 'create-category']) !!}
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="name">Name</label>
                        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'onkeyup' => "createSlug();", 'onchange' => "createSlug();"]) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="slug">Slug</label>
                        {!! Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) !!}
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="">Parent</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="0">None</option>
                            {{ showOptionsCategories($categories) }}
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Save</button>
                <a href="{{ url('admin/categories') }}" class="btn btn-default">Cancel</a>
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

        $('#create-category').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url : ADMIN_URL + "/category",
                data : form_data,
                success: function(response) {
                    alert('New category created!');
                    window.location.href = ADMIN_URL + '/categories';
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var categoryErrors = '';
                    $.each(err, function( index, value ) {
                        categoryErrors += '<li>';
                        categoryErrors += value[0];
                        categoryErrors += '</li>';
                    });
                    $('.alert.alert-danger ul').html(categoryErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });
    </script>
@endsection
