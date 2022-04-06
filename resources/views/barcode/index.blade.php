@extends('panel.master')

@section('content')

<form action="{{ route('barcode.store') }}" method="POST">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body ">
					<div class="row ">
					 <div class="col-12 col-md-4 mt-2">
					 <select  class="form-control border border-secondary" id="category_id">
						<option selected hidden disabled>Select Category</option>
						@foreach($categories as $product)
                         <option value="{{$product['id']}}">{{$product['category_name']}}</option>
						@endforeach
					 </select>
					</div>
					<div class="col-12 col-md-4 mt-2">
					<select  class="form-control border border-secondary" id="sub_category_id">
					
						
					</select>
				   </div>
				   <div class="col-12 col-md-3  mt-2">
					<select name="barcode_id" class="border border-secondary form-control ml-1" id="product">
						
					</select>
					</div>
					<div class="col-12 col-md-1 mt-2">
					<button class="btn btn-info  " type="submit">Generate</button>
				</div>
			</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-0">

				@if(count($barcodes) > 0)

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thead-light">
							<tr>
								<th scope="col">Barcode</th>
								<th scope="col"></th>
								<th scope="col"></th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($barcodes as $category)
							<tr>
								<td class="col-3">
                                   <span>{{ucfirst($category['name'])}}<span class="float-right">RO.@if($category['price']){{$category['price']}} @else 0 @endif</span></span><br>
									{!! $category->barcode !!}</td>
									<td class="col-3"></td>
									<td class="col-3"></td>
								<td class="col-3"><a href="{{route('barcode.show',['barcode'=>$category->id])}}" class="btn btn-md btn-info">Print</a>
									<form action="{{ route('barcode.destroy', ['barcode' => $category->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
										@method('DELETE')
										@csrf
										<button type="submit" class="btn btn-md btn-danger">
											Delete
										</button>
								
									</form></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				@else

				<x-alert.resource-empty resource="barcode" new="barcode.create"></x-alert.resource-empty>

				@endif
							
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')

 <script type="text/javascript">

            $('#category_id').change(function() {
       
            $.ajax({
                url: `categories/${ $(this).val() }/sub-categories`,
            })
            .done(function(res) {
               
                $('#sub_category_id').empty();
                $('#sub_category_id').append(`<option selected disabled >Select Sub Category</option>`);
                $.each(res, function(index, val) {
                    $('#sub_category_id').append(`
                        <option value="${ val.id }">${ val.sub_category_name }</option>
                    `);
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });

             $('#sub_category_id').change(function() {
       
            $.ajax({
                url: `sub-categories/${ $(this).val() }/product`,
            })
            .done(function(res) {
               
                $('#product').empty();
                $('#product').append(`<option selected disabled >Select  Product</option>`);
                $.each(res, function(index, val) {
                    $('#product').append(`
                        <option value="${ val.id }">${ val.product_name }</option>
                    `);
                });
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
    </script>
@endsection
