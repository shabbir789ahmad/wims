@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="credentials.create"></x-btn.link-create>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
			<h4 class="text-danger">These Credentials Will be used to send email to user</h4>
		</div>
	</div>
	</div>
</div>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-1">
				@if(count($envs) > 0)
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									
									<th scope="col">Email</th>
									<th scope="col">Password</th>
									
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($envs as $user)
								<tr>
									
									<td>{{ $user->email }}</td>
									<td>{{ $user->password }}</td>
									
									<td>
										<form action="{{ route('credentials.destroy', ['credential' => $user->id]) }}" method="POST" class="d-inline" >
											
											@csrf
											@method('Delete')
											<button type="submit" class="btn  btn-danger">
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
					<x-alert.resource-empty resource="Admin credentials" new="credentials.create"></x-alert.resource-empty>
				@endif			
			</div>
		</div>
	</div>
</div>

@endsection