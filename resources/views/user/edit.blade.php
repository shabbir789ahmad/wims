@extends('panel.master')
@section('content')

<form action="{{ route('update.user',['id'=>$user['id']]) }}" method="POST" >
	@csrf
	@method('PUT')
	<div class="row justify-content-center">
		<div class="col-10">
			<div class="card">
				<div class="card-body">
				  <div class="row">
				  	
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
								User  Name</span>
								</label>
								<x-forms.input name="name" value="{{$user['name']}}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">User Email
									</span>
									
								</label>
								<x-forms.input name="email" value="{{$user['email']}}" ></x-forms.input>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
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