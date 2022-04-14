
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
	<div class="col-4 col-md-4">
       <h4 class="font-weight-bold">All Invoices</h4>
       		
	</div>
	<!-- <div class="col-8 col-md-8">
		<input type="text" id="myInputTextField" class="form-control border border-secondary" placeholder="Search By Invoice id, Name etc">
   </div> -->
  </div>
</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="card">
		
			<div class="card-body pb-0">
				

				<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th scope="col">Branch Name</th>
				<th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        	
        
            <tr>
			
		     
		     <td >{{ $branchs->branch_name }} </td>
		   
								
								<td class="col-1">
									<div class="d-flex">
								  <a href="{{ route('branch.edit', ['branch' => $branchs->id]) }}" type="submit" class="btn btn-md btn-info">
										Update
									</a>
									
								</div>
									
								</td>
							</tr>
      
        </tbody>
    </table>
			
			</div>
		</form>
		</div>
	</div>
</div>

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

</script>
@endsection
