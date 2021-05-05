@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            @can('isAdmin')
                                    <a href="{{ url("posts/{$post->id}/edit") }}">edit</a>
                                    | <a href="{{ url("posts/{$post->id}/edit") }}"
                                         onclick="if (!confirm('Delete Post?')) { return false;} event.preventDefault();
                              $('.delete-form').submit();">delete
                                    </a>
                                    <!-- delete form -->
                                    <form class="delete-form" action="{{ route('posts.destroy', ['post' => $post]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                            @endcan
                            <div class="row">
                                <!-- Post content-->
                                <div class="col-lg-12">
                                    <!-- Title-->
                                    <h1 class="mt-4">{{ $post->title }}</h1>
                                    <!-- Author-->
                                    <p class="lead">
                                        by
                                        <a href="#!">{{ $post->user->name }}</a>
                                    </p>
                                    <hr />
                                    <!-- Date and time-->
                                    <p>Posted on {{ date('F j, Y', strtotime($post->created_at)) . ' at ' . date('g:i A', strtotime($post->created_at))}}</p>
                                    <hr />
                                    <!-- Preview image-->
                                    <img class="img-fluid rounded" src="https://via.placeholder.com/900x300" alt="..." />
                                    <hr />
                                    <!-- Post content-->
                                    <p class="lead">{!! $post->content !!}</p>
                                    <hr />
                                    <!-- Comments form-->
                                    <div class="card my-4">
                                        <h5 class="card-header">Leave a Comment:</h5>
                                        <div class="card-body">
                                            <form method="POST" action="/comments">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="comment" class="form-control" rows="3"></textarea>
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Single comment-->
                                    @foreach($post->comments as $comment)
                                    <div class="media mb-4">
                                        <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
                                        <div class="media-body">
                                            @php($author = $comment->user->id == $post->user->id ? ' <small class="btn btn-sm btn-secondary">Author</small>' : '')

                                            <h5 class="mt-0">{{ $comment->user->name }} {!! $author !!} <small><i>{{ $comment->created_at->diffForHumans() }}</i></small></h5>
                                            {{ $comment->comment }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
