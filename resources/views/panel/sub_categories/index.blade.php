@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="sub-categories.create"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-0">
				@if(count($sub_categories) > 0)
				<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered table-hover">
						<thead class="thead-light">
							<tr>
								<th scope="col">Name</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($sub_categories as $sub_category)
							<tr>
								<td>{{ $sub_category->sub_category_name }}</td>
								<td>
									<a href="{{ route('sub-categories.edit', ['id' => $sub_category->id]) }}" type="submit" class="btn btn-xs btn-info">
										Edit
									</a>
									<form action="{{ route('sub-categories.destroy', ['id' => $sub_category->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
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
					<x-alert.resource-empty resource="sub_categories" new="sub-categories.create"></x-alert.resource-empty>
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