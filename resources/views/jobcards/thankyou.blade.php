<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>{{ translate('Thank You') }}</title>
  <style>
    /* Simple, modern centered card */
    html, body { height: 100%; margin: 0; font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial; }
    body { display: flex; align-items: center; justify-content: center; background: #f5f7fb; }
    .card { background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(20, 30, 50, 0.08); padding: 36px 40px; max-width: 520px; text-align: center; }
    .icon { width: 84px; height: 84px; margin: 0 auto 18px; display: block; }
    h1 { margin: 0 0 8px; font-size: 24px; color: #0f1724; }
    p { margin: 0 0 18px; color: #475569; }
    .btn { display: inline-block; padding: 10px 18px; border-radius: 8px; background: #4361ee; color: #fff; text-decoration: none; font-weight: 600; }
    .sub { font-size: 13px; color: #94a3b8; margin-top: 10px; }
    @media (max-width: 420px) { .card { padding: 24px; } }
  </style>
</head>
<body>
  <div class="card">
    <!-- Success icon -->
    <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <circle cx="12" cy="12" r="10" stroke="#34D399" stroke-width="1.5" fill="#ECFDF5"/>
      <path d="M7.5 12.5l2.5 2.5L16.5 9" stroke="#059669" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>

    <!-- Dynamic Heading Based on action_type -->
    @if(session('action_type') == 'approved')
      <h1>{{ translate('Thank you for your approval') }}</h1>
      <p>{{ translate('Your job card has been approved successfully.') }}</p>
    @elseif(session('action_type') == 'rejected')
      <h1>{{ translate('Thank you for your rejection') }}</h1>
      <p>{{ translate('Your job card has been rejected successfully.') }}</p>
    @else
      <h1>{{ translate('Thank you for your action') }}</h1>
      <p>{{ session('message') }}</p>
    @endif

    <!-- Button -->
    <a class="btn" href="https://www.merigarage.com/software/">{{ translate('Visit Our Website') }}</a>

    <div class="sub">{{ translate('If you need anything else, contact support.') }}</div>
  </div>
</body>
</html>
