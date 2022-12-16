<x-mail-template-merchnat>
@section('mail_body')
<?php 
/*$payment_link = "#";
$payment_id = "plink_KdrMVhVOiIdBKk";
$logo = "https://websoft-tech.com/img/websoft-tech-logo.jpg";
$issued_to_name = "Raju Singh";
$issued_to_mobile = "87598437598";
$issued_to_email = "raju12@gmail.com";
$amount_payable = number_format(2730,2);
$merchant_display_name = "Websoft Tech";
$merchant_address = "Delhi"*/

?>
<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
  <!-- Body content -->
  <tr>
    <td class="text-center" style="border-bottom: 1px solid #ccc;">
      <img src="{{ $logo }}" />
      <p>
        Payment requested by <b>{{$merchant_display_name}}</b>
        <br>Payment Link Id: {{$payment_id}} 
      </p>
    </td>
  </tr>
  @if(session()->get('mode') == 'test')
  <tr>
    <td class="test-mode">
      This Payment Link is created in Test Mode. Only test payments can be made for this Payment Link.
    </td>
  </tr>
  @endif
  <tr>
    <td class="content-cell" style="padding-top:0px">
      <div class="f-fallback">
        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <tr>
            <td align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                 <tr>
                  <td colspan="2">
                    PAYMENT FOR Invoice <br>
                    ISSUED TO <br> 
                      {{$issued_to_name}} , {{$issued_to_mobile}}<br>
                      {{$issued_to_email}}<br>
                  </td>
                </tr>
                <tr>
                  <td class="text-right content-cell" style="padding-left: 0px;padding-right: 0px;">
                    <b>AMOUNT PAYABLE</b>
                    <h3 style="text-align: right; font-size: 28px;color: green;">INR {{ $amount_payable }}</h3>
                  </td>
                  <td class="text-right content-cell" style="padding-left: 0px;padding-right: 0px;">
                    <a href="{{ $payment_link }}" class="f-fallback button button--green" target="_blank"> Proceed To Pay</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <hr>
        <p class="text-center">{{$merchant_display_name}}<br> {{ $merchant_address }}</p><br>
    <?php /*     <p>Thanks,
          <br>The Wavexpay Team</p> */?>
      </div>
    </td>
  </tr>
</table>
@endsection                
</x-mail-template>