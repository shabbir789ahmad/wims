<div>
    <div class="modal fade bd-example-modal-lg" id="payment-partial-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Partial"></h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
   
      <form action="{{route('order.payment')}}" method="POST">
        @csrf
      <div class="modal-body" >
          
             <input type="hidden" name="biller_name" class="form-control" value="{{Auth::user()->name}}">
            <div class="row mt-2  ">
             <div class="col-md-6">
               <label class="font-weight-bold">Paying By<span class="text-danger">*</span></label>
               <select class="form-control" name="paying_by">
                <option value="cash">Cash</option>
                <option>Card</option>
               </select>
             </div>
             <div class="col-md-6 ">
               <label class="font-weight-bold">Customer Name<span class="text-danger">*</span></label>
               <div class="d-flex">
               <select class="form-control" name="customer_id" id="customer_id">
                </select>
                <i class="fas fa-plus-square text-info fa-2x text-center px-2" data-toggle="modal" data-target="#customerModal"></i>
              </div>
             </div>
           </div>
           <div class="row mt-2">
            
            <div class="col-md-6">
              <label class="font-weight-bold">Payable Amount<span class="text-danger">*</span></label>
               <input type="number" name="payable_amount" class="form-control grand_total" readonly>
            </div>
            <div class="col-md-6">
              <label class="font-weight-bold">Paying Amount</label>
              <input type="number" name="paying_amount" class="form-control as" value="0" id="amount2" onfocus=" let value = this.value; this.value = null; this.value=value" autofocus>
            </div>
           </div>
           <div class="row mt-2" >
            <div class="col-md-6">
              <label class="font-weight-bold">Account Type</label>
              <select class="form-control" name="account_type" id="account_type">
                <option value="1">Permanant Account</option>
                <option value="0">Temporary Account</option>
              </select>
              <span class="text-danger">@error ('paying_discount') {{$message}} @enderror</span>
            </div>
            <div class="col-md-6 ">
              <label class="font-weight-bold">Paying Date <span class="text-danger">*</span></label>
              <input type="datetime-local" name="paying_date" class="form-control  paying_date"  >
              <span class="text-danger">@error ('paying_date') {{$message}} @enderror</span>
            </div>
            
              <input type="hidden" name="paying_discount" class="form-control discount2" value="0" >
              <input type="hidden" name="tax" class="form-control tax3" value="0" >
         

          </div>

           <div class="row mt-5">
              <div class="col-md-6 d-flex">
               <p class="ml-1">Item</p>
               <p class="ml-auto mr-1 font-weight-bold " ><span class="items"></span><span class="quan"></span></p>
              </div>
              <div class="col-md-6 d-flex">
               <p class="ml-1">Total Payable</p>
               <p class="ml-auto mr-1 font-weight-bold g_total2" id="total_payable2">0</p>
              </div>
            </div>
            <div class="row border-top">
              <div class="col-md-6 d-flex">
               <p class="ml-1" >Total Paying </p>
               <p class="ml-auto mr-1 font-weight-bold" id="total_paying2">0</p>
              </div>
              <div class="col-md-6 d-flex">
               <p class="ml-1" id="change">Remaining </p>
               <p class="ml-auto mr-1 font-weight-bold" id="remaining2">0</p>
              </div>
            </div>
          
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" id="save-button" >Save </button>
      </div>
    </form>
    </div>
  </div>
</div>
</div>