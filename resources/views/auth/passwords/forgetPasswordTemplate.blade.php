<?php /* <h1>Forget Password Email</h1>
You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a> */ ?>

<x-mail-template>
@section('mail_body')
<table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
  <!-- Body content -->
  <tr>
    <td class="content-cell">
      <div class="f-fallback">
        <h1>Hi {{$merchant_name}},</h1>
        <p>You recently requested to reset your password for your <b>Wavexpay Merchent dashboard</b> account. Use the button below to reset it. <strong>This password reset is only valid for the next 24 hours.</strong></p>
        <!-- Action -->
        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          <tr>
            <td align="center">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                <tr>
                  <td align="center">
                    <a href="{{ route('reset.password.get', $token) }}" class="f-fallback button button--green" target="_blank">Reset your password</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
        <p>For security, this request was received from a Wavexpay Merchent dashboard (https://wavexpay.com/merchants/forget-password) . If you did not request a password reset, please ignore this email or <a href="https://wavexpay.com/contact-us">contact support</a> if you have questions.</p>
        <p>Thanks,
          <br>The Wavexpay Team</p>
        <!-- Sub copy -->
        <?php /* <table class="body-sub" role="presentation">
          <tr>
            <td>
              <p class="f-fallback sub">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
              <p class="f-fallback sub">__action_url__</p>
            </td>
          </tr>
        </table> */ ?>
      </div>
    </td>
  </tr>
</table>
@endsection                
</x-mail-template>