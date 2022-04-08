@extends('panel.master')
@section('content')

<!-- <div class="row">
	<div class="col-12">
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="Basic example">
				<a href="{{ route('products.create') }}" class="btn btn-primary">
					Create Single
				</a>
			
			</div>
		</div>
	</div>
</div> -->
<div class="card">
  <div class="card-body">
  	<div class="row">
	<div class="col-12 col-md-4">
       <h4 class="font-weight-bold mt-4">Product Reports</h4>
       		
	</div>
</div>
   <div class="row">
	<div class="col-md-3 col-12">
 	  <div class="form-group">
 	   <label for="">Sort By Days<span class="text-danger">*</span></label>
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
    <div class="col-md-3">
  	 <div class="form-group">
     <label for="" class="mt-3"> </label>
     <button class="btn-info btn  btn-block search_by_date" >Search</button>
    </div>
   </div>
  </div>
 </div>
</div>


<div class="row">
 <div class="col-12">
  <div class="card">
	<div class="card-body pb-0">
	  @if(count($orders) > 0)

	  <table id="example" class="table table-striped table-bordered" style="width:100%">
       <thead>
        <tr>
         <th scope="col"></th>
		 <th scope="col">Name</th>
		 <th scope="col">Biller Name</th>
		 <th scope="col">Quentity</th>
		 <th scope="col">Total</th>
		 <th scope="col">Tax</th>
		 <th scope="col">Discount</th>
        </tr>
       </thead>
       <tbody>
       	@php $qu=''; @endphp
        @foreach($orders as $product)
         <tr>
		  <td class="col-1"><input type="checkbox" name="product_id"></td>
		  <td >{{ $product->product_name }}</td>
		  <td >{{ $product->biller_name }}</td>

		  @if($product['sell']=='piece')
		  <td>{{ $product->quentity }}</td>
		  @elseif($product['sell']=='unit')
		  
		   @if($product['pack_quentity'] <= $product->quentity)
		   @php  $qu=$product->quentity/$product['pack_quentity'] @endphp
             <td>{{ round($qu,1) }}</td>
             @else
              <td>0.{{ $product->quentity }}</td>
            @endif
            
		  @endif
		  <td>{{ $product->sub_total }}</td>
		  <td>{{ $product->tax }}</td>
		
		 
		  <td class="col-1">
			<div class="d-flex">
			  <a href="{{ route('report.edit', ['report' => $product->product_id]) }}" type="submit" class="btn btn-xs btn-info">View</a>
			
		 </div>
	    </td>
	   </tr>
      
       @endforeach
      </tbody>
  </table>
<div class="d-flex justify-content-center mt-3">
    {!! $orders->links() !!}
</div>
				
				 
				@else
				<x-alert.resource-empty resource="Order" new="pos.index"></x-alert.resource-empty>
				@endif			
			</div>
		</form>
		</div>
	</div>
</div>






<form id="sub_date_form">
	<input type="hidden" name="databetween2" id="databetween2">
	<input type="hidden" name="databetween" id="databetween">
</form>

<form id="report_form">
	<input type="hidden" name="option_report" id="option_report">
</form>

@endsection
@section('script')

@parent

<script type="text/javascript">
	
	$('.search_by_date').click(function(){
     
    let strt_date=$('#start_date_search').val()
    let ends_date=$('#end_date_search').val()

    $('#databetween').val(strt_date);
    $('#databetween2').val(ends_date);
  
   $('#sub_date_form').submit();
	});

</script>

<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    } );
});


$('#report_by_option').change(function()
 {

   let value=$(this).val();
    $('#option_report').val(value)
    $('#report_form').submit();
 });

</script>

@endsection
