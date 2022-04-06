@extends('panel.master')
@section('content')

<div class="row">
  <div class="col-12 col-md-4">
	<div class="form-group">
	  <label for="">Category <span class="text-danger">*</span>
	  </label>
	  <select name="category_id" id="category_id" class="form-control category_id">
		<option selected disabled hidden>Select Category</option>
		 
	  </select>
	</div>
   </div>
  <div class="col-12 col-md-4">
   <div class="form-group">
	<label for="">Search by Sub Category <span class="text-danger">*</span>
	</label>
	<select name="sub_category_id" id="sub_category_id" class="form-control sub_category_id">
	 <option selected disabled hidden>Select Sub Category</option>
	</select>
   </div>
  </div>
  <div class="col-12 col-md-4">
   <div class="form-group">
	<label for="">Search By Brand<span class="text-danger">*</span>
	</label>
	<select  id="brand_search" class="form-control ">
	 <option selected disabled hidden>Search By Brand</option>
	 @foreach($brands as $brand)
	 <option value="{{$brand['id']}}">{{$brand['brand_name']}}</option>
	 @endforeach
	</select>
   </div>
  </div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			
			<div class="card-body pb-0">
				@if(count($products) > 0)
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover table-valign-middle">
						<thead class="thead-light">
							<tr>
							
								<th scope="col"></th>
								<th scope="col">Brand</th>
								<th scope="col">Name</th>
								<th scope="col">Sub Total</th>
								<th scope="col">Total</th>
								<th scope="col">Stock</th>
								<th scope="col">Sold</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								
								
								<td class="text-center">
									<img src="{{ asset('uploads/products/' . $product->product_image) }}" class="img-fluid img-thumbnail" alt="" style="width: 64px;">
								</td>
								@foreach($brands as $brand)
								@if($brand['id']==$product->brand_id)
								<td>
									{{ $brand['brand_name']}}
								</td>
								@endif
								@endforeach
								<td>
									@if(strstr($product->product_name, '/'))
										{!! App\Helpers\Fraction::frac($product->product_name) !!}
									@else
										{{ $product->product_name }}
									@endif
								</td>
								<td>
									{{ $product->sub_total}}
								</td>
								<td>
									{{ $product->total}}
								</td>
								<td>
									{{ $product->stock }}
								</td>
								<td>
									{{ $product->stock_sold }}
								</td>
								<td>
									
									<a href="" type="submit" class="btn btn-xs btn-info">
										Edit
									</a>
									<form action="" method="POST" class="d-inline" onsubmit="return confirmDelete()">
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
				 {{ $products->links() }}
				
				@endif			
			</div>
		</div>
	</div>
</div>

@endsection