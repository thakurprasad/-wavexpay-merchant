<x-mail-template>
@section('mail_body')
<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
  <!-- Body content -->
  <tr>
    <td class="content-cell">
      <div class="f-fallback">
        <h1>Hi {{$name}},</h1>
        <p>You recently Registering to <a href="https://wavexpay.com"><b>Wavexpay Merchent</b></a> account. Use the below Login credentials to Login your Merchant Account. <br>
          <h4>Login Credentials</h4></p>
          <p>
            <strong>Username: </strong> {{ $username }}<br>
            <strong>Password: </strong> {{ $password }}<br>
          </p>
        <!-- Action -->
        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <tr>
            <td align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td align="center">
                    <a href="{{ url('/login') }}" class="f-fallback button button--green" target="_blank">Login WaveXpay Account</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <p>For security, this request was received from a Wavexpay Merchent Registration ( {{ url('/register') }} ) . If you did not register, please ignore this email or <a href="https://wavexpay.com/contact-us">contact support</a> if you have questions.</p>
        <p>Thanks,
          <br>The Wavexpay Team</p>
      </div>
    </td>
  </tr>
</table>
@endsection                
</x-mail-template>