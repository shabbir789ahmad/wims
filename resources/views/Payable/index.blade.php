@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="payable.supplier"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-1">
				@if(count($payables) > 0)
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									<th scope="col">Product Name</th>
									<th scope="col">Product Quentity</th>
									<th scope="col">Product Amount</th>
									<th scope="col">Paying date </th>
									<th scope="col">Supplier Name  </th>
									
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($payables as $payable)
								<tr>
									
									<td>{{ $payable->product_name }}</td>
									<td>{{ $payable->product_quentity }}</td>
									<td>{{ $payable->product_amount }}</td>
									<td>{{ $payable->paying_date }}</td>
									@foreach($suppliers as $supplier)
									@if($payable['supplier_id']==$supplier['id'])
									<td>{{$supplier['contact_person_name']}}</td>
									@endif
									@endforeach
									<td>
										<form action="{{ route('pay.now', ['id' => $payable->id]) }}" method="POST" class="d-inline" >
											
											@csrf
											<button type="submit" class="btn  btn-info">
												Pay Now
											</button>
										</form>
										
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<x-alert.resource-empty resource="Payments" new="payable.supplier"></x-alert.resource-empty>
				@endif			
			</div>
		</div>
	</div>
</div>

@endsection