<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Management - Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            transition: all 0.3s ease;
            margin-top: 25px;
        }

        .login-header {
            color: #202039;
            text-align: center;
            padding: 16px 22px !important;
            font-size: 23px !important;
        }

        .login-body {
            padding: 30px 25px;
        }

        a {
            color: #0171d3 !important;
        }

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
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
            font-size: 18px;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: #0171d3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        footer p {
            color: #fff;
            padding: 10px 0;
            background: #0171d3 !important;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('logo1.png') }}" alt="" style="width:60px;"><br><img src="{{ asset('carr.webp') }}" alt="Garage Management" style="width:60px;" />Garage Management
            <!-- <p>Login to your account</p> -->
            <div class="form-link">
                <span style="mb-3" id="terms-box"><b>NEW USER?</b> <a href="{{ route('register') }}" class="link signup-link">Click here to Register Here</a></span>
                <br><span><b>Any Problem?</b> WhatsApp: 9958300122</span>
            </div>
        </div>


        <div class="login-body">
            <?php if (isset($_SESSION['msgf'])): ?>
                <div class="alert alert-error"><?php echo $_SESSION['msgf'];
                                                unset($_SESSION['msgf']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['msg'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['msg'];
                                                    unset($_SESSION['msg']); ?></div>
            <?php endif; ?>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="login_type" id="login_type" value="employee">

                <div class="form-group">
                    <input type="text" name="email" id="email" class="form-input" placeholder="Mobile No" required>
                    <small id="garageInfo" style="display:none; color:red; font-size:12px; margin-top:2px;"></small>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="form-group" id="password-group" style="display:none;">
                    <input type="password" name="password" id="password" class="form-input" placeholder="Password" required>
                    <i class='bx bx-hide password-toggle' id="passwordToggle"></i>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="form-group role-selector">
                    <label class="role-option">
                        <input type="radio" name="login_type" value="admin" checked>
                        <span>Owner</span>
                    </label>

                    <?php
                    // $gid = $_SESSION['id'];
                    // $company_permission = 0;
                    // if (!empty($gid)) {
                    //     $result = mysqli_query($conn, "SELECT permission_status_user_man FROM call_login WHERE g_id='$gid' LIMIT 1");
                    //     $company_permission = ($result && $row = mysqli_fetch_assoc($result)) ? $row['permission_status_user_man'] : 0;
                    // }
                    ?>
                    <?php
                    // if ($company_permission == 1):
                    ?>
                    <label class="role-option">
                        <input type="radio" name="login_type" value="employee">
                        <span>Staff</span>
                    </label>
                    <?php
                    //  endif; 
                    ?>
                </div>
                <div class="checkbox" id="terms-boxs">
                    <input type="checkbox" id="remember-me" checked>
                    <label for="agree"><a href="https://merigarage.com/terms.php"> I agree to the terms and conditions</a> | <a href="https://merigarage.com/privacypolicy.php">Privacy Policy</a></label>
                </div>
                <div class="form-link" id="terms-boxss">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>
                <br>
                <button type="submit" name="btn-sub" class="login-btn">Login</button>
            </form>

            <div class="form-link" style="margin-top: 20px;" id="terms-boxsss">
                <span>Don't have an account? <a href="{{ route('register') }}">Register</a></span>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} OTODIGITAL TECHNOLOGIES PVT LTD. All rights reserved.</p>
    </footer>

    <script>
        const loginInput = document.getElementById("email");
        const radioButtons = document.querySelectorAll('input[name="login_type"]');
        const passwordGroup = document.getElementById("password-group");
        const garageInfo = document.getElementById("garageInfo");

        const termsBox = document.getElementById('terms-box');
        const termsBoxs = document.getElementById('terms-boxs');
        const termsBoxss = document.getElementById('terms-boxss');
        const termsBoxsss = document.getElementById('terms-boxsss');

        // Always show password
        passwordGroup.style.display = "block";

        // Toggle password visibility
        document.getElementById("passwordToggle").addEventListener("click", function() {
            const p = document.getElementById("password");
            p.type = p.type === "password" ? "text" : "password";
            this.classList.toggle("bx-show");
            this.classList.toggle("bx-hide");
        });

        // Handle account type switching
        radioButtons.forEach(radio => {
            radio.addEventListener("change", function() {

                // Password ALWAYS visible
                passwordGroup.style.display = "block";

                if (this.value === "employee") {
                    loginInput.placeholder = "User Code / Email";

                    termsBox.style.display = "none";
                    termsBoxs.style.display = "none";
                    termsBoxss.style.display = "none";
                    termsBoxsss.style.display = "none";

                    garageInfo.style.display = "none";

                } else {
                    loginInput.placeholder = "Mobile No";

                    termsBox.style.display = "block";
                    termsBoxs.style.display = "block";
                    termsBoxss.style.display = "block";
                    termsBoxsss.style.display = "block";

                    garageInfo.style.display = "none";
                }
            });
        });

        // Staff Code AJAX check
        loginInput.addEventListener("keyup", function() {
            const selectedType = document.querySelector('input[name="login_type"]:checked');
            if (!selectedType || selectedType.value !== "employee") return;

            const code = loginInput.value.trim();
            if (code.length < 3) {
                garageInfo.style.display = "none";
                return;
            }

            fetch("check_staff_code.php?code=" + encodeURIComponent(code))
                .then(res => res.json())
                .then(data => {
                    if (data.status === "found") {
                        garageInfo.textContent = "Garage: " + data.garage_name;
                        garageInfo.style.color = "green";
                    } else {
                        garageInfo.textContent = "Invalid User Code";
                        garageInfo.style.color = "red";
                    }
                    garageInfo.style.display = "block";
                })
                .catch(() => {
                    garageInfo.textContent = "Error checking code";
                    garageInfo.style.color = "red";
                    garageInfo.style.display = "block";
                });

            // Keep password always visible
            passwordGroup.style.display = "block";
        });
    </script>

</body>

</html>