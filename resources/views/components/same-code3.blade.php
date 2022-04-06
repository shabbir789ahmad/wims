<div>
 
                <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" id="select_all"></th>
                                <th scope="col"></th>
                                <th scope="col">Brand</th>
                                <th scope="col">Name</th>
                  
                                <th scope="col">Category</th>
                                <th scope="col">Sub Category</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Sold</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                               
                                <td> @foreach($product->brand as $b)
                                    <input type="checkbox" name="product_brand[]" class="product_brand d-none" value="{{$b['id']}}" >
                                    @endforeach 
                                    <input type="checkbox" class="product_checkbox" name="id[]" value="{{$product->id}}"></td>
                                </form>
                                <td class="text-center">
                                    <img src="{{ asset('uploads/products/' . $product->product_image) }}" class="img-fluid img-thumbnail" alt="" style="width: 64px;" loading="lazy">
                                </td>
                                <td >
                                  <select class="form-control brands" >
                                    @foreach($brands as $brand)
                                    @foreach($product->brand as $b)
                                    @if($brand['id'] ==  $b['brand_id'] )
                                     <option value="{{$b['id']}}">{{$brand['brand_name']}}</option>
                                    @endif
                                    @endforeach 
                                     @endforeach
                                  </select>
                                </td>
                                <td>
                                    @if(strstr($product->product_name, '/'))
                                        {!! App\Helpers\Fraction::frac($product->product_name) !!}
                                    @else
                                        {{ $product->product_name }}
                                    @endif
                                </td>
                               
                                <td>
                                    {{ $product->category_name }}
                                </td>
                                <td>
                                    {{ $product->sub_category_name }}
                                </td>
                                <td>
                                  <select class="form-control">
                                    @foreach($stocks as $stock)
                                    @foreach($product->brand as $b)
                                    @if($stock['pbrand_id'] == $b['id'])
                                     <option>{{$stock['stock']}}</option>
                                    @endif
                                    @endforeach
                                    @endforeach
                                        
                                  </select>
                                    
                                </td>
                                <td class="col-1">
                                    <select class="form-control">
                                        @foreach($stocks as $stock)
                                    @foreach($product->brand as $b)
                                    @if($stock['pbrand_id'] == $b['id'])
                                    @if($stock['stock_sold']==Null || $stock['stock_sold']=='')
                                     <option>0</option>
                                    @else
                                     <option>{{$stock['stock_sold']}}</option>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                        
                                    </select>
                                </td>
                                <td class="">
                               
                                    <a href="{{ route('products.edit', ['id' => $product->id]) }}" type="submit" class="btn btn-xs btn-info">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST" class="d-inline" >
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                    
                                </td>
                            </tr>
                            @endforeach
                     </tbody>
          </table>
</div>