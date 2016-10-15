@extends('admin.layouts.app')

@section('content')
    @include('errors.error_html')
    @if (isset($category))
        @include('admin.categories.edit')
    @else
        @include('admin.categories.create')
    @endif
    <div class="col-md-12 row-grid">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th align="center">Posts</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {!! showTableCategories($categories) !!}
                </tbody>
            </table>
        </div>
    </div>
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
                    window.location.reload(true);
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

        var categoryId = $('#category-id').val();
        $('#edit-category').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "PATCH",
                url : ADMIN_URL + "/category/" + categoryId,
                data : form_data,
                success: function(response) {
                    alert('Category updated!');
                    window.location.reload(true);
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
