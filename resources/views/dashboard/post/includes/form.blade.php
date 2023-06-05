<div class="form-wrapper">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ old('title') ?? $post->title }}" class="form-input" autofocus>
    <div class="form-error">{{ $errors->first('title') }}</div>
</div>
<div class="form-wrapper">
    <label for="description">Description</label>
    <textarea name="description" >{{ old('description') ?? $post->description }}</textarea>
    <div class="form-error">{{ $errors->first('description') }}</div>
</div>
<div class="form-wrapper">
    <label for="body">Body</label>
    <textarea name="body">{{ old('body') ?? $post->body }}</textarea>
    <div class="form-error">{{ $errors->first('body') }}</div>
</div>
<div class="form-wrapper">
    <label for="category_id">Choose category</label>
    <select name="category_id" value="{{ old('category_id') }}" class="form-select">
        <option selected disabled="">Select category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
            {{ $category->title }}
        </option>
        @endforeach
    </select>
    <div class="form-error">{{ $errors->first('category_id') }}</div>
</div>
<div class="form-wrapper">
    <label for="image">Set image</label>
    <input type="file" name="image" value="" class="form-image">
    <div class="form-error">{{ $errors->first('image') }}</div>
</div>
@if ($post->photo)
<div class="form-wrapper">
    <div class="post-image">	
        <img src="{{ Storage::url($post->photo->path) }}"  alt="{{ $post->title }}">
        <div class="post-image-overlay">
            <a href="{{ route('photo.delete', ['id' => $post->photo->id]) }}" class="action-button-delete">
                Delete
            </a>
        </div>	
    </div>
</div>
@endif
<div class="form-wrapper">
    <label for="photo_source">Photo source</label>
    <input type="text" name="photo_source" value="{{ old('photo_source') ?? $post->photo_source }}" class="form-input">
    <div class="form-error">{{ $errors->first('photo_source') }}</div>
</div>

<div class="form-wrapper">
    <label>Select status</label>
    <label class="radio-container">Unpublished
        <input type="radio" name="published" class="form-radio" value="0"@if(old('published',$post->published)=="0") checked @endif>
        <span class="radio-checkmark"></span>
    </label>
    @can('publish', \App\Models\Post::class)
    <label class="radio-container">Published
        <input type="radio" name="published" class="form-radio" value="1"@if(old('published',$post->published)=="1") checked @endif>
        <span class="radio-checkmark"></span>
    </label>
    @endcan
    <div class="form-error">{{ $errors->first('published') }}</div>
</div>
<div class="form-wrapper">
    <label for="time_to_read">Time to read</label>
    <input type="number" name="time_to_read" value="{{ old('time_to_read') ?? $post->time_to_read }}" min="2" max="10" class="form-input">
    <div class="form-error">{{ $errors->first('time_to_read') }}</div>
</div>
<div class="form-wrapper">
    <label for="tag_id">Choose tags</label>
    <select name="tag_id[]" class="tag-select-for-post" multiple="multiple">
        @foreach ($tags as $tag)
        <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
            {{ $tag->title }}
        </option>
        @endforeach
    </select>
</div>
<div class="form-wrapper">
    <label for="publish_time">Publish time</label>
    <input type="datetime-local" name="publish_time" value="{{ $post->publish_time !== null ? date('Y-m-d\TH:i', strtotime($post->publish_time)) : date('Y-m-d\TH:i') }}" class="form-input">
    <div class="form-error">{{ $errors->first('publish_time') }}</div>
</div>
