@extends('admin.layouts.app')

@section('content')
    @include('success.showing_success')
    <div class="col-md-12">
        <div class="table-responsive row-grid">
            <table class="table table-hover" id="table-comments">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Seen</th>
                        <th>Created At</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $comment)
                        <tr class="gradeU {{ $comment->isRead() ? '' : 'warning' }}">
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>{{ $comment->phone }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#myModal{{ $comment->id }}">Read msg</button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal{{ $comment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">{{ $comment->name }}</h4>
                                              </div>
                                            <div class="modal-body">{!! $comment->msg !!}</div>
                                        </div>
                                    </div>
                                </div>                            
                            </td>
                            <td>
                                {!! Form::open(['method' => 'PATCH', 'url' => "admin/comment/$comment->id"]) !!}
                                    {!! Form::select('seen', $statusSelectOptions, $comment->seen, ['class' => 'form-control', 'onchange' => 'this.form.submit()']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>{{ $comment->created_at }}</td>
                            <td align="center">
                                {!! Form::open(['method' => 'DELETE', 'url' => "admin/comment/$comment->id"]) !!}
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to delete this comment?')"><i class="fa fa-trash-o "></i></button>
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
    <link href="{{ asset('admin/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#table-comments').DataTable({
                columnDefs: [
                    {sortable: false, targets: [6]},
                ],
                "order": [ 5, 'desc' ]
            });

            $('.popover-msg').popover();
        });
    </script>
@endsection
