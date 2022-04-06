@extends('panel.master')

@section('content')

<form action="{{ route('user.save') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<div class="row">
							<div class="col-12 col-md-6">
                             <label for="">
							  User Name <span class="text-danger">*</span>
						     </label>
						     <x-forms.input name="name" placeholder="User Name"></x-forms.input>
						     <span class="text-danger">@error ('name') {{$message}} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                              <label for="" class="">
							   User Email <span class="text-danger">*</span>
						      </label>
						      <input type="email" name="email"  class="form-control" placeholder="User Email">
						<span class="text-danger">@error ('email') {{ $message }} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                             <label for="" class="mt-2">
							User Password <span class="text-danger">*</span>
						</label>
						<input type="password" name="password"  class="form-control" placeholder="User Password">
					<span class="text-danger">@error ('password
					') {{ $message }} @enderror</span>
							</div>
							<div class="col-12 col-md-6">
                            <label for="" class="mt-2">
							User Role <span class="text-danger">*</span>
						</label>
						<div class="form-group">
          
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
        </div>
						<span class="text-danger">@error ('roles') {{ $message }} @enderror</span>
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