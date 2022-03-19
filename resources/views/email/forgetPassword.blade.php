<!-- <h1>Forget Password Email</h1>
   
You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a> -->

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-weight: 500;
            font-family: Arial, sans-serif;
        }
        .btn {margin: 10px 0px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff !important;
            height: 46px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-image: linear-gradient(to right top, #021d68, #052579, #072d8b, #09369d, #093fb0) !important;
        }
        .btn:hover {
            text-decoration: none;
            opacity: .8;
        }
    </style>
</head>
<body>
    <div style="background:rgb(237,242,247);">
        <div style="background:rgb(237,242,247);"> 
            <h2 style="font-weight: bold;font-family:Arial,sans-serif;text-align:center;padding-top:20px;color:rgb(61,72,82);">WeCare</h2>
        </div>
        <table role="presentation"
            style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:rgb(237,242,247);">
            <tr>
                <td align="center" style="padding:0;">
                    <table role="presentation"
                        style="width:600px;border-collapse:collapse;border-spacing:0;text-align:left;">
                        <tr>
                            <td style="padding:10px 30px 10px 30px;background:#fff;">
                                <table role="presentation"
                                    style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#fff;">
                                    <tr>
                                        <td style="padding:0 0 36px 0;color:#153643;">
                                            <h3><p style="font-weight:bold;margin:0 0 20px 0;font-family:Arial,sans-serif;font-size:18px;color:rgb(61,72,82);padding-top:-50px;">
                                            Hello!</h1></h3>
                                            <p style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;color:gray;">
                                                You are receiving this email because we received a password reset request for your account.
                                                </p>
                                            <p style="margin:10px 0 0 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;color:gray;">
                                                You can reset your password by clicking the button below:
                                            </p><br>

                                            <p style="text-align: center;">
                                                <a href="{{ route('reset.password.get', $token) }}" class="btn" style="background:rgb(45,55,72);">Reset Password</a>
                                            </p><br>

                                            <p style="margin:10px 0 12px 0;font-size:14px;line-height:25px;font-family:Arial,sans-serif;color:gray;">
                                                If you did not request a password reset, no further action is required.
                                            </p>

                                            <p style="margin:5px 0 0 0;font-size:14px;font-family:Arial,sans-serif;color:gray;">
                                                Regards, </p>
                                            <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;color:gray;">
                                                WeCare </p>

                                                <hr>

                                            <p style="margin:25px 0 0 0;font-size:14px;font-family:Arial,sans-serif;color:gray;">
                                                If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser: <a href="{{ route('reset.password.get', $token) }}" style="font-size:14px;font-family:Arial,sans-serif;">http://wecare.com/reset-password/{{$token}}</a>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <div style="background:rgb(237,242,247);text-align:center;"> 
            <p style="font-family:Arial,sans-serif;font-size:12px;padding-bottom:20px;color:gray;">&copy; @php echo date("Y");@endphp WeCare. All rights reserved.</p>
        </div>
        </table>
        
    </div>
</body>
</html>