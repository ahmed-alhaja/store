    @if ($errors->any())
        <div class="alert alert-danger">
            <h3>Error Occured!</h3>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label for="">Category Name </label>
        <input type="text" name="name" @class([
            'form-control',
            'is-invalid' => $errors->has('name'),
            'font-bold' => true,
        ]) value="{{ old('name', $category->name) }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Category Parent </label>
        <select type="text" name="parent_id" class="form-control form-select">
            <option value="">Primary Categry</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <textarea type="text" name="description" class="form-control">{{ old('description', $category->description) }} </textarea>
    </div>
    <div class="form-group">
        <label for="">Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @if ($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
        @endif
    </div>
    <div class="form-group">
        <label for="">Status</label>
        <div>
            <div class="form-check">
                <input @class([
                    'form-check-input',
                    'is-invalid' => $errors->has('name'),
                    'font-bold' => true,
                ]) type="radio" name="status" value="active"
                    @checked(old('status', $category->status) == 'active')>
                <label class="form-check-label">Active</label>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-check">
                <input @class([
                    'form-check-input',
                    'is-invalid' => $errors->has('name'),
                    'font-bold' => true,
                ]) type="radio" name="status" value="inactive"
                    @checked(old('status', $category->status) == 'inactive ')>
                <label class="form-check-label">inactive
                </label>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
    </div>
