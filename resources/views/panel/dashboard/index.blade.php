@extends('panel.master')

@section('content')

<div class="row">
	<div class="col-lg-3 col-6">
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>{{ $data['brands'] }}</h3>
				<p>Brands</p>
			</div>
			<div class="icon">
				<i class="fas fa-copyright"></i>
			</div>
			<a href="{{ route('brands.index') }}" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h3>{{ $data['categories'] }}</h3>
				<p>Categories</p>
			</div>
			<div class="icon">
				<i class="fas fa-layer-group"></i>
			</div>
			<a href="{{ route('categories.index') }}" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="small-box bg-success">
			<div class="inner">
				<h3>{{ $data['products'] }}</h3>
				<p>Products</p>
			</div>
			<div class="icon">
				<i class="fas fa-tags"></i>
			</div>
			<a href="{{ route('products.index') }}" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-6">
		<div class="small-box bg-olive">
			<div class="inner">
				<h3>{{ $data['suppliers'] }}</h3>
				<p>Suppliers</p>
			</div>
			<div class="icon">
				<i class="fas fa-truck"></i>
			</div>
			<a href="{{ route('suppliers.index') }}" class="small-box-footer">
				More info <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>

@endsection