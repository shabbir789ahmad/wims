@extends('panel.master')

@section('content')

<form action="{{ route('brands.update', ['id' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label for="">
							Brand Name <span class="text-danger">*</span>
						</label>
						<x-forms.input type="text" name="brand_name" class="form-control" value="{{ $brand->brand_name }}"></x-forms.input>
						<label for="">
							Brand Logo<span class="text-danger">*</span>
						</label>
						<x-forms.input type="file" name="image" class="form-control" value="{{ $brand->brand_logo }}"></x-forms.input>

						<img src="{{$brand->brand_logo}}" alt="barnd logo" width="20%">
					</div>
					<x-btn.update></x-btn.update>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection