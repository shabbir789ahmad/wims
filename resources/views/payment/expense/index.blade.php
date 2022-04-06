@extends('panel.master')
@section('content')

<div class="row">
	<div class="col-12">
		<div class="form-group">
			<div class="btn-group" role="group" aria-label="Basic example">
				<button  class="btn btn-primary" data-target="#expenseModal" data-toggle="modal">
					Create
				</button>
				
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
			
			<div class="card-body pb-0">
				@if(count($expense) > 0)

				<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
								<th scope="col">Customer Name </th>
								
								
								<th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        	
        	@foreach($expense as $payment)
        	
            <tr>
					
								<td>
									{{ $payment->expence_type }}
								</td>
							
								
								<td class="col-2 d-flex">
									
									<button type="button" data-id="{{$payment['id']}}" data-expense="{{$payment['expence_type']}}"  class="btn btn-xs btn-info ml-2 expense">
											Update 
										</button>

									<form action="{{ route('expense.destroy', ['id' => $payment->id]) }}" method="POST" class="d-inline" onsubmit="return confirmDelete()">
										@method('DELETE')
										@csrf
										<button type="submit" class="btn btn-xs btn-danger">
											Delete
										</button>
									</form>
								
									
								</td>
							</tr>
            @endforeach
        </tbody>
    </table>
				
				 
				@else
				<x-alert.resource-empty resource="products" new="expense.create"></x-alert.resource-empty>
				@endif			
			</div>
		
		</div>
	</div>
</div>




<!-- Modal -->

	 <x-expense-component  />
<!-- Modal -->
<div class="modal fade" id="expenseupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Installment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('expense.update')}}" method="POST">
      	@csrf
      	@method('PUT')
      <div class="modal-body">
      	<input type="text" name="id" id="expense_id">
         <lable class="font-weight-bold mt-2">Expense Type</lable>
         <input type="text" name="expence_type" id="expense_type" class="form-control">
         <span class="text-danger">@error ('expense_type') {{$message}} @enderror</span>
        
      </div>
      <div class="modal-footer">
        
        <button type="submit"  class="btn btn-primary">Save</button>
      </div>
     </form>
    </div>
  </div>
</div>


@endsection
@section('script')
<script type="text/javascript">

 $('.expense').click(function(e){

 	e.preventDefault()
 	let id=$(this).data('id')
 	let expense=$(this).data('expense')
 	$('#expenseupdate').modal('show')
 	$('#expense_id').val(id);
 	$('#expense_type').val(expense);
 })
</script>
@parent
@endsection