<div>
    <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Expense Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
  
      <div class="modal-body">
        
         <lable class="font-weight-bold mt-2">Expense Type</lable>
         <input type="text" name="expence_type" id="expence_type" placeholder="Create new Expense Type" id="recievable_amount" class="form-control">
         <span class="text-danger">@error ('expence_type') {{$message}} @enderror</span>
        
      </div>
      <div class="modal-footer">
        
        <button type="button"  class="btn btn-primary" id="add_expense_type"></button>
      </div>
    
    </div>
  </div>
</div>
</div>