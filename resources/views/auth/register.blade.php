<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #000;
            color: #000;
        }

        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form {
            width: 100%;
            max-width: 430px;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: absolute;
        }

        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-header h1 {
            font-size: 28px;
            margin-top: 10px;
        }

        .field {
            margin-top: 15px;
        }

        .form-input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #0051bb;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background: #003f99;
        }

        .eye-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }

        .form-link {
            margin-top: 15px;
            text-align: center;
        }

        .form-link a {
            color: #0051bb;
            text-decoration: none;
        }

        .alert {
            background: #ffecec;
            color: #c00;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background: #0051bb;
            color: #fff;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .form {
                max-width: 100%;
                padding: 20px;
            }
        }

        /* HIDE REGISTER / FORGOT FORM BY DEFAULT */
        .form.signup,
        .form.forgot-pass {
            opacity: 0;
            pointer-events: none;
        }

        .forms.show-signup .form.signup {
            opacity: 1;
            pointer-events: auto;
        }

        .forms.show-signup .form.login {
            opacity: 0;
            pointer-events: none;
        }

        .forms.show-forgot .form.forgot-pass {
            opacity: 1;
            pointer-events: auto;
        }

        .forms.show-forgot .form.login {
            opacity: 0;
            pointer-events: none;
        }


        @media (max-width: 360px) {
            .form {
                padding: 10px;
            }

            .login-header h1 {
                font-size: 10px;
            }

            .form-input {
                font-size: 12px;
                padding: 6px 8px;
            }

            button {
                font-size: 10px;
                padding: 6px;
            }
        }
    </style>
</head>

<body>
    <section class="container forms">

        {{-- LOGIN --}}
        <div class="form login">
            <div class="login-header">
                <h1>Admin | Login</h1>
            </div>

            @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="field">
                    <select name="login_type" class="form-input" required>
                        <option value="admin">Admin</option>
                        <option value="employee">Employee</option>
                    </select>
                </div>

                <div class="field">
                    <input type="text" name="email" value="{{ old('email') }}"
                        placeholder="Email / User Code" class="form-input" required>
                </div>

                <div class="field" style="position:relative;">
                    <input type="password" name="password" placeholder="Password"
                        class="form-input password" required>
                    <i class="bx bx-hide eye-icon"></i>
                </div>

                <button type="submit">Login</button>
            </form>

            <div class="form-link">
                <a href="#" class="link forgot-link">Forgot Password?</a>
                <br>
                <span>Don’t have an account?
                    <a href="#" class="link signup-link">Register</a>
                </span>
            </div>

            <div style="margin-top: 15px; text-align:center; font-size: 14px;">
                Any Problem? WhatsApp: <a href="https://wa.me/919958300122" target="_blank">9958300122</a>
            </div>
        </div>

        {{-- REGISTER --}}
        <div class="form signup">
            <div class="login-header">
                <h1>Admin | Register</h1>
            </div>

            @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <input type="text" name="name" value="{{ old('name') }}"
                        placeholder="Garage Name" class="form-input" required>
                </div>

                <div class="field">
                    <input type="number" name="mobile" value="{{ old('mobile') }}"
                        placeholder="Mobile No." class="form-input" required>
                </div>

                <div class="field">
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="Email" class="form-input" required>
                </div>

                <div class="field">
                    <input type="text" name="address" value="{{ old('address') }}"
                        placeholder="Address" class="form-input" required>
                </div>

                {{-- COUNTRY SELECT --}}
                <div class="field">
                    <input type="hidden" name="lang" id="langField" value="en">
                    <input type="hidden" name="code" id="codeField" value="en">
                    <select name="country_id" class="form-input" required>
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}" data-code="{{ $country->code }}" data-lang="{{ $country->language }}"
                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                        @endforeach

                    </select>
                </div>

                <div class="field" style="position:relative;">
                    <input type="password" name="password"
                        placeholder="Password" class="form-input password" required>
                    <i class="bx bx-hide eye-icon"></i>
                </div>

                <!-- Terms & Conditions -->
                <div class="field">
                    <label style="font-size: 14px; color: #333;">
                        <input type="checkbox" name="terms" required>
                        I agree to the
                        <a href="https://merigarage.com/terms.php" target="_blank" style="color: #0051bb;">
                            Terms & Conditions
                        </a>
                    </label>
                </div>

                <button type="submit">Register</button>
            </form>

            <div class="form-link">
                <span>Already have an account?
                    <a href="#" class="link login-link">Login</a>
                </span>
            </div>

            <div style="margin-top: 15px; text-align:center; font-size: 14px;">
                Any Problem? WhatsApp: <a href="https://wa.me/919958300122" target="_blank">9958300122</a>
            </div>
        </div>

        {{-- FORGOT PASSWORD --}}
        <div class="form forgot-pass">
            <div class="login-header">
                <h1>Forgot Password</h1>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="field">
                    <input type="email" name="email" placeholder="Enter your email"
                        class="form-input" required>
                </div>

                <button type="submit">Send Reset Link</button>
            </form>

            <div class="form-link">
                <a href="#" class="link login-link">Back to Login</a>
            </div>

            <div style="margin-top: 15px; text-align:center; font-size: 14px;">
                Any Problem? WhatsApp: <a href="https://wa.me/919958300122" target="_blank">9958300122</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} OTODIGITAL TECHNOLOGIES PVT LTD</p>
    </footer>

    <script>
        const forms = document.querySelector(".forms");
        const pwShowHide = document.querySelectorAll(".eye-icon");
        const links = document.querySelectorAll(".link");

        pwShowHide.forEach(icon => {
            icon.addEventListener("click", () => {
                const input = icon.previousElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("bx-hide", "bx-show");
                } else {
                    input.type = "password";
                    icon.classList.replace("bx-show", "bx-hide");
                }
            });
        });

        links.forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault();

                if (link.classList.contains("signup-link")) {
                    forms.classList.add("show-signup");
                    forms.classList.remove("show-forgot");
                } else if (link.classList.contains("login-link")) {
                    forms.classList.remove("show-signup");
                    forms.classList.remove("show-forgot");
                } else if (link.classList.contains("forgot-link")) {
                    forms.classList.add("show-forgot");
                    forms.classList.remove("show-signup");
                }
            });
        });

        const countrySelect = document.querySelector("select[name='country_id']");
        const langField = document.getElementById("langField");
        const codeField = document.getElementById("codeField");

        countrySelect.addEventListener("change", function() {
            const selected = this.options[this.selectedIndex];
            const language = selected.getAttribute('data-lang') || 'en';
            const code = selected.getAttribute('data-code') || 'IN';
            langField.value = language;
            codeField.value = code;
        });
    </script>

</body>

</html>