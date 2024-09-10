@include('mail.head')
<div class="v-font-size" style="font-size: 14px; line-height: 140%; text-align: justify; word-wrap: break-word;">
    {{-- <p style="line-height: 140%;">This is the Body</p> --}}
    <p style="margin-bottom: 10px;">Hi,</p>
    <p style="margin-bottom: 10px;">We detected a login attempt to your Spoon PH account. To continue logging in, please enter the verification code below:</p>
    <p style="margin-bottom: 10px;">Your Verification Code: <strong>{{$verificationCode}}</strong></p>
    <p style="margin-bottom: 10px;">Thank you for choosing Spoon PH!</p>
    <p style="margin-bottom: 10px;">Best regards,</p>
</div>
@include('mail.footer')