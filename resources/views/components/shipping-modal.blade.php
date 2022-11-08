<div id="shippingmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Shipping Address &nbsp;&nbsp;<a onclick="get_existing_address('shipping')" data-toggle="modal" data-target="#existingshippingmodal" class="btn btn-sm btn-primary" style="color:#ffffff;">Existing Address</a></h4>
      </div>
    <div class="modal-body">
       <span id="change_s_address"></span>
        <form id="form-create-shipping-address" method="post">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea placeholder="Enter Shipping Address 1" name="shipping_address1" id="shipping_address1" class="form-control" required></textarea>
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <textarea placeholder="Enter Shipping Address 2" name="shipping_address2" id="shipping_address2" class="form-control" required></textarea>
                        <span class="text-danger" id="emailError"></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="State" name="shipping_state" id="shipping_state" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="City" name="shipping_city" id="shipping_city" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="Country" name="shipping_country" id="shipping_country" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input placeholder="Zip" name="shipping_zip" id="shipping_zip" type="text" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="col-sm-6" id="customer_button">                          
                <button class="btn btn-md btn-primary" id="create_customer_btn" type="button" name="action" onclick="add_shipping_address()">+ Add Shipping Address
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>

<x-existing-shipping-modal/>