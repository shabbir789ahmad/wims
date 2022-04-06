<div>
    <div class="modal fade bd-example-modal-lg" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_id">
        
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Group</label>
           <select class="form-control" name="customer_group" id="c_group"  required>
            <option>General</option>
            <option>Reseller</option>
            <option>Distributor</option>
            <option>New Cusromer</option>
           </select>
           <span>@error('customer_group') {{$message}} @enderror</span>
          </div>
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Name</label>
           <input type="text" name="customer_name" id="customer_name" class="form-control" required>
           <span>@error('customer_name') {{$message}} @enderror</span>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Company</label>
           <input type="text" name="customer_company" id="customer_company" class="form-control" required>
           <span>@error('customer_company') {{$message}} @enderror</span>
          </div>
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Address</label>
           <input type="text" name="customer_address" id="customer_address" class="form-control" required>
            <span>@error('customer_address') {{$message}} @enderror</span>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer City</label>
           <input type="text" name="customer_city" id="customer_city" class="form-control" required>
            <span>@error('customer_city') {{$message}} @enderror</span>
          </div>
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Email</label>
           <input type="email" name="customer_email" id="customer_email" class="form-control" required>
            <span>@error('customer_email') {{$message}} @enderror</span>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Phone</label>
           <input type="phone" name="customer_phone" id="customer_phone" class="form-control" required>
           <span>@error('customer_phone') {{$message}} @enderror</span>
          </div>
          <div class="col-md-6">
            <label for="customer" class="font-weight-bold">Customer Image</label>
           <input type="file"  id="customer_image" class="form-control" required >
           <span>@error('customer_image') {{$message}} @enderror</span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary customer_submit">Save </button>
      </div>
  </form>
    </div>
  </div>
</div>
</div>