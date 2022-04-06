<div>
   
   <div class="form-group">
    <label for="">Search By Brand<span class="text-danger">*</span>
    </label>
    <select  id="brand_search" class="form-control ">
     <option selected disabled hidden>Search By Brand</option>
     @foreach ($brands as $brand)
      @if(request()->query('brand_se'))
      <option value="{{$brand['id']}}" @if(request()->query('brand_se')==$brand->id) selected @endif>{{$brand['brand_name']}}</option>
       @else
      <option value="{{$brand['id']}}" >{{$brand['brand_name']}}</option>
      @endif
     @endforeach
    </select>
   </div>

</div>