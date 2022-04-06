@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="categories.create"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-0">

				@if(count($categories) > 0)

				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead class="thead-light">
							<tr>
								<th scope="col">Name</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->category_name }}</td>
								<td>
									<a href="{{ route('categories.edit', ['id' => $category->id]) }}" type="submit" class="btn btn-xs btn-info">
										Edit
									</a>
									<form action="{{ route('categories.destroy', ['id' => $category->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
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

				<x-alert.resource-empty resource="categories" new="categories.create"></x-alert.resource-empty>

				@endif
							
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')

@parent

<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    } );
});
</script>
@endsection