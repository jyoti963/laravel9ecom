<div class="col-12">
    <div class="form-group has-icon-left">
        <label for="first-name-icon">Category Level</label>
        <div class="position-relative">
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0" @if(isset($category['parent_id']) && ($category['parent_id']) === 0)
                  selected
                @endif>Main Category</option>
                @if(!empty($getcategories))
                   @foreach ($getcategories as $parentcategory)
                       <option value="{{ $parentcategory['id'] }}" @if(isset($category['parent_id']) && ($category['parent_id']) === $parentcategory['id'])
                       selected
                     @endif>{{ $parentcategory['category_name'] }}</option>
                   @endforeach
                @endif
                @if(!empty($parentcategory['subcategories']))
                   @foreach ($parentcategory['subcategories'] as $subcategory)
                       <option value="{{ $subcategory['id'] }}" @if(isset($subcategory['parent_id']) && ($subcategory['parent_id']) === $subcategory['id'])
                       selected
                     @endif>&nbsp;&raquo;&nbsp;{{ $subcategory['category_name'] }}</option>
                   @endforeach
                @endif
            </select>
            @error('parent_id')
            <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
