@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') . __('(jQuery)') }}</div>

                <div class="card-body">
                    @foreach($posts as $post)
                        <div class="card mb-3">
                            <div class="card-header">{{ $post->title }}</div>
                            <div class="card-body">
                                <p class="card-text">{{ $post->full_text }}</p>
                                <hr />
                                <div class="likes text-right" data-post-id="{{ $post->id }}">
                                    <a href="#" class="like{{ auth()->check() && $post->ratings->where('pivot.type', 'like')->count() ? ' active' : '' }}">
                                        <i class="fa-regular fa-thumbs-up"></i> <span class="count">{{ $post->likes_count }}</span>
                                    </a>
                                    <a href="#" class="dislike{{ auth()->check() && $post->ratings->where('pivot.type', 'dislike')->count() ? ' active' : '' }}">
                                        <i class="fa-regular fa-thumbs-down"></i> <span class="count">{{ $post->dislikes_count }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </hr>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.likes a {
    font-size: 1rem;
    color: #cccccc;
    padding-left: 0.5rem;
}
.likes a:hover {
    color: #777777;
}
.likes .active {
    color: #999999;
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module">
$(function() {
    $('.likes a').click(function (e) {
        var _token   = $('meta[name="csrf-token"]').attr('content');
        var type     = $(this).hasClass('like') ? 'like' : 'dislike';
        var post_id  = $(this).parent('.likes').data('post-id');
        var $parent  = $(this).parent('.likes');

        $.post("{{ route('posts.ratePost') }}", {
                _token,
                type,
                post_id
            })
            .done((data) => {
                $parent.children('a').removeClass('active');
                $parent.find('.like .count').text(data.likes);
                $parent.find('.dislike .count').text(data.dislikes);

                if (!data.detached && !data.unrated) {
                    $(this).addClass('active');
                } else if (data.detached && !data.unrated) {
                    $(this).addClass('active');
                }

                Swal.fire({
				    title: '{{ __('Success!') }}',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: '{{ __('OK') }}'
                });
            })
            .fail(({responseJSON}) => {
                var message = responseJSON.errors && responseJSON.errors[Object.keys(responseJSON.errors)[0]] ?
                    responseJSON.errors[Object.keys(responseJSON.errors)[0]][0] :
                    responseJSON.message;

                Swal.fire({
                    title: '{{ __('Error!') }}',
                    text: message,
                    icon: 'error',
                    confirmButtonText: '{{ __('OK') }}'
                });
            });

    });
})
</script>
@endsection
