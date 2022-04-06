@extends('panel.master')

@section('content')

<form action="{{ route('sub-categories.update', ['id' => $sub_category->id]) }}" method="POST">
	@method('PUT')
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
									<option value="{{ $category->id }}" @if($category->id == $sub_category->category_id) selected @endif>{{ $category->category_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Sub Category <span class="text-danger">*</span>
								</label>
								<input type="text" name="sub_category_name" class="form-control" value="{{ $sub_category->sub_category_name }}">
							</div>
						</div>
					</div>
					<x-btn.update></x-btn.update>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection