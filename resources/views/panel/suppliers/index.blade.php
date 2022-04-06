@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="suppliers.create"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-0">
				@if(count($suppliers) > 0)
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thead-light">
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Contact Person</th>
								<th scope="col">Contact Person Mobile</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($suppliers as $supplier)
							<tr>
								<td>{{ $supplier->company_name }}</td>
								<td>{{ $supplier->contact_person_name }}</td>
								<td>{{ $supplier->contact_person_phone }}</td>
								<td>
									<a href="{{ route('suppliers.edit', ['id' => $supplier->id]) }}" type="submit" class="btn btn-xs btn-info">
										Edit
									</a>
									<form action="{{ route('suppliers.destroy', ['id' => $supplier->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
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
				@else
				<x-alert.resource-empty resource="suppliers" new="suppliers.create"></x-alert.resource-empty>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection