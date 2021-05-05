@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="modal-header">
            <h1>{{ count($posts) . ' post(s)' }}</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($posts as $post)
                <div class="card">
                    <div class="card-body">
                        <div class="article">
                            <a href="{{ url('posts/' . $post->id) }}" class="article-heading">{{ $post->title }}, {{ $post->created_at }}</a>
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ url('posts/' . $post->id) }}" class="float-right">Read more</a>
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
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
