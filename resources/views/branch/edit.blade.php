@extends('panel.master')
@section('content')

<form action="{{ route('branch.update',['branch'=>$branchs['id']]) }}" method="POST" >
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
									Branch Name</span>
								</label>
								<x-forms.input name="branch_name" value="{{$branchs['branch_name']}}" ></x-forms.input>
							</div>
						</div>
						
						
					</div>
					
					
					<div>
						
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