@extends('panel.master')

@section('content')

<form action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
	@method('PUT')
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label for="">
							Category Name <span class="text-danger">*</span>
						</label>
						<input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
					</div>
					<x-btn.update></x-btn.update>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection