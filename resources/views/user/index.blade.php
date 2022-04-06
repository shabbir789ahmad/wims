@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<x-btn.link-create route="user.create"></x-btn.link-create>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body pb-1">
				@if(count($users) > 0)
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead class="thead-light">
								<tr>
									<th scope="col">User Name</th>
									<th scope="col">User Email</th>
									<th scope="col">User Role</th>
									<!-- <th scope="col">User Address</th> -->
									
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								@if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                @if($v=='admin')

                                @else
								<tr>
									
									<td>{{ ucfirst($user->name) }}</td>
									<td>{{ $user->email }}</td>
									
								 
                              <td> <label class="badge badge-success">{{ $v }}</label></td>
                            
									
									<td>
										<a href="{{ route('user.edit', ['id' => $user->id]) }}" type="submit" class="btn btn-md btn-info">
										Return
									</a>
										<form action="{{ route('user.delete', ['id' => $user->id]) }}" method="POST" class="d-inline" >
											
											@csrf
											@method('Delete')
											<button type="submit" class="btn  btn-danger">
												Delete
											</button>
										</form>
										
									</td>
								</tr>
								@endif
								 @endforeach
                         @endif
								@endforeach
							</tbody>
						</table>
					</div>
				@else
					<x-alert.resource-empty resource="users" new="user.create"></x-alert.resource-empty>
				@endif			
			</div>
		</div>
	</div>
</div>

@endsection