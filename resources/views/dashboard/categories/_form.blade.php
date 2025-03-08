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
        <x-form.input name="name" label='category name' class="form-control-lg" :value="$category->name" />
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
        <label for=""></label>
        <x-form.textarea label="Description" name="description" :value="$category->description" />
    </div>
    <div class="form-group">
        <x-form.label id="image">Image</x-form.label>
        <x-form.input type="file" name="image" accept="image/*" />
        @if ($category->image)
            <img src="{{ asset('storage/' . $category->image) }}" alt="" height="50">
        @endif
    </div>
    <div class="form-group">
        <x-form.label for="">Status</x-form.label>
        <div>
            <x-form.radio name="status" :chacked="$category->status" :options="['active' => 'Active' , 'inactive'=> 'Inactive']" />
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ $button_label ?? 'save' }}</button>
    </div>
