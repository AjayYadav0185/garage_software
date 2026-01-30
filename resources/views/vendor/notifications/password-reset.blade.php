<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f5f7fb;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(20, 30, 50, 0.08);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
        }
        .content {
            margin-bottom: 30px;
        }
        .content h1 {
            font-size: 24px;
            color: #333;
        }
        .content p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        .content a {
            color: #007BFF;
            text-decoration: none;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4361ee;
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #777;
        }
        .footer a {
            color: #007BFF;
        }
        .footer p {
            margin: 10px 0;
        }
        .footer .disclaimer {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header with logo -->
        <div class="header">
            <img src="https://yourdomain.com/logo.png" alt="Garage Management">
        </div>

        <!-- Content Section -->
        <div class="content">
            <h1>{{ translate('Password Reset Request') }}</h1>
            <p>{{ translate('Hello') }},</p>
            <p>{{ translate('We received a request to reset your password. If this was you, click the button below to reset your password.') }}</p>

            <!-- Reset Button -->
            <a href="{{reset_url}}" class="button">{{ translate('Reset Password') }}</a>

            <p>{{ translate('This link will expire in 60 minutes. Please make sure to complete the reset process within this time frame.') }}</p>

            <p>{{ translate('If you didnt request a password reset, no further action is required.') }}</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>{{ translate('If you have any questions, feel free to contact us at') }} <a href="mailto:support@yourdomain.com">support@yourdomain.com</a></p>
            <p>{{ translate('Thanks') }},<br>{{ translate('Your Garage Management Team') }}</p>
            <p class="disclaimer">{{ translate('Please do not share your password with anyone, and ensure you are using a secure internet connection when updating your details.') }}</p>
        </div>
    </div>
</body>
</html>
