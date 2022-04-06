@extends('panel.master')

@section('content')

<form action="{{ route('units.store') }}" method="POST">
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
								<x-forms.input name="unit_name"></x-forms.input>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">
									Unit Code
								</label>
								<x-forms.input name="unit_code"></x-forms.input>
							</div>
						</div>
					</div>
{{-- 					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label for="">
									Base Unit
								</label>
								<select name="unit_id" id="unit_id" class="form-control">
									<option value="">Select Base Unit</option>
									@foreach($units as $unit)
									<option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">Operator</label>
								<select name="" id="" class="form-control">
									<option value="multiply">Multiply (*)</option>
									<option value="multiply">Divide (/)</option>
									<option value="multiply">Plus (+)</option>
									<option value="multiply">Minus (-)</option>
								</select>
							</div>
						</div>
						<div class="col-12 col-md-6">
							<div class="form-group">
								<label for="">Operator Value</label>
								<x-forms.input type="number" name="operator_value"></x-forms.input>
							</div>
						</div>
					</div> --}}
					<x-btn.save></x-btn.save>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection