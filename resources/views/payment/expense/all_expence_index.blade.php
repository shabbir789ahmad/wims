@extends('panel.master')
@section('content')


<div class="row">
	<div class="col-12">
		<div class="card">
			
			<div class="card-body pb-0">
				@if(count($expence) > 0)

				<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                
								<th scope="col">Expense Type </th>
								<th scope="col">Expense Amount </th>
								<th scope="col">Customer Name </th>
								
								
								<th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        	
        	@foreach($expence as $payment)
        	
            <tr>
					
								<td>
									{{ $payment->expence_type }}
								</td>
								<td>
									{{ $payment->expense }}
								</td>
								<td>
									{{ $payment->name }}
								</td>
							
								
								<td class="col-2 d-flex">
									
									<button type="button" data-id="{{$payment->id}}" data-expense="{{$payment->expence_type}}"  class="btn btn-xs btn-info ml-2 expense">
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
<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Installment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('expense.create')}}" method="POST">
      	@csrf
      <div class="modal-body">
      	
         <lable class="font-weight-bold mt-2">Expense Type</lable>
         <input type="text" name="expence_type" placeholder="Create new Expense Type" id="recievable_amount" class="form-control">
         <span class="text-danger">@error ('expence_type') {{$message}} @enderror</span>
        
      </div>
      <div class="modal-footer">
        
        <button type="submit"  class="btn btn-primary">Save</button>
      </div>
     </form>
    </div>
  </div>
</div>
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
$('#example').DataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    });
</script>
@parent
@endsection