@extends('panel.master')

@section('content')

<form action="{{ route('sub-categories.store') }}" method="POST">
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Category <span class="text-danger">*</span>
								</label>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select Category</option>
									@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Sub Category <span class="text-danger">*</span>
								</label>
								<x-forms.input name="sub_category_name"></x-forms.input>
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