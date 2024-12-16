@extends('layout')

@section('content')
<div class="container">
    <h2 class="mt-4">Comments List</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Post Title</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            @forelse($comments as $comment)
                <tr>
                    <td>{{ $comment->user->name }}</td>
                    <td>{{ optional($comment->post)->title ?? 'Post not available' }}</td>
                    <td>{{ $comment->content }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No comments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
