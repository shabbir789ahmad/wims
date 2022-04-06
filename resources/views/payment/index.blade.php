@extends('panel.master')
@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="text" id="Reciev_payment" class="btn btn-primary">
					Recievable Payment
				</button>
				<button type="button" class="btn Recieved_payment btn-primary ml-1">
					Recieved Payment
				</button>
			</div>
		</div>
	</div>
</div>

<div class="row">
  <div class="col-12">
	<div class="card">
	  <div class="card-body pb-0">
		<table id="example" class="table table-striped table-bordered payment_recievable2" style="display:block;width: 100%;">
          <thead>
            <tr>
                <th scope="col" class="col-2">Customer Name </th>
				<th scope="col" class="col-3">Payable Amount</th>
				<th scope="col" class="col-2">Customer Phone</th>
				<th scope="col" class="col-3">Customer Email</th>
				<th scope="col" class="col-4">Action</th>
            </tr>
          </thead>
          
          <tbody >       	
            @foreach($accounts as $account)
             <tr>
                    <td>{{$account['customer_name']}}</td>
                    <td>{{$account['account'] }}</td>
                    <td>{{$account['customer_phone'] }}</td>
                    <td>{{$account['customer_email']}}</td>
                    <td class="d-flex">

            @if($account->installment->isempty())
                        <button type="button" class="btn btn-xs btn-info recieve_payment" data-id="{{$account['id']}}">
                            Recieve
                        </button>
                        <button type="button" data-id="{{$account['id']}}" data-price="{{$account['account']}}" class="btn btn-xs btn-danger ml-2 Instalment">
                          Make Instalment 
                      </button>
                      @else
                      <button type="button" class="btn btn-xs btn-info all_insall" data-id="{{$account['id']}}">
                            All Instalment
                        </button>

            @endif
                    </td>
                </tr>
                
            @endforeach
          </tbody>
                 </table>

                 <!-- /// -->
                 <table id="example" class="table table-striped table-bordered payment_recieved" style="display:none; width: 1005;">
          <thead>
            <tr>
				<th scope="col" class="col-3">Customer Name </th>
				<th scope="col" class="col-3">Payable Amount</th>
				<th scope="col" class="col-3">Customer Phone</th>
				<th scope="col" class="col-3">Customer Email</th>
				<th scope="col" class="col-3">Action</th>
            </tr>
          </thead>
          
          <tbody >       	
            @foreach($accounts as $account)
            @if($account['deleted_at'] != null)
             <tr>
                    <td>{{$account['customer_name']}}</td>
                    <td>{{$account['account'] }}</td>
                    <td>{{$account['customer_phone'] }}</td>
                    <td>{{$account['customer_email']}}</td>
                    <td class="d-flex">
                  <button class="btn btn-secondary">Recieved</button>
                    </td>
                </tr>
                @endif
            @endforeach
          </tbody>
                 </table>
	  </div>
     </div>
  </div>
</div>


<x-installment-modal />
<x-all-installment  :accounts="$accounts"/>

@endsection
@section('script')
@parent
<script type="text/javascript">
	$(document).on('click','.Instalment',function(){
	
        let id=$(this).data('id')
        let price=$(this).data('price')
		$('#exampleModal').modal('show');
		$('#recievable_amount').val(price)
		$('#account').val(id)
	});
	$(document).on('click','.install',function(){
		e.preventDefault();

	});

	$(document).on('click','.all_insall',function(){
	
		$('#installment_modal').modal('show');
		$.ajax
            ({
               url:'/get/payment/installment',
               type:"GET",
               datatype : 'json',
               data:{
               	'id':$(this).data('id'),

               }
              })
             .done(function(res)
             {
                 $('#ins').empty();
                 $('#full-pay').empty();
                $.each(res, function(index,val)
                  {
                  let app=`
                     
                     <tr>
                         <td>${val.installment}</td>
                         <td>${val.price_per_installment}</td>
                         <td>${val.start_date}</td>`;

                          if(val.deleted_at === null){
                          app=app+`<td><button class="btn btn-info recive_installment" data-id="${val.id}" data-account="${val.account_id}">Recieve</button></td>`;
                       }else{
                       	app=app+`<td><button class="btn btn-secondary" disabled >Recieved</button></td>`;
                       }
                      app=app+`
                     </tr>`;
                  $('#ins').append(app);
                  if(index===0)
                  {
                  $('#full-pay').append(`<button type="button"  class="btn btn-primary recieve_payment" data-id="${val.account_id}">Save</button>`);
                  }
                  });
              })
              .fail(function(){ });
		
	});



	$(document).on('click','.recive_installment',function(){
	
		$.ajax
            ({
               url:'/recieve/installment',
               type:"GET",
               datatype : 'json',
               data:{
               	'id':$(this).data('id'),
               	'account':$(this).data('account'),
               }
              })
             .done(function(res)
             {
             	console.log(res);
             	$('#installment_modal').modal('hide');
              })
              .fail(function(){ });
		
	});

  $(document).on('click','.Recieved_payment',function(){

    $('.payment_recievable2').css('display','none')
    $('.payment_recieved').css('display','block')
  });
  $(document).on('click','#Reciev_payment',function(){

    $('.payment_recievable2').css('display','block')
    $('.payment_recieved').css('display','none')
  });
	

</script>

@endsection