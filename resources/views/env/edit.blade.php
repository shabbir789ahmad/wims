@extends('panel.master')
@section('content')

<form action="{{ route('return.update',['return'=>$orders['id']]) }}" method="POST" >
	@csrf
	@method('PUT')
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
				<div class="card-body">
				  <div class="row">
				  	<input type="hidden" name="product_id" value="{{$orders['product_id']}}">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Product Name</span>
								</label>
								<x-forms.input name="product_name" value="{{$orders['product_name']}}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">Biller Name
									</span>
									
								</label>
								<x-forms.input name="biller_name" value="{{$orders['biller_name']}}" ></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Quentity
								</label>
								<x-forms.input name="quentity" value="{{$orders['quentity']}}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Total Price
								</label>
								<x-forms.input name="sub_total" value="{{$orders['sub_total']}}"></x-forms.input>
							</div>
						</div>
					</div>
					<div class="row">
						
						
						
						
						<div class="col-12 col-md-6">
						  <div class="form-group">
							<label for="">VAT </label>
							<x-forms.input name="tax " value="{{$orders['tax']}}"></x-forms.input>
						 </div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Discount
								</label>
								<x-forms.input name="discount" value="{{$orders['tax']}}"></x-forms.input>
							</div>
						</div>
					</div>
					
					<div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Return Charges <span class="text-danger">*</span>
								</label>
								<x-forms.input name="return_charges"> </x-forms.input>
							</div>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-12">
							<button type="submit"  class="btn btn-primary">
								Save
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>

@endsection

@section('script')

@parent

<script>


</script>

@endsection