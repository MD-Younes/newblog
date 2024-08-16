@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <strong class="card-header">{{ __('Edit Post') }}</strong>

                <div class="card-body">
                    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group my-3">
                            <label class="required" for="title">{{ __('Title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" id="title" value="{{ old('title', $post->title) }}" required>
                            @if($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group my-3">
                            <label class="required" for="description>{{ __('description') }}</label>
                            <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }} type="textarea"
                                name="description" id="description" value="{{ old('description', $post->description) }}" required>
                            @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group my-3">
                            <label class="required" for="image">{{ __('Image') }}</label>
                            <input class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" type="file"
                                name="image" id="image" value="{{ old('image') }}" required>
                            @if($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                            @endif
                            <span class="help-block"> </span>
                        </div>

                        <div class="form-group my-3">
                            <label class="required" for="tags">{{ __('Tags') }}</label>
                            <input class="form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" type="text"
                                name="tags" id="tags" value="{{ old('tags', $tags) }}" required>
                            @if($errors->has('tags'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tags') }}
                            </div>
                            @endif
                            <span class="help-block text-muted">{{ __('Separated by comma') }}</span>
                        </div>

                        <div class="form-group">
                            <label class="required" for="category">{{ __('Category') }}</label>
                            <select class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                name="category" id="category" required>
                                <option value="#">--- {{ __('SELECT CATEGORY') }} ---</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if (in_array($category->id,
                                    $post->category->pluck('id')->toArray())) selected @endif>{{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                            <div class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </div>
                            @endif
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group my-3">
                            <label for="user">{{ __('user') }}</label>
                            <textarea class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}"
                                name="excerpt" id="user">{{ old('user', $post->user) }}</textarea>
                            @if($errors->has('user'))
                            <div class="invalid-feedback">
                                {{ $errors->first('user') }}
                            </div>
                            @endif
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group my-3">
                            <label for="comment">{{ __('comment') }}</label>
                            <textarea class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" name="comment"
                                id="comment">{{ old('comment', $post->comment) }}</textarea>
                            @if($errors->has('comment'))
                            <div class="invalid-feedback">
                                {{ $errors->first('comment') }}
                            </div>
                            @endif
                            <span class="help-block"></span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
