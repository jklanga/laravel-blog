@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" rows="3" class="form-control tinymce-editor">
                        {!! $post->content !!}
                    </textarea>

                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
