@extends('panel.master')

@section('content')

<form action="{{ route('units.update', ['id' => $unit->id]) }}" method="POST">
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
									Unit Name
								</label>
								<x-forms.input name="unit_name" value="{{ $unit->unit_name }}"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Unit Code
								</label>
								<x-forms.input name="unit_code" value="{{ $unit->unit_code }}"></x-forms.input>
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