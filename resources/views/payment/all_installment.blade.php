@extends('panel.master')
@section('content')

<div class="container-fluid  card shadow">
  <div class="row">
  	@foreach($new_installment as $ins)
   
   <div class="col-md-10 mx-auto col-12">
   	<div class="name d-flex mt-3">
      <h2 class="font-weight-bold mb-0">{{$ins['installment']}}</h2>
      <p class="bg-warning p-2 rounded ml-auto mb-1">Customer</p>
    </div>
    <p class="pt-0 mt-0">{{$ins['price_per_installment']}}</p>
   </div>
   @endforeach
  </div>
</div>

@endsection