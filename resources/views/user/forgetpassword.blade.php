<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password | Rappidx</title>

  <!-- Bootstrap & Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">

  <!-- SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
    }

    .image-container {
      position: relative;
      height: 400px;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .image-container img {
      max-height: 100%;
      max-width: 100%;
      object-fit: contain;
    }

    .feature-box {
      position: absolute;
      background: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 0.8rem 1.2rem;
      border-radius: 0.5rem;
      font-weight: 600;
      color: #6c757d;
      font-size: 0.9rem;
    }

    .login-card {
      border-radius: 2rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-control {
      border-radius: 0.5rem;
    }

    .btn-primary {
      border-radius: 2rem;
    }

    .footer-link:hover {
      color: #007bff;
      text-decoration: underline;
    }

    .main-footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      border-top: 1px solid #e9ecef;
      font-size: 14px;
      color: #6c757d;
    }

    @media (max-width: 768px) {
      .footer-content {
        flex-direction: column;
        text-align: center;
      }
    }

    
  </style>
</head>

<body>

  <div class="container">
    <div class="row align-items-center justify-content-center py-5">

      <!-- Left Section -->
      <div class="col-md-7 mb-4 d-flex flex-column justify-content-between">
        <div class="text-center mb-4">
          <h1 class="display-6 fw-bold text-dark">WELCOME TO RAPPIDX</h1>
          <p class="fs-5 text-muted">Next Level Shipping Solution</p>
        </div>

        <div class="image-container">
          <img src="set.png" alt="Delivery Person" class="img-fluid">
          <div class="feature-box" style="top: 5%; left: 5%;"><i class="fa fa-google-wallet text-warning"></i> RTO REDUCE UPTO 50%</div>
          <div class="feature-box" style="top: 25%; left: 70%;"><i class="fa fa-google-wallet text-warning"></i> FAST COD REMITTANCE</div>
          <div class="feature-box" style="bottom: 5%; left: 5%;"><i class="fa fa-rub text-warning"></i> REAL TIME TRACKING</div>
          <div class="feature-box" style="left: 5%;"><i class="fa fa-google-wallet text-warning"></i> BRANDED TRACKING PAGE</div>
          <div class="feature-box" style="top: 50%; left: 60%;"><i class="fa fa-keyboard-o text-warning"></i> MULTIFUNCTIONAL DASHBOARD</div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-5">
        <div class="card login-card p-4">
          <div class="card-body">
            <div class="text-center mb-4">
              <img src="logo.png" alt="Rappidx Logo" class="mb-3" style="height: 50px;">
              <h2 class="fw-bold">Forgot Password</h2>
              <p class="text-muted">Enter your email address and we’ll send you a link to reset your password.</p>
            </div>

            <!-- Forgot Password Form -->
            <form method="POST" action="{{ url('forgetsend') }}">
              @csrf

              <div class="mb-3">
                <input type="email" name="username" id="username" class="form-control" placeholder="username@rappidx.com" required>
              </div>

              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary" style="background: #AAB3C3 !important; border: none; color:black;">Continue</button>
              </div>
            </form>

            <!-- Messages -->
            <div class="mt-3">
              @if ($errors->any())
              <div class="alert alert-danger">{{ $errors->first() }}</div>
              @endif

              @if (session()->has('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              @if (session()->has('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
              @endif
            </div>

            <div class="text-center mt-3">
              <a href="{{ route('user.login') }}" class="text-decoration-none text-primary">← Back to Login</a>
            </div>
          </div>
        </div>
      </div>




    </div>
  </div>

  <!-- Footer -->
  {{-- <footer class="main-footer">
    <div class="container d-flex justify-content-between flex-wrap text-center text-md-start">
      <span>CIN: U63030DL2020PTC370737</span>
      <div>
        <a href="{{ asset('policies/TERMS.pdf') }}" class="footer-link me-2">Terms & Conditions</a> |
        <a href="{{ asset('policies/REFUND.pdf') }}" class="footer-link mx-2">Privacy Policy</a> |
        <a href="{{ asset('policies/privacy A.pdf') }}" class="footer-link ms-2">Refund & Cancellation Policy</a>
      </div>
      <span>© 2025 Rappidx. All rights reserved.</span>
    </div>
  </footer> --}}

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
