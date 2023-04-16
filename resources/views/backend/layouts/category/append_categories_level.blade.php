<label for="parent_id">Select Parent Category Level</label><span class="required">*</span>
<select name="parent_id" id="parent_id" class="form-control show-tick ms select2" data-placeholder="Select">
    <option value="">Select </option>
    <option value="0"@if (isset($categorydata['parent_id']) && $categorydata['parent_id']==0) selected @endif>Main Category</option>
        @if (!empty($getCategories))
            @foreach ($getCategories as $category)
                <option value="{{ $category['id'] }}" @if (isset($categorydata['parent_id']) && $categorydata['parent_id']==$category['id']) selected @endif>{{ $category['category_name'] }}</option>
                    @if (!empty($category['subcategories']))
                        @foreach ($category['subcategories'] as $subcategory)
                            <option value="{{ $subcategory['id'] }}" >&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;{{ $subcategory['category_name'] }}</option>
                        @endforeach
                    @endif
            @endforeach
        @endif
</select>
@error ('parent_id')
    <small class="text-danger">{{ $message }}</small>
@enderror

