<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Garage Management</title>
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
            <h1>Forgot Password</h1>
            <p>Enter your email to receive a password reset link.</p>
        </div>


        @if(session('status'))
        <!-- Session Status -->
        <div class="alert alert-success">
            <p>{{ session('status') }}</p>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-input-label">Email</label>
                <input type="email" id="email" name="email" class="form-input" required autofocus value="{{ old('email') }}" autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="login-btn">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>

        <div class="form-link">
            <a href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} OTODIGITAL TECHNOLOGIES PVT LTD. All rights reserved.</p>
    </footer>

</body>

</html>