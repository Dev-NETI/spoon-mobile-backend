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
                Welcome to COMPANY TEST. Please enter the code above on the verification page to complete the login
                process, and do not share this OTP with anyone. OTP is valid for
                <span style="font-weight: 600; color: #1f1f1f;">5 minutes</span>.
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
                {{ $otp }}
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
        Need help? Ask at
        <a href="mailto:archisketch@gmail.com" style="color: #499fb6; text-decoration: none;">sample@gmail.com</a>
        or visit our
        <a href="" target="_blank" style="color: #499fb6; text-decoration: none;">Help Center</a>
    </p>
</main>
@include('mail.footer')