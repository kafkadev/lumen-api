@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Categories List</h2>
        </div>

        <div class="col-md-12">
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
    </div>
    <!-- /.row -->
@endsection
