<div class="form-wrapper">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ old('title') ?? $role->title }}" class="form-input" autofocus>
    <div class="form-error">{{ $errors->first('title') }}</div>
</div>
<div class="form-wrapper">
    <label for="permission_id">Choose permissions</label>
    <select class="permission-select-for-role" name="permission_id[]" multiple="multiple">
        @foreach ($permissions as $permission)
        <option value="{{ $permission->id }}" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>
            {{ $permission->title }}
        </option>
        @endforeach
    </select>
</div>
