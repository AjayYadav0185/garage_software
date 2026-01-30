<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rappidx - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .map-22 {
            background-image: url('https://web.rappidx.com/wp-content/uploads/2025/09/Group-35.webp');
            background-repeat: no-repeat;
            background-size: cover;
            /* cover entire section */
            background-position: center center;
            /* keep image centered */
            width: 100%;
            min-height: 600px;
            /* base height */
        }

        /* Adjust height for smaller screens */
        @media (max-width: 768px) {
            .map-22 {
                min-height: 500px;
            }
        }

        @media (max-width: 468px) {
            .map-22 {
                min-height: 400px;
                background-size: cover;
                /* ensure full image visible on very small screens */
            }
        }

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
            position: absolute;
            inset: 0;
            z-index: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .background-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Main Content */
        .main-content {
            position: relative;
            min-height: 100vh;
            /* Allow content to grow */
            overflow: visible;
            z-index: 1;
            background-color: #00000000;
        }

        .left-section {
            position: relative;
            padding: 4rem 3rem;
            min-height: 100vh;
        }

        .main-content::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('https://web.rappidx.com/wp-content/uploads/2025/09/Group-42.webp');
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 1;
        }

        /* Content above background */
        .main-content .container-fluid {
            position: relative;
            z-index: 2;
            height: 100%;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);

            line-height: 1.1;
        }

        .welcome-subtitle {
            font-size: 16px;
            font-family: 'Inter', sans-serif;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            margin-bottom: 5rem;
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
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            letter-spacing: 0.3px;
        }

        /* Individual Card Positioning Classes */
        .rto-reduce-card {
            left: 6.7rem;
            top: 35%;
        }

        .buyer-communication-card {
            left: 5.7rem;
            top: 55%;
        }

        .real-time-tracking-card {
            left: 11rem;
            top: 73%;
        }



        .fast-cod-card {
            right: 7rem;
            top: 35%;
        }

        .dashboard-card {
            right: 7rem;
            top: 54%;
        }

        .automation-card {
            right: 9rem;
            top: 70%;
        }



        .login-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 1.5rem 1.5rem;
            margin: 1.2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            max-width: 520px;
            width: 100%;
            max-height: 100%;
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
            margin: 0 auto
        }

        .login-title {
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.55rem;
        }

        .form-control {
            padding: 0.8rem;
            border: 2px solid #ffffff;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .form-control:focus {
            border-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: white;
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
            text-align: right;
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
            font-size: 0.8rem;
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
            text-align: center;
            font-size: 0.8rem;
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

            .automation-card {
                position: static;
                display: block;
                margin: 1rem 0;
            }
        }

        @media (max-width: 1024px) {

            .rto-reduce-card,
            .feature-card {
                margin-top: 160px;
            }
        }

        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2rem;
            }

            .rto-reduce-card,
            .feature-card {
                margin-top: 1rem;
            }

            .welcome-subtitle {
                font-size: 1rem;
            }

            .login-section {
                margin: 1rem;
                padding: 1.5rem 1.2rem;
                max-height: 100%;
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
                max-height: 100%;
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
    <div class="background-container ">
        <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Group-42.webp" alt="Rappidx background"
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
                        <div class="ps-xxl-5 ps-sm-0">
                            <h1 class="welcome-title">EFFICIENT AND RELIABLE</h1>
                            <h1 class="welcome-title">SHIPPING WITH RAPPIDX</h1>
                            <p class="welcome-subtitle">Transforming Delivery into a Growth Engine for Your<br>
                                e-Commerce Business</p>
                        </div>

                        <!-- Individual Feature Cards with Unique Classes -->

                        <!-- RTO Reduce Card -->
                        <div class="feature-card rto-reduce-card mt-4">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2024/06/Curved-Arrow-Down.svg"
                                    alt="RTO Reduce">
                            </div>
                            <span class="feature-text">RTO REDUCE UPTO 50%</span>
                        </div>

                        <!-- Buyer Communication Card -->
                        <div class="feature-card buyer-communication-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/WhatsApp.svg"
                                    alt="Buyer Communication">
                            </div>
                            <span class="feature-text">TWO WAY WHATSAPP<br> COMMUNICATION</span>
                        </div>

                        <!-- Real Time Tracking Card -->
                        <div class="feature-card real-time-tracking-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Omnichannel.svg"
                                    alt="Real Time Tracking">
                            </div>
                            <span class="feature-text">MULTI-CHANNEL<br> PLUGINS</span>
                        </div>

                        <!-- Fast COD Remittance Card -->
                        <div class="feature-card fast-cod-card mt-4">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Analytics.svg"
                                    alt="Fast COD Remittance">
                            </div>
                            <span class="feature-text">AI-POWERED COURIER<br> SELECTION
                            </span>
                        </div>

                        <!-- Multifunctional Dashboard Card -->
                        <div class="feature-card dashboard-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Task-Completed.svg"
                                    alt="Multifunctional Dashboard">
                            </div>
                            <span class="feature-text">COD ORDER<br> CONFIRMATION</span>
                        </div>

                        <div class="feature-card automation-card">
                            <div class="feature-icon">
                                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Hub.svg" alt="Automation">
                            </div>
                            <span class="feature-text">MULTIFUNCTIONAL<br>
                                DASHBOARD</span>
                        </div>

                    </div>
                </div>

                <!-- Right Section - Login Form -->
                <div class="col-lg-5 col-md-5 d-flex align-items-center justify-content-center">
                    <div class="login-section">
                        <!-- Logo -->
                        <div class="logo-container items-center justify-center">
                            <img src="https://web.rappidx.com/wp-content/uploads/2024/06/logo-removebg-preview-21.png"
                                alt="Rappidx Logo" class="logo-image">
                            <h2 class="login-title">Let’s Optimize Your Shipping Goals</h2>
                        </div>

                        {{-- Validation Error --}}
                        @if ($errors->any())
                            <div class="auto-hide bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        {{-- Session Error --}}
                        @if (session()->has('error'))
                            <div class="auto-hide bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-2">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Session Success --}}
                        @if (session()->has('success'))
                            <div
                                class="auto-hide bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-2">
                                {{ session('success') }}
                            </div>
                        @endif
                        <!-- Signup Form -->

                        <form class="max-w-4xl mx-auto p-4  rounded-xl " action="{{ url('singupsave') }}"
                            method="POST">
                            @csrf

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control custom-input" name="name" placeholder="First Name"
                                        required>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control custom-input" name="last_name" placeholder="Last Name"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- City -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control custom-input" name="city" placeholder="City"
                                        required>
                                </div>

                                <!-- State -->
                                <div class="col-md-6 mb-3">
                                    <select name="state" class="form-control custom-input" required>
                                        <option value="">Select State</option>
                                        @foreach ($state as $item)
                                            <option value="{{ $item->id }}">{{ $item->state }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Company -->
                            <div class="mb-3">
                                <input type="text" name="companystorename" class="form-control custom-input" placeholder="Company"
                                    required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <input type="text" name="email" class="form-control custom-input" placeholder="Email Id"
                                    required>
                            </div>

                            <div class="row">
                                <!-- Mobile No -->
                                <div class="col-md-6 mb-3">
                                    <input type="text" name="mobile" class="form-control custom-input" 
                                        placeholder="Mobile No." required>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <input type="password" name="password" id="password" class="form-control custom-input"
                                        placeholder="Password" required>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Monthly Shipment -->
                                <div class="col-md-6 mb-3">
                                    <select class="form-control custom-input" name="monthly_shipment" required>
                                        <option selected disabled>Select Seller Type</option>
                                        <option>Domestic Shipping</option>
                                        <option>B2B Cargo</option>
                                        <option>International Shipping</option>
                                        <option>Hyperlocal ( Quick Delivery )</option>
                                        <option>Franchise</option>
                                    </select>
                                </div>

                                <!-- Seller Type -->
                                <div class="col-md-6 mb-3">
                                    <select class="form-control custom-input" name="sellertype" required>
                                        <option selected disabled>Select Seller Type</option>
                                        <option>Domestic Shipping</option>
                                        <option>B2B Cargo</option>
                                        <option>International Shipping</option>
                                        <option>Hyperlocal ( Quick Delivery )</option>
                                        <option>Franchise</option>
                                    </select>
                                </div>

                                <!-- Hidden User Type -->
                                <input type="hidden" name="usertype" value="client" />
                            </div>

                            <!-- Terms -->
                            <div class="terms-text text-center mb-3">
                                By signing up, you agree to Rappidx
                                <a target="_blank" href="https://rappidx.intileotech.com/terms-condition/">Terms of
                                    Service</a> &
                                <a target="_blank" href="https://rappidx.intileotech.com/privacy-policy/">Privacy
                                    Policy</a>
                            </div>

                            <!-- Signup Button -->
                            <button type="submit" class="login-btn w-100">Sign Up</button>

                            <!-- Already have account -->
                            <div class="signup-text text-center mt-3">
                                Already have an account? <a href="{{ route('user.login') }}"
                                    target="_blank">Login</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <h2 class="max-w-7xl mx-auto text-center p-4 text-2xl sm:text-4xl md:text-[48px] font-bold mt-4">Getting Started Is
        Easy
    </h2>
    <p class="items-center justify-center text-center text-sm font-[400]">place your order, we handle the pickup and
        delivery, and you track your<br> shipment every step of the way.</p>
    <div class="flex flex-wrap justify-center gap-6 sm:gap-10 lg:gap-14 p-6 md:p-8">
        <!-- Card 1 -->
        <div
            class="w-36 h-36 sm:w-44 sm:h-44 md:w-48 md:h-48 bg-white rounded-tl-[60%] rounded-tr-[20%] rounded-b-lg shadow-md flex flex-col items-center justify-center text-center p-4">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/image-removebg-preview-49-1.png"
                alt="Sign up" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mb-3">
            <p class="text-xs sm:text-sm md:text-base font-medium">Sign up free</p>
        </div>

        <!-- Card 2 -->
        <div
            class="w-36 h-36 sm:w-44 sm:h-44 md:w-48 md:h-48 bg-white rounded-t-[60%] rounded-b-lg shadow-md flex flex-col items-center justify-center text-center p-4">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/image-removebg-preview-50-1.png"
                alt="KYC" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mb-3">
            <p class="text-xs sm:text-sm md:text-base font-medium">Complete KYC</p>
        </div>

        <!-- Card 3 -->
        <div
            class="w-36 h-36 sm:w-44 sm:h-44 md:w-48 md:h-48 bg-white rounded-t-[60%] rounded-b-lg shadow-md flex flex-col items-center justify-center text-center p-4">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/image-removebg-preview-52-1.png"
                alt="Wallet" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mb-3">
            <p class="text-xs sm:text-sm md:text-base font-medium">Recharge Wallet</p>
        </div>

        <!-- Card 4 -->
        <div
            class="w-36 h-36 sm:w-44 sm:h-44 md:w-48 md:h-48 bg-white rounded-tr-[60%] rounded-tl-[20%] rounded-b-lg shadow-md flex flex-col items-center justify-center text-center p-4">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/image-removebg-preview-53-1.png"
                alt="Shopping" class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mb-3">
            <p class="text-xs sm:text-sm md:text-base font-medium">Start Shopping</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto p-6  mt-20">
        <!-- Label -->
        <div class="flex items-center gap-2 mb-2">
            <span class="w-4 h-4 bg-gray-300 rounded-sm"></span>
            <span class="text-gray-600  font-medium text-[20px]">Integrations</span>
        </div>

        <!-- Heading -->
        <h2 class="text-2xl sm:text-3xl md:text-[48px] font-bold leading-snug mb-8">
            Courier and plugins made simple,

        </h2>
        <h2 class="text-2xl sm:text-3xl md:text-[48px] font-bold leading-snug mb-8">
            trusted by businesses.

        </h2>

        <!-- Logos Row 1 -->
        <div
            class="bg-white border border-black rounded-2xl shadow-sm flex flex-wrap justify-center gap-6 sm:gap-10 px-6 sm:px-10 py-6 sm:py-8 mb-6">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/center-01.svg"
                class="h-8 sm:h-10 object-contain" alt="Amazon">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/xpre-01.svg"
                class="h-8 sm:h-10 object-contain" alt="Xpressbees">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/pngegg-1-1.svg"
                class="h-8 sm:h-10 object-contain" alt="Shopify">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/e-kar-01.svg"
                class="h-8 sm:h-10 object-contain" alt="eKart">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/logo-10-01.svg"
                class="h-8 sm:h-10 object-contain" alt="Delhivery">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/4-bl-01.svg"
                class="h-8 sm:h-10 object-contain" alt="Bluedart">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/1297058_commerce_e-commerce_online-store_store_woo_icon-1.svg"
                class="h-8 sm:h-10 object-contain" alt="Woo">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/india-post-01.svg"
                class="h-8 sm:h-10 object-contain" alt="India Post">
        </div>

        <!-- Logos Row 2 -->
        <div
            class="bg-white border border-black rounded-2xl shadow-sm flex flex-wrap justify-center gap-8 sm:gap-12 lg:gap-14 px-6 sm:px-10 py-6">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/fedd-01-1-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="FedEx">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/CITYPNG.COMHD-Aramex-Delivery-Unlimited-Company-Logo-PNG-2000x2000-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="Aramex">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/dhl-01-1-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="DHL">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/cen-01-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="Movin">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/upss-01-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="UPS">
            <img src="https://web.rappidx.com/wp-content/uploads/2025/09/gati-logo-01-1.svg"
                class="h-12 sm:h-14 md:h-16 object-contain" alt="AllCargo">
        </div>

    </div>



    <div class="max-w-7xl mx-auto mt-20 ">
        <!-- Label -->

        <!-- Heading -->
        <h2 class="text-2xl sm:text-3xl md:text-[48px] font-bold leading-snug mb-4 pl-4">
            Simplifying Shipping.

        </h2>
        <h2 class="text-2xl sm:text-3xl md:text-[48px] font-bold leading-snug pl-4 ">
            Maximizing your Business Growth.
        </h2>
    </div>
    <section class="max-w-7xl mx-auto map-22 ">
        <div
            class="max-w-5xl mx-auto relative rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between">

            <!-- Content -->
            <div class="relative grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-10 z-10 mt-20">

                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Map.svg" class="h-8 mb-3"
                        alt="Pincode">
                    <p class="text-[13px] font-medium">29000 Pincode<br>Pan India</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Rupee.svg" class="h-8 mb-3"
                        alt="Rate">
                    <p class="text-[13px] font-medium">Affordable<br>Rate</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Box-Secured.svg" class="h-8 mb-3"
                        alt="Secure">
                    <p class="text-[13px] font-medium">Secure and Damage<br>Free Shipping</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Worldwide-Location.svg"
                        class="h-8 mb-3" alt="Pickup">
                    <p class="text-[13px] font-medium">Multi Pickup<br>Location</p>
                </div>

                <!-- Card 5 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Resume-Website.svg" class="h-8 mb-3"
                        alt="Tracking">
                    <p class="text-[13px] font-medium">Branded<br>Tracking Page</p>
                </div>

                <!-- Card 6 -->
                <div class="bg-white rounded-xl shadow-md p-2 lg:p-4 flex flex-col items-center text-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Online-Support.svg" class="h-8 mb-3"
                        alt="Support">
                    <p class="text-[13px] font-medium">Best in class<br>Customer Support</p>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative mt-10 md:mt-0 md:ml-10 z-10"></div>
        </div>
    </section>



    <section class="bg-black py-12 mt-10">
        <div class="max-w-7xl mx-auto mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 ">

            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Holding-Box.svg" alt="Domestic Shipping"
                    class="w-14 h-14 mb-4">
                <p class="font-medium">Domestic <br> Shipping</p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Truck-Weight-Max-Loading.svg"
                    alt="B2B Cargo" class="w-14 h-14 mb-4">
                <p class="font-medium">B2B <br> Cargo</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Local-Delivery.svg" alt="Quick Delivery"
                    class="w-14 h-14 mb-4">
                <p class="font-medium">Quick <br> Delivery</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Around-the-Globe.svg"
                    alt="International Ship" class="w-14 h-14 mb-4">
                <p class="font-medium">International <br> Ship</p>
            </div>

        </div>
    </section>




    <section class="bg-black rounded-[36px] p-6 md:p-12 max-w-7xl mx-auto mt-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

            <!-- Card 1 -->
            <article
                class="bg-white rounded-[28px] p-6 md:p-8 flex flex-col items-center text-center
               shadow-[0_10px_30px_rgba(0,0,0,0.45)] min-h-[520px]">
                <!-- Image area (large) -->
                <div class="-mt-8 w-full flex justify-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/rapp-01-1-2.webp"
                        alt="Auto Order Validation" class="w-[200px] md:w-[330px] object-contain" />
                </div>

                <!-- Title / description -->
                <h3 class="mt-6 text-base md:text-xl font-semibold">Auto Order Validation</h3>
                <p class="mt-3 text-gray-600 text-sm md:text-base leading-relaxed max-w-[340px] px-2">
                    Seamlessly verify orders from buyers for assured business growth
                </p>
            </article>

            <!-- Card 2 -->
            <article
                class="bg-white rounded-[28px] p-6 md:p-8 flex flex-col items-center text-center
               shadow-[0_10px_30px_rgba(0,0,0,0.45)] min-h-[520px]">
                <div class="-mt-8 w-full flex justify-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/raap-01-1-1.webp"
                        alt="Customer Engagement" class="w-[200px] md:w-[330px] object-contain" />
                </div>

                <h3 class="mt-6 text-base md:text-xl font-semibold">Customer Engagement <br
                        class="hidden md:inline" />Order Status</h3>
                <p class="mt-3 text-gray-600 text-sm md:text-base leading-relaxed max-w-[340px] px-2">
                    Enhance customer engagement and elevate your business communication with advanced multi-level tools
                </p>
            </article>

            <!-- Card 3 -->
            <article
                class="bg-white rounded-[28px] p-6 md:p-8 flex flex-col items-center text-center
               shadow-[0_10px_30px_rgba(0,0,0,0.45)] min-h-[520px]">
                <div class="-mt-8 w-full flex justify-center">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/d1abd11f-2b53-4ef6-82c2-0b5532c5cf5c-1-1.webp"
                        alt="Real Time Tracking" class="w-[200px] md:w-[220px] object-contain" />
                </div>

                <h3 class="mt-6 text-base md:text-xl font-semibold">Real Time Tracking</h3>
                <p class="mt-3 text-gray-600 text-sm md:text-base leading-relaxed max-w-[340px] px-2">
                    Track your orders live with real-time updates for seamless delivery management and happier customers
                </p>
            </article>

        </div>
    </section>



    <section class="bg-black py-12 mt-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 ">

            <!-- Card 1 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Staff.svg" alt="Domestic Shipping"
                    class="w-14 h-14 mb-4">
                <p class="font-medium">Effortless NDR<br>
                    Management </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Industrial-Scales.svg" alt="B2B Cargo"
                    class="w-14 h-14 mb-4">
                <p class="font-medium">Weight <br>
                    Management</p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Centralized-Network.svg"
                    alt="Quick Delivery" class="w-14 h-14 mb-4">
                <p class="font-medium">Multi Channel <br>
                    Plugins</p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl shadow-md flex flex-col items-center justify-center p-6 text-center">
                <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Control-Panel.svg"
                    alt="International Ship" class="w-14 h-14 mb-4">
                <p class="font-medium">Multi function <br>
                    Dashboard </p>
            </div>

        </div>
    </section>






    <section class="bg-black rounded-[36px] p-6 md:p-12 max-w-7xl mx-auto mt-10">
        <div class="flex items-center justify-center p-4">
            <div class="bg-black text-white rounded-full w-full max-w-4xl p-8 text-center shadow-lg">
                <!-- Text -->
                <h2 class="text-lg md:text-xl font-semibold mb-4">
                    Delight Every Shipment-Ship with Rappidx
                </h2>

                <!-- Button -->
                <a href="#"
                    class="bg-white text-black px-5 py-2 rounded-md text-sm font-semibold hover:bg-gray-100 transition inline-block">
                    Signup For Free
                </a>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
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
        document.getElementById('loginForm').addEventListener('submit', function(e) {
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
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
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
        window.addEventListener('load', function() {
            setTimeout(animateFeatureCards, 200);
            handleResponsiveCards();
        });

        // Handle window resize
        window.addEventListener('resize', handleResponsiveCards);
    </script>
</body>

</html>
