@extends('panel.master')
@section('content')
<style type="text/css">
	.dataTables_wrapper .dataTables_filter input{

padding: 1rem 4rem;
border:  1px solid #1E1E2D;
}

.dataTables_wrapper .dataTables_filter label{

font-size: 1.5vw;
font-weight: 700;
}
</style>
<div class="card">
  <div class="card-body">
   <div class="row">
	<div class="col-12 col-md-2">
       <h4 class="font-weight-bold mt-4">Daily Reports</h4>
       		
	</div>
</div>
<div class="row mt-2">
	<div class="col-md-3 col-12">
 	<div class="form-group">
 	<label for="">Sort By Days <span class="text-danger">*</span></label>
      <select class="form-control" name="reports" id="report_by_option">
      	<option selected disabled hidden>Sort By Days</option>
      	<option value="1">Daily</option>
      	<option value="2">15 Days</option>
      	<option value="3">Monthly</option>
      </select>
 </div>
 </div>
 <div class="col-md-3 col-12">
 	<div class="form-group">
 	<label for="">Start Date <span class="text-danger">*</span></label>
     <input type="date" name="start_date" class="form-control" id="start_date_search" value="{{old('start_date')}}">
 </div>
 </div>
 <div class="col-12 col-md-3">
   <div class="form-group">
    <label for="">End Date <span class="text-danger">*</span>
    </label>
    <input type="date" name="end_date" class="form-control" id="end_date_search">
   </div>
  </div>
  <div class="col-md-3 col-12">
  	<div class="form-group">
  <label for="" class="mt-3"> </label>
   <button class="btn-info btn  btn-block search_by_date" >Search</button>
   </div>
  	
  </div>
</div>
</div>
</div>

<div class="row">
	<div class="col-6">
		<div class="card">
		  <div class="card-header"><h5 class="font-weight-bold">Sale</h5></div>
			<div class="card-body pb-0">
				<p class="font-weight-bold">Amount(RO)<span class="float-right font-weight-normal">{{$total_amount_today}}	</span></p>		
				<p class="font-weight-bold">Sale<span class="float-right font-weight-normal">{{$total_sale_today}}	</span></p>		
				<p class="font-weight-bold">Tax<span class="float-right font-weight-normal">{{round($total_tax_today,3)}}	</span></p>		
				<p class="font-weight-bold">Discount<span class="float-right font-weight-normal">{{$total_discount_today}}	</span></p>		
			</div>
	
		</div>
	</div>

	<div class="col-6">
		<div class="card">
		  <div class="card-header"><h5 class="font-weight-bold">Return</h5></div>
			<div class="card-body pb-0">
				<p class="font-weight-bold">Amount Return(RO)<span class="float-right font-weight-normal">	{{$total_amount_return_today}}</span></p>		
				<p class="font-weight-bold">Sale Return<span class="float-right font-weight-normal">{{$total_sale_return_today}}</span></p>		
				<p class="font-weight-bold">Tax Return<span class="float-right font-weight-normal">{{$total_retunr_tax_today}}	</span></p>		
				<p class="font-weight-bold">Return Charges<span class="float-right font-weight-normal">{{$charges}}	</span></p>		
			</div>
	
		</div>
	</div>

	<div class="col-6">
		<div class="card">
		  <div class="card-header"><h5 class="font-weight-bold">Profit / Loss</h5></div>
			<div class="card-body pb-0">
				<p class="font-weight-bold">Total Amount (RO)<span class="float-right font-weight-normal">	{{$total_amount_today}}</span></p>	
				<p class="font-weight-bold">Total Tax <span class="float-right font-weight-normal">{{$total_tax_today}}	</span></p>	
				<p class="font-weight-bold">Total Discount <span class="float-right font-weight-normal">{{$total_discount_today}}	</span></p>	
				<hr>	
				@php $sum=0; @endphp
				@foreach($orders as $order)
				@foreach($order->price as $price)
         @php  $sum+=$price['purchasing_price']; @endphp
				@endforeach
				@endforeach
				<p class="font-weight-bold">Net Profit / Loss<span class="float-right font-weight-normal">{{$total_amount_today -( $total_discount_today + $sum)}}	 </span></p>		
			</div>
	
		</div>
	</div>


</div>

<form id="report_form">
	<input type="hidden" name="option_report" id="option_report">
</form>

@endsection
@section('script')

@parent

<script type="text/javascript">

$(document).ready(function() {
   oTable=$('#example').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    });
//     $('#myInputTextField').keyup(function(){
//       oTable.search($(this).val()).draw() ;
// })
});

 $("#example_filter ").find('input').after("add your smiley here");

$('#report_by_option').change(function()
 {

   let value=$(this).val();
    $('#option_report').val(value)
    $('#report_form').submit();
 });

</script>
@endsection
