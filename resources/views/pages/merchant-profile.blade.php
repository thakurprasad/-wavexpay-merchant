{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','User Profile')

{{-- page content --}}
@section('content')
<div class="section">
    <div class="card">
        <div class="card-content">
        <div class="row">
            <div class="col s12">
                <div class="row" id="main-view">
                <div class="col s12">
                    <ul class="tabs tab-demo z-depth-1">
                        <li class="tab col m2"><a class="active" href="#profile">Profile</a></li>
                        <li class="tab col m2"><a href="#trusted_badge">Trusted Badge</a></li>
                        <li class="tab col m2"><a href="#credits">Credits</a></li>
                        <li class="tab col m2"><a href="#balances">Balances</a></li>
                        <li class="tab col m2"><a href="#manage_teams">Manage Teams</a></li>
                        <li class="tab col m2"><a href="#support_tickets">Support Tickets</a></li>
                    </ul>
                </div>
                <div class="col s12">
                    <div id="profile" class="col s12">
                    <div id="view-borderless-table">
            <div class="row">
              <div class="col s12">
                <table>
                  <thead>
                    <tr>
                      <th data-field="id">Merchant Id: TEST_12344</th>
                      <th data-field="name"><a href="#">Change Password</a></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Contact Name</td>
                      <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                      <td>Display Name</td>
                      <td>{{ Auth::user()->name }} <i class="material-icons tiny dp48">edit</i></td>
                    </tr>
                    <tr>
                      <td>Contact Email</td>
                      <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                      <td>Contact Number</td>
                      <td>9448587866 <i class="material-icons tiny dp48">edit</i></td>
                    </tr>
                    <tr>
                      <td>Business Name</td>
                      <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                      <td>Business Type</td>
                      <td>Proprietorship</td>
                    </tr>
                    <tr>
                      <td>Registration Date</td>
                      <td>{{ Auth::user()->created_at }}</td>
                    </tr>
                    <tr>
                      <td><strong>Account Activation</strong></td>
                      <td><a href="#">View Activation Form</a></td>
                    </tr>
                    <tr>
                      <td>Account Activated On</td>
                      <td>{{ Auth::user()->updated_at }}</td>
                    </tr>
                    <tr>
                      <td>Account Access</td>
                      <td>Complete</td>
                    </tr>
                    <tr>
                      <td>Business Website/App details</td>
                      <td><a href="www.example.com">https://www.example.com</a></td>
                    </tr>
                    <tr>
                      <td>Additional Business Website/App</td>
                      <td>--</td>
                    </tr>
                    <tr>
                      <td>Limit per transaction</td>
                      <td>₹ 5,00,000.00 <i class="material-icons tiny dp48">edit</i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

                    </div>
                    <div id="trusted_badge" class="col s12">
                        <p class="mt-2 mb-2">
                            Pudding chocolate bear claw dragée biscuit. Jelly powder cake. Liquorice biscuit donut
                            jelly-o chocolate. Liquorice cake gummies tart cupcake.
                        </p>
                    </div>
                    <div id="credits" class="col s12">
                        <p class="mt-2 mb-2">
                            Cupcake ipsum dolor sit amet. Powder donut cake. Pudding toffee jujubes marzipan
                            pudding.
                        </p>
                    </div>
                    <div id="balances" class="col s12">
                        <p class="mt-2 mb-2">
                            Brownie marshmallow sweet macaroon. Danish carrot cake chocolate bar dessert croissant
                            toffee pie caramels. Bonbon tart croissant chupa chups dessert.
                        </p>
                    </div>
                    <div id="manage_teams" class="col s12">
                        <p class="mt-2 mb-2">
                            Brownie marshmallow sweet macaroon. Danish carrot cake chocolate bar dessert croissant
                            toffee pie caramels. Bonbon tart croissant chupa chups dessert.
                        </p>
                    </div>
                    <div id="support_tickets" class="col s12">
                        <p class="mt-2 mb-2">
                            Brownie marshmallow sweet macaroon. Danish carrot cake chocolate bar dessert croissant
                            toffee pie caramels. Bonbon tart croissant chupa chups dessert.
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
