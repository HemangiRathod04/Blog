@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Post Edit: {{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea class="form-control" id="content" name="content" rows="5">{{ $post->content }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Post</button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
