@include('mail.head')
<main>
    <div
        style="
            margin: 0;
            margin-top: 70px;
            padding: 92px 30px 115px;
            background: #ffffff;
            border-radius: 30px;
            text-align: center;
          ">
        <div style="width: 100%; max-width: 489px; margin: 0 auto;">
            <h1
                style="
                margin: 0;
                font-size: 24px;
                font-weight: 500;
                color: #1f1f1f;
              ">
                OTP Verification
            </h1>
            <p
                style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
            ">
                Hi,
            </p>
            <p
                style="
                margin: 0;
                margin-top: 17px;
                font-weight: 500;
                letter-spacing: 0.56px;
              ">
                We detected a login attempt to your Spoon PH account. To continue logging in, please enter the verification code below:
            </p>
            <p
                style="
                margin: 0;
                margin-top: 60px;
                font-size: 40px;
                font-weight: 600;
                letter-spacing: 25px;
                color: #ba3d4f;
              ">
                {{ $verificationCode }}
            </p>
        </div>
    </div>

    <p
        style="
            max-width: 400px;
            margin: 0 auto;
            margin-top: 90px;
            text-align: center;
            font-weight: 500;
            color: #8c8c8c;
          ">
        Thank you for choosing Spoon PH!
    </p>
</main>
@include('mail.footer')