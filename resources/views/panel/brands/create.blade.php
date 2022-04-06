@extends('panel.master')

@section('content')

<form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label for="">
							Brand Name <span class="text-danger">*</span>
						</label>
						<x-forms.input name="brand_name"></x-forms.input>
						<label for="">
							Brand Logo <span class="text-danger">*</span>
						</label>
						<input type="file" name="image"  class="form-control">
					</div>
					<x-btn.save></x-btn.save>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection