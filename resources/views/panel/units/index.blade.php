@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="units.create"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover">
						<thead class="thead-light">
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Code</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($units as $unit)
							<tr>
								<td>{{ $unit->unit_name }}</td>
								<td>{{ $unit->unit_code }}</td>
								<td>
									<a href="{{ route('units.edit', ['id' => $unit->id]) }}" type="submit" class="btn btn-xs btn-info">
										Edit
									</a>
									<form action="{{ route('units.destroy', ['id' => $unit->id]) }}" method="POST" class="d-inline" onsubmit="confirmDelete()">
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
			</div>
		</div>
	</div>
</div>

@endsection