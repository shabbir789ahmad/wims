@extends('panel.master')

@section('content')

<form action="{{ route('credentials.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-6">
                             <label for="">
							  Email <span class="text-danger">*</span>
						     </label>
						     <x-forms.input name="email" placeholder="Admin Email"></x-forms.input>
						     
							</div>
							<div class="col-12 col-md-6">
                              <label for="" class="">
							   Password <span class="text-danger">*</span>
						      </label>
						      <input type="password" name="password"  class="form-control" placeholder="Password">
						<span class="text-danger">@error ('password') {{ $message }} @enderror</span>
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