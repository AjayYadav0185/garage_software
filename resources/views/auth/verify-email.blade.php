<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - Garage Management</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        /* --- Reset & Base Styles --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #000000, #000000);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* --- Container --- */
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-top: 25px;
            padding: 30px 25px;
        }

        /* --- Header --- */
        .login-header {
            color: #202039;
            text-align: center;
            padding: 16px 22px;
            font-size: 23px;
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* --- Form --- */
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #202039;
            box-shadow: 0 0 8px rgba(74, 0, 224, 0.2);
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: #0171d3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: #015fa0;
        }

        .form-link {
            text-align: center;
            margin-top: 15px;
        }

        .form-link a {
            color: #0171d3;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .form-link a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        footer p {
            color: #ffffff;
            padding: 10px 0;
            font-size: 14px;
            background: #0171d3;
        }

        /* --- Mobile Responsiveness --- */
        @media screen and (max-width: 600px) {
            body {
                background: linear-gradient(135deg, #6a11cb, #2575fc);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 20px;
            }

            .login-container {
                width: 100%;
                max-width: 400px;
                margin-left: auto;
                margin-right: auto;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
                padding: 25px;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h1>Email Verification</h1>
            <p>Thanks for signing up! Before getting started, please verify your email address.</p>
        </div>

        <!-- Verification Information -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        <!-- Success Message if Verification Link is Sent -->
        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success mb-4">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <!-- Resend Verification Email Form -->
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div>
                    <button type="submit" class="login-btn">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

            <!-- Log Out Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>

        <div class="form-link">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} OTODIGITAL TECHNOLOGIES PVT LTD. All rights reserved.</p>
    </footer>

</body>

</html>
