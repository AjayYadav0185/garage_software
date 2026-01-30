<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappidx - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .main-content {
            position: relative;
            z-index: 1;
            min-height: 100vh;
        }

        .left-section {
            position: relative;
            padding: 4rem 3rem;
            min-height: 100vh;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            font-family: 'Inter';
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);

            line-height: 1.1;
        }

        .welcome-subtitle {
            font-size: 16px;
            font-family: 'Inter';
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            /* margin-bottom: 3rem; */
            opacity: 0.95;
        }

        /* Base Feature Card Styles */
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 8px 15px;
            display: inline-flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: absolute;
            z-index: 2;
        }

        .feature-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-icon img {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        .feature-text {
            color: #1f2937;
            font-weight: 500;
            font-size: 14px;
            white-space: nowrap;
            letter-spacing: 0.3px;
        }

        /* Individual Card Positioning Classes */
        .rto-reduce-card {
            left: 6.7rem;
            top: 30%;
        }

        .buyer-communication-card {
            left: 5.7rem;
            top: 47%;
        }

        .real-time-tracking-card {
            left: 6.7rem;
            top: 68%;
        }

        .fast-cod-card {
            right: 4rem;
            top: 30%;
        }

        .dashboard-card {
            right: 4rem;
            top: 54%;
        }

        .login-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 1.5rem 1.5rem;
            margin: 1.2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .logo-image {
            height: 50px;
            width: auto;
            margin-bottom: 0.5rem;
        }

        .login-title {
            font-size: 36px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 16px;
        }

        .form-control {
            padding: 0.8rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #ffffff !important;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white !important;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: #374151;
        }

        .forgot-password {
            text-align: left;
            margin: 0.8rem 0 1.2rem 0;
        }

        .forgot-password a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.2s ease;
        }

        .forgot-password a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            background: #000;
            border: none;
            border-radius: 12px;
            padding: 0.8rem;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            margin-bottom: 0.8rem;
        }

        .login-btn:hover {
            background: #1f2937;
            transform: translateY(-1px);
        }

        .terms-text {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: center;
            margin: 0.8rem 0;
            line-height: 1.4;
        }

        .terms-text a {
            color: #3b82f6;
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        .signup-text {
            text-align: left;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .signup-text a {
            color: #3b82f6;
            text-decoration: underline;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .signup-text a:hover {
            color: #1d4ed8;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            75% {
                transform: translateX(5px);
            }
        }

        /* Responsive Design */
        @media (max-width: 1400px) {

            .fast-cod-card,
            .dashboard-card {
                right: 6rem;
            }

            .rto-reduce-card,
            .buyer-communication-card,
            .real-time-tracking-card {
                left: 2rem;
            }
        }

        @media (max-width: 1200px) {
            .welcome-title {
                font-size: 3rem;
            }

            .fast-cod-card,
            .dashboard-card {
                right: 4rem;
            }

            .rto-reduce-card,
            .buyer-communication-card,
            .real-time-tracking-card {
                left: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .welcome-title {
                font-size: 2.5rem;
            }

            .left-section {
                padding: 2rem;
            }

            /* Stack cards vertically on tablet/mobile */
            .rto-reduce-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }

            .buyer-communication-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }

            .real-time-tracking-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }

            .fast-cod-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }

            .dashboard-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
            }

            .login-section {
                margin: 1rem;
                padding: 1.5rem 1.2rem;
                max-height: 90vh;
            }

            .feature-card {
                padding: 6px 12px;
                border-radius: 8px;
            }

            .feature-text {
                font-size: 13px;
            }

            .feature-icon {
                width: 30px;
                height: 30px;
            }

            .feature-icon img {
                width: 24px;
                height: 24px;
            }
        }

        @media (max-width: 576px) {
            .left-section {
                padding: 1rem;
            }

            .welcome-title {
                font-size: 1.5rem;
            }

            .login-section {
                margin: 0.5rem;
                padding: 1.2rem 1rem;
                max-height: 95vh;
            }

            .logo-image {
                height: 40px;
            }

            .login-title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .feature-card {
                padding: 5px 10px;
            }

            .feature-text {
                font-size: 12px;
            }

            .feature-icon {
                width: 28px;
                height: 28px;
            }

            .feature-icon img {
                width: 22px;
                height: 22px;
            }
        }

        @media (max-width: 400px) {
            .welcome-title {
                font-size: 1.25rem;
            }

            .feature-text {
                font-size: 11px;
            }

            .feature-card {
                padding: 4px 8px;
            }
        }

        input.form-control,
        input.form-control:focus {
            background-color: white !important;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .custom-input {
            background-color: #fff !important;
            /* white background */
            border: none !important;
            /* remove border */
            box-shadow: none !important;
            /* remove shadow */
            outline: none !important;
            /* remove outline */
            color: #000;
            /* text color black */
        }


        .custom-input:focus {
            background-color: #fff !important;
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }
    </style>
</head>

<body>
    <!-- Background Image -->
    <div class="background-container">
        <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Group-41-1-scaled.webp" alt="Rappidx background"
            class="background-image">
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <!-- Left Section - Features and Branding -->
                <div class="col-lg-7 col-md-7">
                    <div class="left-section">
                        <!-- Header -->
                        <div>
                            <h1 class="welcome-title">WELCOME TO RAPPIDX</h1>
                            <p class="welcome-subtitle">Unlock growth at every stage of shipping</p>
                        </div>

                        <!-- Individual Feature Cards with Unique Classes -->

                        <!-- RTO Reduce Card -->
                        <div class="feature-card rto-reduce-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Curved-Arrow-Down.svg"
                                    alt="RTO Reduce">
                            </div>
                            <span class="feature-text">RTO REDUCE UPTO 50%</span>
                        </div>

                        <!-- Buyer Communication Card -->
                        <div class="feature-card buyer-communication-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Search-Client.svg"
                                    alt="Buyer Communication">
                            </div>
                            <span class="feature-text">Buyer Communication</span>
                        </div>

                        <!-- Real Time Tracking Card -->
                        <div class="feature-card real-time-tracking-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Tracking.svg"
                                    alt="Real Time Tracking">
                            </div>
                            <span class="feature-text">REAL TIME TRACKING</span>
                        </div>

                        <!-- Fast COD Remittance Card -->
                        <div class="feature-card fast-cod-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Lightning-Bolt.svg"
                                    alt="Fast COD Remittance">
                            </div>
                            <span class="feature-text">FAST COD REMITTANCE</span>
                        </div>

                        <!-- Multifunctional Dashboard Card -->
                        <div class="feature-card dashboard-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Analytics.svg"
                                    alt="Multifunctional Dashboard">
                            </div>
                            <span class="feature-text">MULTIFUNCTIONAL DASHBOARD</span>
                        </div>

                    </div>
                </div>

                <!-- Right Section - Login Form -->
                <div class="col-lg-5 col-md-5 d-flex align-items-center justify-content-center">
                    <div class="login-section">
                        <!-- Logo -->
                        <div class="logo-container">
                            <img src="https://web.rappidx.com/wp-content/uploads/2024/06/logo-removebg-preview-21.png"
                                alt="Rappidx Logo" class="logo-image">
                            <h2 class="login-title">Login</h2>
                        </div>

                        <!-- Login Form -->
                        <form id="loginForm" action="{{ route('user.logincheck') }}" method="POST">
                            @csrf

                            <!-- User ID -->
                            <div class="mb-3">
                                <label for="userId" class="form-label">User Id</label>
                                <input type="email" id="email" name="email" class="form-control custom-input"
                                    placeholder="name@email.com" required>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="password-container">
                                    <input type="password" name="password" id="password"
                                        class="form-control custom-input" placeholder="Password" required>
                                    <button type="button" class="password-toggle " id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Forgot Password -->
                            <div class="forgot-password">
                                <a href="{{ route('user.forgetpassword') }}" target="_blank">Forget Your Password ?
                                    Click here</a>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="login-btn">login</button>

                            <!-- Terms -->
                            <div class="terms-text">
                                By clicking on login, I accept the
                                <a href="https://rappidx.intileotech.com/terms-condition/">Terms & Conditions</a> &
                                <a href="https://rappidx.intileotech.com/privacy-policy/">Privacy Policy</a>
                            </div>

                            <!-- Signup -->
                            <div class="signup-text">
                                New to Rappidx?
                                <a href="{{ route('user.singup') }}" target="_blank">Signup</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Form validation and submission
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const userId = document.getElementById('userId').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!userId || !password) {
                // Shake animation for invalid input
                const form = document.getElementById('loginForm');
                form.classList.add('shake');
                setTimeout(() => {
                    form.classList.remove('shake');
                }, 500);

                alert('Please fill in all fields');
                return;
            }

            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(userId)) {
                alert('Please enter a valid email address');
                return;
            }

            // Simulate login process
            const button = document.querySelector('.login-btn');
            const originalText = button.textContent;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
            button.disabled = true;

            setTimeout(() => {
                alert('Login functionality would be implemented here');
                button.innerHTML = originalText;
                button.disabled = false;
            }, 2000);
        });

        // Animate feature cards on page load
        function animateFeatureCards() {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.6s ease';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150 + 300);
            });
        }

        // Smooth input focus effects
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function () {
                this.style.transform = 'scale(1)';
            });
        });

        // Individual card positioning functions
        function repositionRTOCard() {
            const card = document.querySelector('.rto-reduce-card');
            // Example: Move to a custom position
            // card.style.left = '5rem';
            // card.style.top = '35%';
        }

        function repositionBuyerCard() {
            const card = document.querySelector('.buyer-communication-card');
            // Example: Move to a custom position
            // card.style.left = '4rem';
            // card.style.top = '48%';
        }

        function repositionTrackingCard() {
            const card = document.querySelector('.real-time-tracking-card');
            // Example: Move to a custom position
            // card.style.left = '6rem';
            // card.style.top = '62%';
        }

        function repositionCODCard() {
            const card = document.querySelector('.fast-cod-card');
            // Example: Move to a custom position
            // card.style.right = '10rem';
            // card.style.top = '28%';
        }

        function repositionDashboardCard() {
            const card = document.querySelector('.dashboard-card');
            // Example: Move to a custom position
            // card.style.right = '9rem';
            // card.style.top = '42%';
        }

        // Handle responsive positioning
        function handleResponsiveCards() {
            const cards = document.querySelectorAll('.feature-card');

            if (window.innerWidth <= 992) {
                // Mobile/tablet: Convert to static positioning
                cards.forEach(card => {
                    card.style.position = 'static';
                    card.style.display = 'block';
                    card.style.margin = '1rem 0';
                });
            } else {
                // Desktop: Use absolute positioning
                cards.forEach(card => {
                    card.style.position = 'absolute';
                    card.style.display = 'inline-flex';
                    card.style.margin = '0';
                });
            }
        }

        // Initialize animations and responsive handling
        window.addEventListener('load', function () {
            setTimeout(animateFeatureCards, 200);
            handleResponsiveCards();
        });

        // Handle window resize
        window.addEventListener('resize', handleResponsiveCards);
    </script>

    <script>
        $(document).ready(function () {

            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize();
                console.log(formData);

                $.ajax({
                    url: "{{ route('user.logincheck') }}",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        if (response.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Credentials Verified!',
                                text: 'You have successfully logged into the system.',
                                timer: 3000,
                                showConfirmButton: false,
                                customClass: {
                                    popup: 'small-swal-popup',
                                    htmlContainer: 'custom-text-color',
                                    title: 'custom-title-color'
                                }
                            }).then(function () {
                                window.location.href = "{{ url('user/index') }}";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Login Credentials Not Verified!',
                                customClass: {
                                    popup: 'small-swal-popup',
                                    htmlContainer: 'custom-text-error-color',
                                    title: 'custom-title-error-color'
                                }
                            });
                        }
                    },
                    error: function (error) {
                        console.log("Error:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            customClass: {
                                popup: 'small-swal-popup',
                                htmlContainer: 'custom-text-error-color',
                                title: 'custom-title-error-color'
                            }
                        });
                    }
                });
            });


        });
    </script>
</body>

</html>