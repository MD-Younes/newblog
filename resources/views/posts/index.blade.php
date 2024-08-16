@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($posts as $post)
        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="{{ route('posts.show', $post) }}">
                    @if($post->image)
                    <img src="{{ asset('storage/uploads/' . $post->image) }}" class="card-img-top">
                    @else
                    <img src="{{ asset('no_image.jpg') }}" class="card-img-top" alt="No Image">
                    @endif
                </a>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="text-muted">{{ $post->created_at->format('d F Y') }}</div>
                        <div class="">
                            <a href="#" class="font-weight-bolder text-info">{{ $post->category->name }}</a>
                        </div>
                    </div>
                    <a href="{{ route('posts.show', $post) }}" class="font-weight-bold text-success">
                        <h5 class="card-title">{{ $post->title }}</h5>
                    </a>
                    <p class="card-text text-muted">{{ $post->user }}</p>
                    <p class="card-textarea">{{ $post->description }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-outline-primary">{{ __('comment/tags') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
