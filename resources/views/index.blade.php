<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ translate('Rappidx - Track Your Order') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">


    <style>
        .container {
            background: #ffffff;
            color: black;
            border-radius: 10px;
        }

        #orderProgressBar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            margin: 30px 0;
            overflow-x: auto;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }

        /* Date & Time above */
        .date-label,
        .time-label {
            font-size: 10px;
            color: #555;
            text-align: center;
        }

        /* Circle */
        .progress-circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: blue;
            /* default color */
            z-index: 1;
            margin: 2px;
        }

        /* Active circle */
        .progress-circle.active {
            background-color: blue;
        }

        /* Status below */
        .status-label {
            margin-top: 5px;
            font-size: 12px;
            text-align: center;
        }

        /* Connector line container */
        .progress-step::before {
            content: '';
            position: absolute;
            top: 50%;
            left: -50%;
            width: 100%;
            height: 2px;
            background-color: blue;
            z-index: 0;
        }

        /* Remove line before first step */
        .progress-step:first-child::before {
            content: none;
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #000000;
            color: white;
            min-height: 100vh;
        }

        .main-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .hero-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5rem;
            gap: 3rem;
        }

        .hero-content {
            flex: 1;
            max-width: 500px;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fbbf24, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1.5rem;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .hero-description {
            font-size: 1rem;
            color: #a0a0a0;
            line-height: 1.5;
        }

        .tracking-form {
            flex: 1;
            max-width: 590px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tab-buttons {
            display: flex;
            background: #f1f5f9;
            border-radius: 16px;
            padding: 6px;
            margin-bottom: 2rem;
        }

        .tab-button {

            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab-button.active {
            background: #000000;
            color: white;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);
        }

        .tab-button.inactive {
            background: transparent;
            color: #64748b;
        }

        .tab-button.inactive:hover {
            background: #e2e8f0;
            color: #475569;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            font-size: 1rem;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            background: white;
            box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .track-button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 16px rgba(251, 191, 36, 0.3);
        }

        .see-more-button {

            justify-content: flex-end;
            width: auto;
            padding: 16px;
            background: #1e293b;
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 500;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .track-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.4);
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .track-button:active {
            transform: translateY(0);
        }

        .help-text {
            font-size: 0.9rem;
            color: #64748b;
            text-align: center;
            line-height: 1.5;
        }

        .help-link {
            color: #f59e0b;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .help-link:hover {
            color: #d97706;
            text-decoration: underline;
        }

        .tracking-steps {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 5rem;
            flex-wrap: wrap;
        }

        .step-card {
            background: white;
            border-radius: 20px;
            padding: 1rem 0.8rem;
            text-align: center;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-5px);
        }

        .step-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .step-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        .step-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .step-description {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.4;
        }

        .faq-section {
            margin-top: 4rem;
        }

        .faq-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 2rem;
        }

        .faq-container {
            background: white;
            /* border-radius: 20px; */
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .faq-item {
            border-bottom: 1px solid #eee;
        }

        .faq-item:last-child {
            border-bottom: none;
        }

        .faq-question {
            padding: 1.5rem 2rem;
            background: white;
            border: none;
            width: 100%;
            text-align: left;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.2s ease;
        }

        .faq-question:hover {
            background: #f8f9fa;
        }

        .faq-icon {
            font-size: 1.2rem;
            color: #666;
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            background: #f8f9fa;
        }

        .faq-answer.show {
            max-height: 200px;
        }

        .faq-answer-content {
            padding: 1.5rem 2rem;
            color: #666;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .hero-section {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .tracking-steps {
                flex-direction: column;
                gap: 1.5rem;
            }

            .step-card {
                min-width: auto;
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 2rem 1rem;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1.2rem;
            }

            .tracking-form {
                padding: 2rem;
            }

            .step-card {
                padding: 1.5rem 1rem;
            }

            .step-icon {
                width: 60px;
                height: 60px;
            }

            .step-icon img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 15px;
            }

            .faq-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .tab-button {
                padding: 12px 18px;
                font-size: 0.85rem;
            }

            .tracking-form {
                padding: 1.5rem;
            }

            .faq-question,
            .faq-answer-content {
                padding: 1rem 1.5rem;
            }
        }
    </style>
    <style>
        .tab-buttons {
            display: flex;
            background: #f1f5f900;
            border-radius: 16px;
            padding: 6px;
            margin-bottom: 2rem;
        }

        .tab-button {
            width: 45%;
            color: #0900FF;

            padding: 14px 24px;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            background: #f0f8ff00;
        }

        .tab-button.active {
            background: #000000;
            color: white;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0);
        }

        .tab-button.inactive {
            background: transparent;
            color: #0900FF;
        }

        .tab-button.inactive:hover {
            background: #e2e8f0;
            color: #475569;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e2e8f052;
            border-radius: 16px;
            font-size: 1rem;

            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.003);
            transition: all 0.3s ease;
            font-weight: 500;
            color: #8D8383;
        }

        .form-input:focus {
            outline: none;
            border-color: #fbbf24;
            background: white;
            box-shadow: 0 0 0 4px rgba(251, 191, 36, 0.1);
            transform: translateY(-1px);
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        .track-button {
            justify-content: flex-end;
            width: 45%;
            padding: 16px;
            background: #000000;
            color: white;
            border: none;
            border-radius: 16px;
            font-weight: 500;
            font-size: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;

        }

        .track-button:hover {
            transform: translateY(-2px);

            background: black;
        }

        .track-button:active {
            transform: translateY(0);
        }

        .help-text {
            font-size: 0.9rem;
            color: #64748b;
            text-align: center;
            line-height: 1.5;
        }

        .help-link {
            color: #0900FF;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .help-link:hover {
            color: #0903c1;
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }
    </style>

</head>

<body>
    <div class="main-container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h1 class="hero-title">{{ translate('Track Your Order') }}</h1>
                <h2 class="hero-subtitle">{{ translate('Easily monitor your shipments status in real time.') }}</h2>
                <p class="hero-description">
                   {{ translate(' Enter your AWB or Order ID to get instant updates on your shipment from dispatch to delivery.') }}
                </p>
            </div>

            <div class="tracking-form">
                <div class="tab-buttons">
                    <button class="tab-button active" id="awbTab">{{ translate('AWB NO') }}.</button>
                    <button class="tab-button inactive" id="orderTab">{{ translate('Order ID') }}</button>
                </div>
                <form action="" method="POST" id="trackorder">
                    @csrf
                    <!-- AWB Input -->
                    <div class="form-group" id="awbGroup">
                        <input type="text" class="form-input" name="awb_number" id="awb-no"
                            placeholder="Enter AWB NO.">
                    </div>

                    <!-- Order ID Input -->
                    <div class="form-group hidden" id="orderGroup">
                        <input type="text" class="form-input" name="order_id" id="order_id"
                            placeholder="Enter Order ID">
                    </div>



                    <div style="display: flex; justify-content: flex-end; width: 100%;">
                        <button type="submit" class="track-button">{{ translate('Track') }}</button>
                    </div>


                    <p class="help-text">
                        {{ translate('See the tracking id on shipping document.') }} <a href="#" class="help-link">{{ translate('Help') }}</a>
                    </p>
                </form>
            </div>
        </div>

        <br><br>
        <div id="noRecordMessage" style="display:none; text-align:center; font-size: 1.5rem; color: #ffffff; font-weight: 600;">{{ translate('No record found') }}</div>
        <br><br>
        <div class="container" id="orderpage" style="padding: 35px; display: none; margin-bottom: 10rem;">
            <div class="order-card">
                <div class="container py-3">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center">
                                <div class="me-6">
                                    <h5 class="mb-0 ordernumber" id=""></h5>
                                    <small class="text-muted">{{ translate('Courier Partner') }} - <span id="couriername">
                                        </span></small>
                                </div>
                                <div class="vr mx-3 d-none d-md-block"></div>
                                <div>
                                    {{-- <p class="mb-0"> <i class="fa fa-chevron-right"
                                                style="font-size:10px;"></i>
                                        </p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-center me-3">
                                    <p class="mb-0 small">{{ translate('From') }} <br><strong id="fromaddress"></strong></p>
                                </div>
                                <div class="me-3">
                                    <span class="badge bg-warning text-dark px-3 py-2"></span>
                                </div>
                                <div class="flex-grow-1 me-3">
                                    <div class="progress bg-light" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 75%;" role="progressbar"
                                            aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="text-center me-3">
                                    <p class="mb-0 small">{{ translate('To') }} <br><strong id="toaddress"></strong></p>
                                </div>
                                <div style="margin-top: -30px;">
                                    <form action="" method="POST">
                                        @csrf
                                        <input type="hidden" name="awb_input" id="awb_input" value="">
                                        <button type="button" class="see-more-button update" style="display: none;">
                                           {{ translate(' See more details') }}
                                        </button>
                                        <button type="button"
                                            class="see-more-button update1
                                                style="display:
                                            none;">
                                            {{ translate('See more details') }}
                                        </button>

                                    </form>
                                    <div class="text-center me-3" hidden>
                                        <p class="mb-0 small">{{ translate('EDD Date ') }}<br><strong id="eddDate"></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                {{-- <div class="col-1">
                        <p>Products</p>
                    </div>
                    <div class="col-1">
                        <span id="productname"></span>
                        {{currency_symbol()}}<span id="itemprice"></span>
                    </div>
                    <div class="col-1">
                    </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="horizontal-progress mt-4" id="orderProgressBar"></div>
                    </div>
                </div>
                {{-- <div class="horizontal-timeline-wrapper mt-4">
                        <div class="horizontal-timeline" id="orderProgressBar"></div>
                    </div> --}}
                <hr>
                <div class="row">
                    <div class="col-8">
                        <h3 style="font-size: 14px; color: black;">
                           {{ translate(' Current Status') }} :
                            &nbsp; <b> <span id="currentStatus" class=""></span></b>
                        </h3>
                    </div>
                    <div class="col-4">
                        <div class="action-buttons d-flex justify-content-end mt-3 gap-3">
                            {{-- <a href="" id="websitelink" class="text-primary icon-link">
                                <i class="bi bi-globe"></i> Website
                                </a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tracking Steps -->
        <div class="tracking-steps">
            <div class="step-card">
                <div class="step-icon">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Product-1.webp" alt="Order assign">
                </div>
                <h3 class="step-title">{{ translate('Order assign') }}</h3>
                <p class="step-description">{{ translate('Assign orders efficiently to ensure timely delivery and customer
                    satisfaction') }}</p>
            </div>

            <div class="step-card">
                <div class="step-icon">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Supplier-2.webp" alt="Order pick">
                </div>
                <h3 class="step-title">{{ translate('Order pick') }}</h3>
                <p class="step-description">{{ translate('Schedule order pickup promptly for faster processing and delivery') }}</p>
            </div>

            <div class="step-card">
                <div class="step-icon">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/In-Transit.webp" alt="Intransit">
                </div>
                <h3 class="step-title">{{ translate('Intransit') }}</h3>
                <p class="step-description">{{ translate('Order is in transit and on its way to the destination') }}.</p>
            </div>

            <div class="step-card">
                <div class="step-icon">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Track-Order.webp"
                        alt="Out for delivery">
                </div>
                <h3 class="step-title">{{ translate('Out for delivery') }}</h3>
                <p class="step-description">{{ translate('Order is out for delivery and will reach you soon.') }}</p>
            </div>

            <div class="step-card">
                <div class="step-icon">
                    <img src="https://web.rappidx.com/wp-content/uploads/2025/09/Box.webp" alt="Delivered">
                </div>
                <h3 class="step-title">{{ translate('Delivered') }}</h3>
                <p class="step-description">{{ translate('Order has been delivered successfully') }}.</p>
            </div>
        </div>



        <!-- FAQ Section -->
        <div class="faq-section">
            <h2 class="faq-title">{{ translate('FAQs') }}</h2>
            <div class="faq-container">
                <div class="faq-item">
                    <button class="faq-question">
                      {{ translate('  Why is my tracking status not updating?') }}
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                          {{ translate('  Tracking updates can sometimes be delayed due to various factors such as network issues,
                            scanning delays at transit points, or system maintenance. If your tracking hasnt updated
                            for more than 24 hours, please contact our customer support team for assistance.') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                       {{ translate(' What should I do if my package is delayed?') }}
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ translate('Package delays can occur due to weather conditions, high shipment volumes, or other
                            unforeseen circumstances. We recommend waiting 1-2 additional business days. If the delay
                            persists, please reach out to our support team with your tracking number for immediate
                            assistance.') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                      {{ translate('  Can I change the delivery address after dispatch?') }}
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            {{ translate('Address changes after dispatch are possible but depend on the current location of your
                            package. Please contact our customer service immediately with your tracking number. Well do
                            our best to accommodate the change, though additional charges may apply.') }}
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                       {{ translate(' What happens if Im not available during delivery?') }}
                        <i class="fas fa-chevron-down faq-icon"></i>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                      {{ translate('      If you re not available during delivery, our delivery partner will attempt to contact you
                            and may leave the package with a trusted neighbor or at a secure location. If delivery
                            cannot be completed, the package will be held at the nearest facility and youll receive
                            instructions for pickup or rescheduling delivery.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const awbTab = document.getElementById("awbTab");
        const orderTab = document.getElementById("orderTab");
        const awbGroup = document.getElementById("awbGroup");
        const orderGroup = document.getElementById("orderGroup");
        const form = document.getElementById("trackingForm");

        // Switch tab
        awbTab.addEventListener("click", () => {
            awbTab.classList.add("active");
            orderTab.classList.remove("active");
            awbGroup.classList.remove("hidden");
            orderGroup.classList.add("hidden");
        });

        orderTab.addEventListener("click", () => {
            orderTab.classList.add("active");
            awbTab.classList.remove("active");
            orderGroup.classList.remove("hidden");
            awbGroup.classList.add("hidden");
        });

        // Form submit
        form.addEventListener("submit", function(e) {
            e.preventDefault();
            let activeTab = awbTab.classList.contains("active") ? "AWB" : "ORDER";
            let value = activeTab === "AWB" ? awbInput.value.trim() : orderInput.value.trim();

            if (value) {
                alert(`Tracking ${activeTab}: ${value}`);
                // ðŸ‘‰ Replace alert with API call
            } else {
                alert("Please enter a valid " + activeTab + " number.");
            }
        });

    </script>
    <script>
        // FAQ accordion functionality
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const faqItem = this.parentElement;
                const faqAnswer = faqItem.querySelector('.faq-answer');
                const isActive = faqItem.classList.contains('active');

                // Close all other FAQ items
                faqQuestions.forEach(otherQuestion => {
                    const otherItem = otherQuestion.parentElement;
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    otherItem.classList.remove('active');
                    otherAnswer.classList.remove('show');
                });

                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                    faqAnswer.classList.add('show');
                }
            });
        });

        // Smooth animations on scroll
        function animateOnScroll() {
            const stepCards = document.querySelectorAll('.step-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            stepCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
                observer.observe(card);
            });
        }

        // Input focus effects
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Initialize animations
        window.addEventListener('load', function() {
            animateOnScroll();
        });
    </script>
    <!-- Modal -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- NiceScroll Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>

    <!-- Your app.js -->
    <script src="path/to/app.min.js"></script>



    <script>
        $(document).ready(function() {
            $('#websitelink').on('click', function(e) {
                const href = $(this).attr('href');
                if (!href || href === 'null' || href === 'undefined' || href.trim() === '') {
                    e.preventDefault(); // prevent default link click

                    // Show SweetAlert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Website is not available',
                        // text: 'Website  is not available at the moment.',
                        confirmButtonColor: '#514C7F'
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Switch tabs between AWB and Order ID
            $('#awbTab').on('click', function() {
                // Activate AWB tab and deactivate Order ID tab
                $('#awbTab').addClass('active').removeClass('inactive');
                $('#orderTab').addClass('inactive').removeClass('active');

                // Show AWB input, hide Order ID input
                $('#awbGroup').removeClass('hidden');
                $('#orderGroup').addClass('hidden');
            });

            $('#orderTab').on('click', function() {
                // Activate Order ID tab and deactivate AWB tab
                $('#orderTab').addClass('active').removeClass('inactive');
                $('#awbTab').addClass('inactive').removeClass('active');

                // Show Order ID input, hide AWB input
                $('#orderGroup').removeClass('hidden');
                $('#awbGroup').addClass('hidden');
            });

            // Form submission handler
            $('#trackorder').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                var activeTab = $('.tab-button.active').attr(
                    'id'); // Get active tab id (either awbTab or orderTab)
                var inputVal = $('#' + (activeTab === 'awbTab' ? 'awb-no' : 'order_id')).val()
                    .trim(); // Get input value

                // Validate input field based on the active tab
                if (inputVal === '') {
                    alert('Please enter your ' + (activeTab === 'awbTab' ? 'AWB No.' : 'Order ID') +
                        ' to track your order.');
                    return false;
                }

                var formData = $(this).serialize();

                // AJAX request to get the tracking details
                $.ajax({
                    url: "{{ route('summary') }}", // Adjust this if your route is different
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // CSRF token for security
                    },
                    success: function(response) {
                        if (!response.singleproquery || Object.keys(response.singleproquery)
                            .length === 0) {
                            $('#orderpage').hide();
                            $('#noRecordMessage').text('No record found').show();
                        } else {
                            $('#orderpage').show();
                            $('#noRecordMessage').hide();

                            // ✅ Set hidden awb_input value from response
                            $('#awb_input').val(response.singleproquery.Awb_Number);

                            // ✅ Show correct button based on awb_gen_by value
                            let awbGenBy = response.singleproquery.awb_gen_by;
                            if (['1', '2', '3', '4'].includes(awbGenBy)) {
                                $('.update1').show();
                                $('.update').hide();
                            } else {
                                $('.update').show();
                                $('.update1').hide();
                            }



                            //   alert(response.eddDate);
                            // ✅ Set website link
                            let websiteUrl = response.Website;
                            $('#websitelink').attr('href', websiteUrl);

                            // ✅ Set brand logo image
                            let brandLogoUrl = response.brand_logo ||
                                '{{ asset('img/logo1.png') }}';
                            $('#brandlogo').attr('src', brandLogoUrl);


                            // ✅ Populate Order Info

                            // $('#accordionPanelsStayOpenExample').hide();

                            $('.ordernumber').text(response.singleproquery.orderno);
                            $('#eddDate').text(response.eddDate);
                            $('#couriername').text(response.singleproquery.courier_name);
                            $('#fromaddress').text(response.singleproquery.pickup_city);
                            $('#toaddress').text(response.singleproquery.City);
                            $('#productname').text(response.singleproquery.Item_Name);
                            $('#itemprice').text(response.singleproquery.Cod_Amount);

                            // ✅ Map Current Status to readable format
                            let currentStatus = response.singleproquery.order_status1 || '';
                            const statusClassMap = {
                                'Shipped': 'aa',
                                'In Transit': 'bb',
                                'Delivered': 'cc',
                                'OFD': 'dd',
                                'RTO': 'ee',
                                'Lost': 'ff',
                                'Cancelled': 'gg',
                                'Failed': 'hh',
                                'Processing': 'ii',
                                'Upload': 'jj',
                                'Undelivered': 'kk'
                            };

                            currentStatus = currentStatus === 'Shipped' ? 'Shipped' :
                                currentStatus == 'Pending' ? 'Order Placed' :
                                currentStatus === 'In Transit' ? 'Intransit' :
                                currentStatus === 'Delivered' ? 'Delivered' :
                                currentStatus === 'OFD' ? 'Out For Delivery' :
                                currentStatus === 'Upload' ? 'Ready To Ship' : currentStatus;

                            $('#currentStatus')
                                .text(currentStatus)
                                .attr('class', statusClassMap[response.singleproquery
                                    .order_status1] || '');

                            // ✅ Build Order Status Timeline
                            const statusLogs = response.statusLogs || [];
                            let timelineHtml = '';

                            statusLogs.forEach((log, index) => {
                                const createdAt = new Date(log.created_at);
                                const dateStr = createdAt.toLocaleDateString('en-US', {
                                    month: 'short',
                                    day: '2-digit',
                                    year: 'numeric'
                                });
                                const timeStr = createdAt.toLocaleString('en-US', {
                                    weekday: 'short',
                                    hour: '2-digit',
                                    minute: '2-digit'
                                });

                                timelineHtml += `
                            <div class="progress-step">
                                <div class="date-label">${dateStr}</div>
                                <div class="time-label">${timeStr}</div>
                                <div class="progress-circle ${index === statusLogs.length - 1 ? 'active' : ''}"></div>
                                <div class="status-label">${log.order_status1}</div>
                            </div>
                        `;
                            });

                            $('#orderProgressBar').html(timelineHtml);
                        }
                    },
                    error: function(error) {

                        $('#noRecordMessage').text('No record found').show();
                        console.error('❌ Error fetching order details:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('body').on('click', '.update', function(e) {

                var awb_number = $(this).closest('form').find('#awb_input').val();

                console.log('AWB Number found:', awb_number); // Debug log

                if (!awb_number) {
                    alert('AWB number is required');
                    return;
                }

                $("#staticBackdrop").modal("show");
                $("#spanerror2").text("");
                $("#spanerror1").text("");


                $("#modal-body-content").html(
                    '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
                );


                var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]')
                    .val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.gettrackingdetails') }}",
                    data: {
                        awb_number: awb_number,
                        _token: csrfToken
                    },
                    dataType: 'json',
                    timeout: 30000,
                    success: function(response) {
                        console.log('API Response:', response); // Debug log
                        if (response.success && response.data) {
                            var data = response.data;
                            var trackingHtml = '';

                            // Basic info section with card design
                            trackingHtml += '<div class="card mb-4">';
                            trackingHtml += '<div class="card-header bg-primary text-white">';
                            trackingHtml +=
                                '<h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Shipment Information</h5>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="card-body">';
                            trackingHtml += '<div class="row">';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml +=
                                '<p><strong>AWB Number:</strong><br><span style="color: blue!important;">' +
                                data.airwaybill_no + '</span></p>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml += '<p><strong>Current Status:</strong><br>';
                            trackingHtml += '<span class="badge badge-' + getStatusBadgeClass(
                                data.status_name) + '">' + data.status_name + '</span>';
                            trackingHtml += '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="col-md-4">';
                            trackingHtml += '<p><strong>Delivery Date:</strong><br>' + (data
                                    .delivery_date ||
                                    '<span class="text-muted">Not delivered yet</span>') +
                                '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';

                            // Tracking timeline with improved design
                            if (data.tracking_detail && data.tracking_detail.length > 0) {
                                trackingHtml += '<div class="card">';
                                trackingHtml +=
                                    '<div class="card-header bg-success text-white">';
                                trackingHtml +=
                                    '<h5 class="mb-0"><i class="fas fa-route mr-2"></i>Tracking Timeline</h5>';
                                trackingHtml += '</div>';
                                trackingHtml += '<div class="card-body">';
                                trackingHtml += '<div class="timeline">';

                                data.tracking_detail.forEach(function(item, index) {
                                    var isLast = (index === data.tracking_detail
                                        .length - 1);
                                    var eventClass = getEventClassForTracking(item
                                        .scan);

                                    trackingHtml += '<div class="timeline-item ' + (!
                                            isLast ? 'timeline-item-with-line' : '') +
                                        '">';
                                    trackingHtml += '<div class="timeline-content">';
                                    trackingHtml += '<div class="timeline-header">';
                                    trackingHtml += '<h6 class="timeline-title">' + item
                                        .scan + '</h6>';
                                    trackingHtml += '<small class="text-muted">' +
                                        formatDateTime(item.scan_date_time) +
                                        '</small>';
                                    trackingHtml += '</div>';

                                    // Location info
                                    if (item.location) {
                                        trackingHtml +=
                                            '<div class="timeline-location">';
                                        trackingHtml +=
                                            '<i class="fas fa-map-marker-alt text-muted mr-1"></i>';
                                        trackingHtml += '<span class="text-muted">' +
                                            item.location + '</span>';
                                        trackingHtml += '</div>';
                                    }

                                    // Remarks/Description
                                    if (item.remark) {
                                        trackingHtml +=
                                            '<div class="timeline-description">';
                                        trackingHtml += '<p class="text-muted mb-0">' +
                                            item.remark + '</p>';
                                        trackingHtml += '</div>';
                                    }

                                    trackingHtml += '</div>';
                                    trackingHtml += '</div>';
                                });

                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            } else {
                                trackingHtml += '<div class="card">';
                                trackingHtml += '<div class="card-body text-center">';
                                trackingHtml +=
                                    '<p class="text-muted">No tracking events available for this shipment.</p>';
                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            }

                            $("#modal-body-content").html(trackingHtml);
                        } else {
                            var message = response.message ||
                                'No tracking data found for this AWB number.';
                            $("#modal-body-content").html(
                                '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle mr-2"></i>' +
                                message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error Details:');
                        console.error('Status:', status);
                        console.error('Error:', error);
                        console.error('Response Text:', xhr.responseText);
                        console.error('Status Code:', xhr.status);

                        var errorMessage = 'Error fetching tracking data. ';

                        if (xhr.status === 0) {
                            errorMessage += 'Network error.';
                        } else if (xhr.status === 404) {
                            errorMessage += 'Route not found.';
                        } else if (xhr.status === 500) {
                            errorMessage += 'Server error.';
                        } else if (status === 'timeout') {
                            errorMessage += 'Request timed out.';
                        } else {
                            errorMessage += 'Status: ' + xhr.status + ' - ' + error;
                        }

                        $("#modal-body-content").html(
                            '<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>' +
                            errorMessage +
                            '<br><small>Check console for details.</small></div>');
                    }
                });
            });

            // Helper function to format date and time
            function formatDateTime(dateTimeString) {
                if (!dateTimeString) return 'N/A';

                try {
                    var date = new Date(dateTimeString);

                    var day = ('0' + date.getDate()).slice(-2);
                    var month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are 0-based
                    var year = date.getFullYear();

                    var hours = ('0' + date.getHours()).slice(-2);
                    var minutes = ('0' + date.getMinutes()).slice(-2);
                    var seconds = ('0' + date.getSeconds()).slice(-2);

                    return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
                } catch (e) {
                    return dateTimeString; // Return original if parsing fails
                }
            }

            // Helper function for tracking event styling
            function getEventClassForTracking(scanType) {
                switch (scanType.toLowerCase()) {
                    case 'delivered':
                        return 'bg-success';
                    case 'out for delivery':
                    case 'ofd':
                        return 'bg-warning';
                    case 'in transit':
                    case 'shipped':
                    case 'pickup':
                        return 'bg-info';
                    case 'cancelled':
                    case 'returned':
                        return 'bg-danger';
                    default:
                        return 'bg-secondary';
                }
            }

        });

        $('body').on('click', '.update1', function(e) {

            var awb_number = $(this).closest('form').find('#awb_input').val();

            console.log('AWB Number found:', awb_number); // Debug log

            if (!awb_number) {
                alert('AWB number is required');
                return;
            }

            $("#staticBackdrop").modal("show");
            $("#spanerror2").text("");
            $("#spanerror1").text("");

            $("#modal-body-content").html(
                '<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
            );

            var csrfToken = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').val();

            $.ajax({
                type: "POST",
                url: "{{ route('user.getamazontrackingdetails') }}", // Updated route name
                data: {
                    awb_number: awb_number,
                    _token: csrfToken
                },
                dataType: 'json',
                timeout: 30000,
                success: function(response) {
                    //console.log('API Response:', response); // Debug log
                    if (response.success && response.data) {
                        var data = response.data;

                        var trackingHtml = '';

                        // Basic info section
                        trackingHtml += '<div class="card mb-4">';
                        trackingHtml += '<div class="card-header bg-primary text-white">';
                        trackingHtml +=
                            '<h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>Shipment Information</h5>';
                        trackingHtml += '</div>';
                        trackingHtml += '<div class="card-body">';
                        trackingHtml += '<div class="row">';
                        trackingHtml += '<div class="col-md-4">';
                        trackingHtml +=
                            '<p><strong>AWB Number:</strong><br><span style="color: blue!important;">' +
                            data.awb_number + '</span></p>';
                        trackingHtml += '</div>';
                        trackingHtml += '<div class="col-md-4">';
                        trackingHtml += '<p><strong>Current Status:</strong><br>';
                        trackingHtml += '<span class="badge badge-' + getStatusBadgeClass(data
                                .processed_status.current_status) + '">' + data.processed_status
                            .current_status + '</span>';
                        trackingHtml += '</p>';
                        trackingHtml += '</div>';
                        trackingHtml += '</div>';

                        // Additional status info
                        // if (data.processed_status.attempt_count > 0) {
                        //     trackingHtml += '<div class="row mt-3">';
                        //     trackingHtml += '<div class="col-md-6">';
                        //     trackingHtml += '<p><strong>Delivery Attempts:</strong> ' + data.processed_status.attempt_count + '</p>';
                        //     trackingHtml += '</div>';
                        //     if (data.processed_status.is_rto) {
                        //         trackingHtml += '<div class="col-md-6">';
                        //         trackingHtml += '<p><strong>RTO Status:</strong> <span class="badge badge-warning">Return to Origin</span></p>';
                        //         trackingHtml += '</div>';
                        //     }
                        //     trackingHtml += '</div>';
                        // }

                        // Alternate tracking ID if available
                        if (data.alternate_tracking_id) {
                            trackingHtml += '<div class="row mt-3">';
                            trackingHtml += '<div class="col-12">';
                            trackingHtml += '<p><strong>Alternate Tracking ID:</strong> ' + data
                                .alternate_tracking_id + '</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        }

                        trackingHtml += '</div>';
                        trackingHtml += '</div>';

                        // Tracking timeline
                        if (data.event_history && data.event_history.length > 0) {
                            trackingHtml += '<div class="card">';
                            trackingHtml += '<div class="card-header bg-success text-white">';
                            trackingHtml +=
                                '<h5 class="mb-0"><i class="fas fa-route mr-2"></i>Tracking Timeline</h5>';
                            trackingHtml += '</div>';
                            trackingHtml += '<div class="card-body">';
                            trackingHtml += '<div class="timeline">';

                            data.event_history.forEach(function(item, index) {
                                var isLast = (index === data.event_history.length - 1);
                                var eventClass = getEventClass(item.event_code);

                                trackingHtml += '<div class="timeline-item ' + (!isLast ?
                                    'timeline-item-with-line' : '') + '">';
                                // trackingHtml += '<div class="timeline-marker ' + eventClass + '">';
                                // trackingHtml += '<i class="fas ' + getEventIcon(item.event_code) + '"></i>';
                                // trackingHtml += '</div>';
                                trackingHtml += '<div class="timeline-content">';
                                trackingHtml += '<div class="timeline-header">';
                                trackingHtml += '<h6 class="timeline-title">' + formatEventCode(
                                    item.event_code) + '</h6>';
                                trackingHtml += '<small class="text-muted">' + item.event_time +
                                    '</small>';
                                trackingHtml += '</div>';

                                // Location info if available
                                if (item.location && (item.location.city || item.location
                                        .stateOrRegion || item.location.countryCode)) {
                                    trackingHtml += '<div class="timeline-location">';
                                    trackingHtml +=
                                        '<i class="fas fa-map-marker-alt text-muted mr-1"></i>';
                                    var locationParts = [];
                                    if (item.location.city) locationParts.push(item.location
                                        .city);
                                    if (item.location.stateOrRegion) locationParts.push(item
                                        .location.stateOrRegion);
                                    if (item.location.countryCode) locationParts.push(item
                                        .location.countryCode);
                                    trackingHtml += '<span class="text-muted">' + locationParts
                                        .join(', ') + '</span>';
                                    trackingHtml += '</div>';
                                }

                                // Description if available
                                if (item.description) {
                                    trackingHtml += '<div class="timeline-description">';
                                    trackingHtml += '<p class="text-muted mb-0">' + item
                                        .description + '</p>';
                                    trackingHtml += '</div>';
                                }

                                trackingHtml += '</div>';
                                trackingHtml += '</div>';
                            });

                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        } else {
                            trackingHtml += '<div class="card">';
                            trackingHtml += '<div class="card-body text-center">';
                            trackingHtml +=
                                '<p class="text-muted">No tracking events available for this shipment.</p>';
                            trackingHtml += '</div>';
                            trackingHtml += '</div>';
                        }

                        $("#modal-body-content").html(trackingHtml);
                    } else {
                        var message = response.message || 'No tracking data found for this AWB number.';
                        $("#modal-body-content").html(
                            '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle mr-2"></i>' +
                            message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error Details:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);

                    var errorMessage = 'Error fetching tracking data. ';

                    if (xhr.status === 0) {
                        errorMessage += 'Network error.';
                    } else if (xhr.status === 404) {
                        errorMessage += 'Route not found.';
                    } else if (xhr.status === 500) {
                        errorMessage += 'Server error.';
                    } else if (status === 'timeout') {
                        errorMessage += 'Request timed out.';
                    } else {
                        errorMessage += 'Status: ' + xhr.status + ' - ' + error;
                    }

                    $("#modal-body-content").html(
                        '<div class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>' +
                        errorMessage + '<br><small>Check console for details.</small></div>');
                }
            });
        });

        // Helper functions for styling and formatting
        function getStatusBadgeClass(status) {
            switch (status.toLowerCase()) {
                case 'delivered':
                    return 'success';
                case 'ofd':
                case 'out for delivery':
                    return 'warning';
                case 'in transit':
                case 'shipped':
                    return 'info';
                case 'cancelled':
                case 'pickupcancelled':
                case 'lost':
                case 'undelivered':
                    return 'danger';
                case 'rto':
                    return 'warning';
                default:
                    return 'secondary';
            }
        }

        function getEventClass(eventCode) {
            switch (eventCode.toLowerCase()) {
                case 'delivered':
                    return 'bg-success';
                case 'outfordelivery':
                    return 'bg-warning';
                case 'intransit':
                case 'readyforreceive':
                    return 'bg-info';
                case 'pickupcancelled':
                case 'cancelled':
                    return 'bg-danger';
                case 'pickupdone':
                    return 'bg-primary';
                default:
                    return 'bg-secondary';
            }
        }

        function getEventIcon(eventCode) {
            switch (eventCode.toLowerCase()) {
                case 'delivered':
                    return 'fa-check-circle';
                case 'outfordelivery':
                    return 'fa-truck';
                case 'intransit':
                    return 'fa-route';
                case 'pickupdone':
                    return 'fa-box';
                case 'pickupcancelled':
                case 'cancelled':
                    return 'fa-times-circle';
                case 'readyforreceive':
                    return 'fa-clock';
                default:
                    return 'fa-circle';
            }
        }

        function formatEventCode(eventCode) {
            // Convert camelCase to readable format
            return eventCode.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
        }
    </script>

</body>

</html>
</body>

</html>
