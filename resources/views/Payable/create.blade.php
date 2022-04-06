@extends('panel.master')

@section('content')

<form action="{{ route('payable.create') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-6">
                             <label for="">
							  Product Name <span class="text-danger">*</span>
						     </label>
						     <x-forms.input name="product_name"></x-forms.input>
						     <span class="text-danger">@error ('product_name') {{$mesage}} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                              <label for="" class="">
							   Product Quentity <span class="text-danger">*</span>
						      </label>
						      <x-forms.input name="product_quentity"></x-forms.input>
						<span class="text-danger">@error ('product_quentity') {{$mesage}} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                             <label for="" class="mt-2">
							Product Amount <span class="text-danger">*</span>
						</label>
						<input type="text" name="product_amount"  class="form-control">
						<span class="text-danger">@error ('product_amount') {{$mesage}} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                            <label for="" class="mt-2">
							Paying Date <span class="text-danger">*</span>
						</label>
						<input type="datetime-local" name="paying_date"  class="form-control">
						<span class="text-danger">@error ('paying_date') {{$mesage}} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                              <label for="" class="mt-2">
							Product Supplier <span class="text-danger">*</span>
						</label>
						<select class="form-control" name="supplier_id">
							<option selected disabled>Select Supplier</option>
							@foreach($suppliers as $supplier)
							  <option value="{{$supplier['id']}}">{{$supplier['contact_person_name']}}</option>
							@endforeach
						</select>
						<span class="text-danger">@error ('supplier_id') {{$mesage}} @enderror</span>
							</div>
						</div>
						
						
						
					</div>
					<x-btn.save></x-btn.save>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection