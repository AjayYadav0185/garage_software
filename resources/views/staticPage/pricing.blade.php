<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ translate('Global Premium Plans')}}</title>

<!-- Razorpay -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* Global Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

body {
  min-height: 100vh;
  background: linear-gradient(120deg,#6a11cb,#2575fc);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  overflow-x: hidden;
  color: #fff;
}

/* Gradient Animation */
@keyframes bgShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

body {
  background-size: 400% 400%;
  animation: bgShift 15s ease infinite;
}

/* Notice Banner */
.notice {
  background: rgba(0,0,0,0.3);
  backdrop-filter: blur(10px);
  padding: 25px 40px;
  border-radius: 16px;
  margin-bottom: 50px;
  text-align: center;
  animation: slideIn 1s ease forwards;
}

.notice button {
  background: linear-gradient(135deg,#ff416c,#ff4b2b);
  border: none;
  padding: 18px 28px;
  border-radius: 12px;
  font-size: 18px;
  font-weight: 600;
  color: #fff;
  cursor: pointer;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.notice button:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 15px 30px rgba(0,0,0,0.4);
}

/* Pricing Section */
.pricing-plans {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 30px;
  padding: 0 20px 60px;
}

/* Cards */
.pricing-card {
  width: 320px;
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  border: 1px solid rgba(255,255,255,0.2);
  padding: 40px 30px 90px;
  position: relative;
  overflow: hidden;
  transition: all 0.5s ease;
  box-shadow: 0 20px 50px rgba(0,0,0,0.2);
  transform: translateY(0px);
  animation: fadeUp 1s ease forwards;
}

.pricing-card:hover {
  transform: translateY(-15px) scale(1.05);
  box-shadow: 0 30px 60px rgba(0,0,0,0.4);
}

/* Card Colors */
.basic { --accent: #38bdf8; }
.standard { --accent: #22c55e; }
.premium { --accent: #e879f9; }

/* Heading */
.heading h4 {
  font-size: 26px;
  font-weight: 700;
  color: var(--accent);
}

.heading p {
  font-size: 14px;
  opacity: 0.8;
  margin-top: 5px;
}

/* Price */
.price {
  font-size: 56px;
  font-weight: 700;
  margin: 25px 0;
  color: #fff;
}

.price sub {
  font-size: 14px;
  opacity: 0.6;
}

/* Features */
.features {
  list-style: none;
  margin-top: 20px;
  padding-left: 0;
}

.features li {
  margin-bottom: 14px;
  font-size: 15px;
}

.features i {
  color: var(--accent);
  margin-right: 12px;
}

/* Call to Action */
.cta-btn {
  position: absolute;
  bottom: 25px;
  left: 50%;
  transform: translateX(-50%);
  width: 80%;
  padding: 15px 0;
  border: none;
  border-radius: 14px;
  font-size: 18px;
  font-weight: 700;
  background: linear-gradient(135deg,var(--accent),#fff);
  color: #000;
  cursor: pointer;
  transition: transform 0.3s ease, letter-spacing 0.3s ease;
}

.cta-btn:hover {
  transform: translateX(-50%) scale(1.05);
  letter-spacing: 1px;
}

/* Animations */
@keyframes fadeUp {
  from {opacity:0; transform: translateY(40px);}
  to {opacity:1; transform: translateY(0);}
}

@keyframes slideIn {
  from {opacity:0; transform: translateY(-20px);}
  to {opacity:1; transform: translateY(0);}
}

/* Responsive */
@media(max-width: 1000px){
  .pricing-card { width: 90%; }
}
</style>
</head>

<body>

<div class="notice">
  <a href="login">
    <button>
      {{ translate('Trial Expired!') }} 🔔<br>
      {{ translate('Call: +91 9958300122') }}<br>
     {{ translate( 'Login to Continue') }}
     </button>
  </a>
</div>

<section class="pricing-plans">

<!-- Basic -->
<div class="pricing-card basic">
  <div class="heading">
    <h4>{{ translate('3 Months') }}</h4>
    <p>{{ translate('Starter Plan') }}</p>
  </div>
  <div class="price">{{currency_symbol()}}1499 <sub>/{{ translate('only') }}</sub></div>
  <ul class="features">
    <li><i class="fa fa-check"></i>{{ translate('Quick Job Card') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('E-Invoicing') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Customer Database') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Service Reminders') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Multi-User Support') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('24/7 Support') }}</li>
  </ul>
  <button class="cta-btn">{{ translate('Buy Now') }}</button>
</div>

<!-- Standard -->
<div class="pricing-card standard">
  <div class="heading">
    <h4>6 {{ translate('Months')}}</h4>
    <p>{{ translate('Most Popular') }}</p>
  </div>
  <div class="price">{{currency_symbol()}}2699 <sub>/{{ translate('only') }}</sub></div>
  <ul class="features">
    <li><i class="fa fa-check"></i>{{ translate('All Starter Features') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Advanced Reports') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Priority Support') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Multi-Branch') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Cloud Backup') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('24/7 Support') }}</li>
  </ul>
  <button class="cta-btn">{{ translate('Buy Now') }}</button>
</div>

<!-- Premium -->
<div class="pricing-card premium">
  <div class="heading">
    <h4>1 {{ translate('Year') }}</h4>
    <p>{{ translate('Enterprise Plan') }}</p>
  </div>
  <div class="price">{{currency_symbol()}}4999 <sub>/{{ translate('only') }}</sub></div>
  <ul class="features">
    <li><i class="fa fa-check"></i>{{ translate('All Pro Features') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Unlimited Users') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Dedicated Manager') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('API Access') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('Advanced Security') }}</li>
    <li><i class="fa fa-check"></i>{{ translate('24/7 VIP Support') }}</li>
  </ul>
  <button class="cta-btn">{{ translate('Buy Now') }}</button>
</div>

</section>

</body>
</html>
