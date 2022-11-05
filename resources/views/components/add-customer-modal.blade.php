<div class="modal fade" id="customeraddmodal" role="dialog" style="z-index:9999999;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form-create-customer" method="post">
            <input type="hidden" id="edit_id">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Company Name/Individual Name</label>
                    <input placeholder="Company Name/Individual Name" name="name" id="name" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="nameError"></span>
            </div>

            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Email</label>
                    <input placeholder="Email" name="email" id="email" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="emailError"></span>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">Contact Number</label>
                    <input placeholder="Customer Contact" name="customer_contact" id="customer_contact" type="text" class="form-control" required>
                </div>
                <span class="text-danger" id="contactNumberError"></span>
            </div>


            <div class="col-sm-12">
                <div class="form-group">
                    <label for="first_name">GSTIN</label>
                    <input placeholder="GSTIN" name="gstin" id="gstin" type="text" class="form-control" required>
                </div>
            </div>


            <div class="col-sm-12">
                <span id="load_msg" style="display:none;">Please wait.....</span>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <span id="customer_button"><button type="button" id="create_customer_btn" onclick="create_customer()" class="btn btn-primary">Save changes</button></span>
      </div>
    </div>
  </div>
</div>