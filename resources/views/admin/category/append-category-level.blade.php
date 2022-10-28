<div class="col-12">
    <div class="form-group has-icon-left">
        <label for="first-name-icon">Category Level</label>
        <div class="position-relative">
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0">Main Category</option>
                @if(!empty($getcategories))
                   @foreach ($getcategories as $category)
                       <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                   @endforeach
                @endif
            </select>
            @error('parent_id')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
