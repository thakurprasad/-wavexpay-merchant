<div id="billingmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Billing Address &nbsp;&nbsp;<a onclick="get_existing_address('billing')" data-toggle="modal" data-target="#existingbillingmodal" class="btn btn-sm btn-primary" style="color:#ffffff;">Existing Address</a></h6>
      </div>
      <div class="modal-body">
        <span id="change_b_address"></span>
        <form id="form-create-billing-address" method="post">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea placeholder="Enter Billing Address 1" name="billing_address1" id="billing_address1" class="form-control" required></textarea>
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea placeholder="Enter Billing Address 2" name="billing_address2" id="billing_address2" class="form-control" required></textarea>
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="State" name="billing_state" id="billing_state" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="City" name="billing_city" id="billing_city" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="Country" name="billing_country" id="billing_country" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="Zip" name="billing_zip" id="billing_zip" type="text" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-sm-6" id="customer_button">                          
                <button class="btn btn-md btn-info" id="create_customer_btn" type="button" name="action" onclick="add_billing_address()">+ Add Billing Address
                </button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<x-existing-billing-modal/>