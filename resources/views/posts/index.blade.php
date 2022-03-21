@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>List of posts</h4>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="{{ route('create.post') }}" class="btn btn-success">Add post</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="list-post">
                        <div class="table-upcoming table-history">
                            <table class="table" id="post_list" style="width:100%">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Content</th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @if(count($posts) > 0)
                                    @foreach($posts as $key => $value)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{!! $value->content !!}</td>
                                        <td style="width: 25%">
                                            <a href="{{ route('edit.post', $value->id) }}" class="btn btn-primary">Edit</a>
                                            <a href="#" class="btn btn-danger btn-delete" data-id="{{ $value->id }}" data-url="{{ route('delete.post', $value->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td>No posts</td>
                                        </tr>
                                    @endif
                                </tbody>
                               
                              </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $('.btn-delete').on('click', function(){
            var id = $(this).data('id');
            var url = $(this).data('url');
            console.log(url);
            $.ajax({
                type: "DELETE",
                url: url,
                data: { id: id,  _token: "{{ csrf_token() }}" },
                success:function (result){
                    toastr.success(result.message)
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000);
                    
                },
                error: function (error){

                },
            });
        })
    </script>
@endpush
