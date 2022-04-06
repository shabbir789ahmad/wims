<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <style type="text/css">
  .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
 
}

#project {
  float: left;
}

span {
  color: #5D6975;
  text-align: right;
  /*width: 52px;*/
  padding-right: 20%;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {

}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: ;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tr {

  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
.btn_color{
   background-color: #580631; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  float: right;
  cursor: pointer;
}

.prints{
  background-color: #580631; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: block;
  font-size: 16px;

}
.print {
  margin-top: 4%;
}
  @media print{
  .prints {
   
    display: none;
  }
 
}
.row{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  text-align: center;
}
.row .col{
  display: flex;
  flex-direction: column;
   width: 16rem;
    margin-top: 2rem;
   justify-content: space-between;
}
.col label{
  font-size: .1.4rvw;
  font-weight: 600;
  float: left;
}
.col input{
   width: 100%;
  padding: 12px 20px;
  margin: 9px 0px;
  box-sizing: border-box;
  border: 2px solid red;
  border-radius: 4px;

}
.col button{
    background-color: #4CAF50; 
  border: none;
  color: white;
  padding: 15px 31px;
  text-align: center;
  text-decoration: none;
 margin-top: 1.2rem;
  display: inline-block;
  font-size: 16px;
}
</style>
  </head>
  <body>

    <div class="row">
 <div class="col">

  <label for="">Start Date <span class="text-danger">*</span></label>
     <input type="date" name="start_date" class="form-control" id="start_date_search" >

 </div>
 <div class="col">
   
    <label for="">End Date <span class="text-danger">*</span>
    </label>
    <input type="date" name="end_date" class="form-control" id="end_date_search">
   
  </div>
  <div class="col">
 
  
   <button class="btn-info btn  btn-block search_by_date" >Search</button>

    
  </div>
</div>
    
    <div class="print" >
    <header class="clearfix">
      <div id="logo">
      
      </div>
      <h1>INVOICE </h1>
      
      <div id="project">
        @foreach($orders as $order)
        @if($loop->first)
        <div><span>CUSTOMER</span>{{Auth::user()->name}}</div>
        <div><span>ADDRESS</span>Oman</div>
        <div><span>EMAIL</span> {{Auth::user()->email}}</div>
        <!-- <div><span>PHONE</span>fgh</div> -->
        <div><span>DATE</span>{{date("l  F Y h:i:s A")}}  </div>
        @endif
        @endforeach
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr >
            
            <th >NAME</th>
            <th >BILLER NAME</th>
            <th >QUENTITY</th>
             <th >TAX</th>
            <th >DISCOUNT</th> 
            <th >SELL BY</th> 
           
            
            <th >SUB TOTAL</th>
          </tr>
        </thead>
        <tbody>
          @php $sum=0; $tax=0; $discount=0;   @endphp
          @foreach($orders as $order)
          <tr style=" text-align:center;">
           
            <td >{{$order['product_name']}}</td>
            <td >{{$order['biller_name']}}</td>
             <td >{{$order['quentity']}}</td>
             <td >{{$order['tax']}}</td>
             <td >{{$order['discount']}}</td>
             @if($order['sell']=='piece')
             <td >Pack</td>
             @else
             <td >{{$order['sell']}}</td>
             @endif
            <td >{{$order['sub_total']}}</td>
            
          </tr>
         
          @php $tax += $order['tax']; @endphp
          @php $discount += $order['discount']; @endphp
          
         
          @php $sell_by = $order['sell'] @endphp
          @endforeach

    <!-- calculate sum of price piece and unit -->
             @php $sum=$piece_price.'.'.$unit_price @endphp


          <tr style="border-left: 1px solid black; border-right: 1px solid black;">
          
            <td colspan="6" class="grand total" style="font-weight: bold; ">
             <p>SUB TOTAL </p>
             <p>DISCOUNT   + Tax </p>
             <p>SUB TOTAL  - SUB TAX </p>
             <p>NUB SUB TOTAL  - PURCHASING PRICE </p>
            </td>
              <td class="grand total " colspan="6" style="font-weight: bold; padding: 1%;">
                <p>{{$sum}}</p>
                <p>{{$discount}} +  {{ $tax}}</p>
                <p>{{$sum}} -  {{$discount + $tax}}</p>
                <p>{{$sum - ($discount + $tax)}} - {{$products['purchasing_price']}}</p>
              </td>
          </tr>
         
          <tr style="border-left: 1px solid black; border-right: 1px solid black;;">
            <td colspan="6" class="grand total" style="font-weight: bold;"> TOTAL TAX Collected</td>
            <td class="grand total " colspan="5" style="font-weight: bold; background: #580631; text-align: center; color: #fff;padding:1%;">RO: {{$tax}}</td>
          </tr>
           <tr style="border-left: 1px solid black; border-right: 1px solid black;">
            <td colspan="6" class="grand total" style="font-weight: bold;"> TOTAL PROFIT</td>
            <td class="grand total " colspan="5" style="font-weight: bold; background: #580631; color:#fff; text-align: center; padding:1%;">RO: {{($sum - ($discount + $tax)) - $products['purchasing_price']}}</td>
          </tr>
        </tbody>
      </table>
  
    </main>
   
 
   </div>
   
<button class=" prints " style="float:right;" >Print</button><br>

<form id="sub_date_form">
  <input type="hidden" name="databetween2" id="databetween2">
  <input type="hidden" name="databetween" id="databetween">
</form>


   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script type="text/javascript">
     $('.prints').click(function(){

  window.print();
     });


     $('.search_by_date').click(function(){
     
    let strt_date=$('#start_date_search').val()
    let ends_date=$('#end_date_search').val()

    $('#databetween').val(strt_date);
    $('#databetween2').val(ends_date);
  
   $('#sub_date_form').submit();
  });
   </script>
  </body>
</html>