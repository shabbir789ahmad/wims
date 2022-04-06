<div>
   
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Installment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('make.Installment')}}" method="POST">
        @csrf
      <div class="modal-body">
        <input type="hidden" name="account_id" id="account">
         <span class="text-danger">@error ('account_id') {{$message}} @enderror</span>
         <lable class="font-weight-bold mt-2">Receivable Amount</lable>
         <input type="text" name="price" id="recievable_amount" class="form-control" readonly>

         <lable class="font-weight-bold mt-2">Select no Of Installment</lable>
         <input type="number" name="installment" class="form-control">
         <span class="text-danger">@error ('installment') {{$message}} @enderror</span>
         <lable class="font-weight-bold mt-2">Duration Type</lable>
         <select class="form-control " name="duration_type">
            <option selected hidden disabled>Select Duration Type in Motnh,Days or year</option>
            <option value="day">Days</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
         </select>
         <lable class="font-weight-bold mt-2">Duration Of payment</lable>
         <input type="number" name="duration" class="form-control">
         <span class="text-danger">@error ('duration') {{$message}} @enderror</span>

         
      </div>
      <div class="modal-footer">
        
        <button type="submit"  class="btn btn-primary">Save</button>
      </div>
     </form>
    </div>
  </div>
</div>
</div>