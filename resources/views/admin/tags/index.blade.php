@extends('admin.layouts.app')

@section('content')
    @include('errors.error_html')
    @if (isset($tag))
        @include('admin.tags.edit')
    @else
        @include('admin.tags.create')
    @endif
    <div class="col-md-12 row-grid">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th align="center">Posts</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td align="right"><a href="{{ url("admin/tag/$tag->id/posts") }}">{{ $tag->posttags->count() }}</a></td>
                            <td align="center">
                                {!! Form::open(['method' => 'DELETE', 'url' => "admin/tag/$tag->id"]) !!}
                                    <a href="{{ url("admin/tag/$tag->id/edit") }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this tag?')"><i class="fa fa-trash-o "></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        $('#create-tag').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url : ADMIN_URL + "/tag",
                data : form_data,
                success: function(response) {
                    alert('New tag created!');
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var tagErrors = '';
                    $.each(err, function( index, value ) {
                        tagErrors += '<li>';
                        tagErrors += value[0];
                        tagErrors += '</li>';
                    });
                    $('.alert.alert-danger ul').html(tagErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });

        var tagId = $('#tag-id').val();
        $('#edit-tag').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serialize();
            $('#submit-button').attr('disabled', 'disabled');
            $.ajax({
                type: "PATCH",
                url : ADMIN_URL + "/tag/" + tagId,
                data : form_data,
                success: function(response) {
                    alert('Tag updated!');
                    window.location.reload(true);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var tagErrors = '';
                    $.each(err, function( index, value ) {
                        tagErrors += '<li>';
                        tagErrors += value[0];
                        tagErrors += '</li>';
                    });
                    $('.alert.alert-success').css('display', 'none');
                    $('.alert.alert-danger ul').html(tagErrors);
                    $('.alert.alert-danger').css('display', 'block');
                    $('#submit-button').removeAttr('disabled');
                }
            });
        });
    </script>
@endsection
