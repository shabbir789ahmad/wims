@extends('panel.master')

@section('content')

<style type="text/css">
	#print_barcode{
		display:flex;
		 flex-direction:row;
		  flex-wrap: wrap;
	}
	@media print{
  #hide *{
    margin-top: 0%;
    padding-top: 0%;
    height: 0%;
    display: none;
  }
  #print_barcode *{
    display: block;
  
   margin-top: 3%;
  }
}
</style>
	<div class="row">
		<div class="col">
			<div class="card" >
				<div class="card-body" id="hide">
					<div class="form-group">
						<label for="">
							Number Of Coppies to Print <span class="text-danger">*</span>
						</label>
						<input type="hidden" value="{{$barcode['barcode']}}" id="image_of_barcode" />
						<input type="hidden" value="{{ucfirst($barcode['name'])}}" id="name" />
						<input type="hidden" value="{{$barcode['price']}}" id="price" />
						<x-forms.input name="" id="number_of_barcode"></x-forms.input>
					</div>
					<button class="btn btn-info"id="copy_barcode">Number Of Coppies</button>
					<button class="btn btn-info " id="print_now">Print Now  </button>
				</div>
			</div>
			<div class="card">
				<div class="card-body "  id="print_barcode">
					
				</div>
			</div>
		</div>
	</div>


@endsection
@section('script')
@parent
<script type="text/javascript">
  $('#copy_barcode').click(function(){
  let number_of_copy=$('#number_of_barcode').val()
  let image_of_copy=$('#image_of_barcode').val()
  let price=$('#price').val()
  let name=$('#name').val()

   for(let i=0; i<parseInt(number_of_copy);i++)
   {
    $('#print_barcode').append(`
       
     <div class="ml-3 mt-2"><span class="text-dark">${name }<span class="float-right">RO.${price}</span></span><br> ${image_of_copy }</div>
    	`);
   }
  });	 

 $('#print_now').click(function(){
   
       window.print();
 });
 
</script>
@endsection