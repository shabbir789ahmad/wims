<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Point of Sale</title>
	<link rel="stylesheet" href="{{ asset('pos/bs/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/pos.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/recipt.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/brandside.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/header.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/responsive.css') }}">
	<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}"> 
	   <!-- <link rel="stylesheet" type="text/css" media="print" href="print.css" /> -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
	<style>
		.pos-gradient:hover .active{

		border: .7px solid #238AA9;
		color: #238AA9;
        cursor: pointer;
        transform: scale(1.1);
		}
		.pos-gradient {

		border: .7px solid #7C5CC4;
		color: #7C5CC4;
		transition: .2s ease-in;
        margin-top: 10%;
		}
		.pos-gradient {

		color: #666666;

		}
		.p1{

		font-size: 1vw;

		}
		.p{
			color:#7C5CC4 ;
		}
		.rm{
			cursor: pointer;
		}
		.price_tag{
			color: #7d7d7d;
		}
		.price{
			width: 14%;
		}
	</style>
</head>
<body>

	@yield('content')

	@section('script')

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="{{asset('js/posdiscount.js')}}"></script>
   <script src="{{asset('js/getproduct.js')}}"></script>
   <script src="{{asset('js/payment.js')}}"></script>
   <script src="{{asset('js/productdelete.js')}}"></script>
   <script src="{{asset('js/updatequentity.js')}}"></script>
   <script src="{{asset('js/retail.js')}}"></script>
   <script src="{{asset('js/account.js')}}"></script>
   <script src="{{asset('js/addexpense.js')}}"></script>
   <script src="{{asset('js/submitformpayment.js')}}"></script>
   <script src="{{asset('js/payable.js')}}"></script>
   
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

   @if(Session()->has('success'))
<script>
   swal.fire({
   title: ' {{ Session()->get('success') }}',
   text: "Thanks You",
   icon: "success",
  
}); 
   sessionStorage.removeItem('success'); 
</script>

 {{ Session()->forget('success'); }}

  @endif

	<script>

		var baseURL = "{{ url("") }}" + "/";

	</script>
	@show
</body>
</html>