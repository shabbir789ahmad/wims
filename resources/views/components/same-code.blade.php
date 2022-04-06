<div>

    <div class="form-group">
      <label for="">Category <span class="text-danger">*</span>
      </label>
      <select name="category_id" id="category_id" class="form-control category_id">
        <option selected disabled hidden>Select Category</option>
         @foreach($categories as $category)
         @if(request()->query('category'))
          <option value="{{ $category->id }}" @if(request()->query('category')==$category->id) selected @endif>{{ $category->category_name }}</option>
          @else
           <option value="{{ $category->id }}" >{{ $category->category_name }}</option>
         @endif
         @endforeach
      </select>
    </div>
 
</div>