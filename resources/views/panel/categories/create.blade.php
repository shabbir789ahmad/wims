@extends('panel.master')

@section('content')

<form action="{{ route('categories.store') }}" method="POST">
	@csrf
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<label for="">
							Category Name <span class="text-danger">*</span>
						</label>
						<x-forms.input name="category_name"></x-forms.input>
					</div>
					<x-btn.save></x-btn.save>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection