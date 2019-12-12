<div class="form-wrapper">
	<label for="title">Title</label>
	<input type="text" name="title" value="{{ old('title') ?? $post->title }}" class="form-input">
	<div>{{ $errors->first('title') }}</div>
</div>

<div class="form-wrapper">
	<label for="title">Body</label>
	<textarea id="mytextarea"></textarea>
</div>

<div class="form-wrapper">
	<label for="category_id">Choose category</label>
	<select name="category_id" value="{{ old('category_id') }}" class="form-select">
		@foreach ($categories as $category)
		<option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
		@endforeach
	</select>
</div>

<div class="form-wrapper">
	<label for="image">Set image</label>
	<input type="file" name="image" value="" class="form-image">
	<div>{{ $errors->first('image') }}</div>
</div>

<div class="form-wrapper">
	<label>Select status</label>
	<label class="radio-container">Unpublished
	<input type="radio" name="published" value="0" checked class="form-radio">
	<span class="radio-checkmark"></span>
    </label>

    <label class="radio-container">Published
	<input type="radio" name="published" value="1" class="form-radio">
	<span class="radio-checkmark"></span>
	</label>
</div>

<div class="form-wrapper">
	<label for="time_to_read">Time to read</label>
	<input type="number" name="time_to_read" value="" min="1" max="10" class="form-input">
	<div>{{ $errors->first('time_to_read') }}</div>
</div>

@csrf
