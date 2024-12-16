@extends('layout')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <p>{{ $post->content }}</p>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Back to Posts</a>
                </div>
                <div class="coment-bottom bg-white p-2 px-4">
                    <div class="add-comment-section mt-4 mb-4">
                        <input type="text" id="comment-input" class="form-control mr-3" placeholder="Add comment">
                        <button class="btn btn-primary" id="add-comment" type="button">Comment</button>
                    </div>
                    <div id="comments-list">
                        @foreach($post->comments as $comment)
                        <div class="commented-section mt-2" id="comment-{{ $comment->id }}">
                            <div class="d-flex flex-row align-items-center commented-user">
                                <h5 class="mr-2">{{ $comment->user->name }}</h5>
                                <span class="dot mb-1"></span>
                                <span class="mb-1 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                <button class="btn btn-link edit-comment" data-id="{{ $comment->id }}"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-link text-danger delete-comment" data-id="{{ $comment->id }}"><i class="fas fa-trash-alt"></i></button>
                            </div>
                            <div class="comment-text-sm"><span>{{ $comment->content }}</span></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#add-comment').click(function() {
            var commentContent = $('#comment-input').val();
            var postId = {{$post->id}};

            $.ajax({
                url: '{{ route('comment.store') }}',
                method: 'POST',
                data: {
                    content: commentContent,
                    post_id: postId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#comment-input').val('');
                    $('#comments-list').append(`
                    <div class="commented-section mt-2" id="comment-${response.id}">
                        <div class="d-flex flex-row align-items-center commented-user">
                            <h5 class="mr-2">${response.user.name}</h5>
                            <span class="dot mb-1"></span>
                            <span class="mb-1 ml-2">${response.created_at}</span>
                            <button class="btn btn-link edit-comment" data-id="${response.id}">Edit</button>
                            <button class="btn btn-link text-danger delete-comment" data-id="${response.id}">Delete</button>
                        </div>
                        <div class="comment-text-sm"><span>${response.content}</span></div>
                    </div>
                `);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $(document).on('click', '.edit-comment', function() {
            var commentId = $(this).data('id');
            var commentElement = $(`#comment-${commentId}`);
            var currentContent = commentElement.find('.comment-text-sm span').text();

            commentElement.find('.comment-text-sm').html(`
            <input type="text" id="edit-comment-input-${commentId}" value="${currentContent}" class="form-control">
            <button class="btn btn-success save-comment" data-id="${commentId}">Save</button>
        `);
        });

        $(document).on('click', '.save-comment', function() {
            var commentId = $(this).data('id');
            var updatedContent = $(`#edit-comment-input-${commentId}`).val();
            $.ajax({
                url: '{{ route('comment.update', '') }}/' + commentId,
                method: 'POST',
                data: {
                    content: updatedContent,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var commentElement = $(`#comment-${commentId}`);
                    commentElement.find('.comment-text-sm').html(`<span>${response.content}</span>`);
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-comment', function() {
            var commentId = $(this).data('id');
            $.ajax({
                url: '{{ route('comment.destroy', '') }}/' + commentId,
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $(`#comment-${commentId}`).remove();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection