<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wavexpay | Signup</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-10">
      <div class="card">
        <form>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Sign Up To Continue</h3>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="d-flex align-items-start">
                  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Business Type</button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Contact Details</button>
                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Business Overview</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Business Details</button>
                  </div>
                  <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                      <!--Form Start-->
                      <div class="row" style="width:700px;">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Business Type</h3>
                            </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Business Type</label>
                                      <select class="form-control" name="business_type">
                                        <option value="">Select</option>
                                        <option value="not_registered">Not Yet Registered</option>
                                        <option value="registered">Registered</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Registered Business Type</label>
                                      <ul class="list-group">
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Propeitorship</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Partnership</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Private Limited</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Public Limited</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">LLP</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Trust</li>
                                        <li class="list-group-item" style="border-color:#A9A9A9; border-width:1px;">Society</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save & Next</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <!--Form End-->
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                      <!--Form Start-->
                      <div class="row" style="width:700px;">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Your Conatct Details</h3>
                            </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Your Name</label>
                                      <input type="text" name="name" class="form-control" placeholder="Your Name" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Your Conatact Number</label>
                                      <input type="text" name="contact" class="form-control" placeholder="Contact Number" />
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save & Next</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <!--Form End-->
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                      <!--Form Start-->
                      <div class="row" style="width:700px;">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Business Overview</h3>
                            </div>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Business Type</label>
                                      <select class="form-control" name="business_type">
                                        <option value="">Select</option>
                                        <option value="not_registered">Not Yet Registered</option>
                                        <option value="registered">Registered</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Business Category</label>
                                      <select class="form-control" name="business_type">
                                        <option value="">Select</option>
                                        <option value="ecommerce">Ecommerce</option>
                                        <option value="education">Education</option>
                                        <option value="lifestyle">Fashion Lifestyle</option>
                                        <option value="beverage">Food & Beverage</option>
                                        <option value="grocery">Grocery</option>
                                        <option value="it">It Software</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="services">Services</option>
                                        <option value="development">Web Design Development</option>
                                        <option value="accountingservices">Accounting Services</option>
                                        <option value="repair">Automotive Reppair Shop</option>
                                        <option value="cabservice">Cab Service</option>
                                        <option value="caterer">Caterer</option>
                                        <option value="charity">Charity</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Business Description</label>
                                      <textarea name="business_description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">How Do You Wish To Accept Payment?</label>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="acceptpaymentby" id="flexRadioDefault1" value="withoutapp">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                          Without Website/App
                                        </label>
                                        <input class="form-check-input" type="radio" name="acceptpaymentby" id="flexRadioDefault2" style="margin-left: 130px;" value="withapp">
                                        <label class="form-check-label" for="flexRadioDefault2" style="margin-left: 150px;">
                                          With My Web/App
                                        </label><br />                                         
                                        <input type="text" style="margin-left: 270px; width: 300px; margin-top:5px;" placeholder="Web Url" class="form-control" id="weburl" name="weburl" style="display:none;" />
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save & Next</button>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <!--Form End-->
                    </div>
                    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                      <!--Form Start-->
                      <div class="row" style="width:700px;">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Business Details</h3>
                            </div>                         
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="card-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">PAN</label>
                                      <input type="text" class="form-control" name="PAN" id="PAN" maxlength="10"  style="text-transform:uppercase" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">PAN Holder Name</label>
                                      <input type="text" class="form-control" name="panholdername" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Billing Label</label>
                                      <input type="text" class="form-control" name="billinglabel" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Address</label>
                                      <textarea class="form-control" name="address"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">PINCODE</label>
                                      <input type="text" class="form-control" name="pincode" />
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">City</label>
                                      <input type="text" class="form-control" name="city" />
                                    </div>
                                  </div>
                                </div>
                                <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save & Next</button>
                                </div>
                              </div>                         
                          </div>
                        </div>
                      </div>
                      <!--Form End-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <!-- /.container-fluid -->
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $( document ).ready(function() {
    $("#weburl").hide();
  });
  $('#flexRadioDefault2').on('click', function(event) {
      $("#weburl").show();
  });
  $('#flexRadioDefault1').on('click', function(event) {
      $("#weburl").hide();
  });
</script>
</body>
</html>
