<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ translate('Forgot Password | Rappidx') }}</title>

   <!-- Bootstrap & Fonts -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">
   <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">

   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>

   <style>
      body {
         background-color: #f8f9fa;
         margin: 0;
         font-family: 'Open Sans', sans-serif;
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
         padding: 0.6rem 1rem;
         border-radius: 0.5rem;
         font-weight: 600;
         color: #6c757d;
         font-size: 0.85rem;
      }

      .login-card {
         border-radius: 2rem;
         box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
         background: #fff;
      }

      .form-control {
         border-radius: 0.5rem;
         padding: 10px 15px;
      }

      .btnn button {
         width: 100%;
         border-radius: 2rem;
         padding: 10px 20px;
         background-color: #ffc107;
         color: black;
         font-weight: 600;
         border: none;
         margin-top: 15px;
      }

      .btnn button:hover {
         background-color: #e0a800;
      }

      .main-footer {
         background-color: #f8f9fa;
         padding: 20px 0;
         border-top: 1px solid #e9ecef;
         font-size: 14px;
         color: #6c757d;
      }

      .footer-link:hover {
         color: #007bff;
         text-decoration: underline;
      }

      @media (max-width: 768px) {
         .footer-content {
            flex-direction: column;
            text-align: center;
         }

         .feature-box {
            font-size: 0.75rem;
            padding: 0.4rem 0.6rem;
         }
      }
   </style>
</head>

<body>

   <div class="container">
      <div class="row align-items-center justify-content-center py-5">
         <!-- Left Section -->
         <div class="col-md-7 mb-4">
            <div class="text-center mb-4">
               <h1 class="display-6 fw-bold text-dark">{{ translate('WELCOME TO RAPPIDX') }}</h1>
               <p class="fs-5 text-muted">{{ translate('Next Level Shipping Solution') }}</p>
            </div>
            <div class="image-container">
               <img src="../set.png" alt="Delivery Person" class="img-fluid">
               <div class="feature-box" style="top: 5%; left: 5%;"><i class="fa fa-google-wallet text-warning"></i>
                 {{ translate('RTO REDUCE UPTO') }} 50%</div>
               <div class="feature-box" style="top: 25%; left: 70%;"><i class="fa fa-google-wallet text-warning"></i>
                 {{ translate(' FAST COD REMITTANCE') }}</div>
               <div class="feature-box" style="bottom: 5%; left: 5%;"><i class="fa fa-rub text-warning"></i>{{ translate(' REAL TIME
                  TRACKING') }}</div>
               <div class="feature-box" style="top: 40%; left: 5%;"><i class="fa fa-google-wallet text-warning"></i>
                  {{ translate('BRANDED TRACKING PAGE') }}</div>
               <div class="feature-box" style="top: 50%; left: 60%;"><i class="fa fa-keyboard-o text-warning"></i>
                 {{ translate(' MULTIFUNCTIONAL DASHBOARD') }}</div>
            </div>
         </div>

         <!-- Right Section -->
         <div class="col-md-5">
            <div class="card login-card p-4">
               <div class="card-body">
                  <div class="text-center mb-4">
                     <img src="../logo.png" alt="Rappidx Logo" class="mb-3" style="height: 50px;">
                     <h2 class="fw-bold">{{ translate('Forgot Password') }}</h2>
                  </div>

                  <form method="POST" action="{{ url('changeforgotpass') }}">
                     @csrf

                     <div class="mb-3">
                        <input type="email" class="form-control" value="{{ $obj->Email }}" disabled>
                     </div>

                     <div class="mb-3">
                        <input type="text" id="otp" name="otp" class="form-control @error('otp') is-invalid @enderror"
                           placeholder="Enter OTP*" required>
                        @error('otp')
                     <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                     </div>

                     <div class="mb-3">
                        <div class="input-group">
                           <input type="password" id="password" name="password"
                              class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password*"
                              required>
                           <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                              <i class="fa fa-eye" id="togglePasswordIcon"></i>
                           </span>
                        </div>
                        @error('password')
                     <div class="invalid-feedback d-block">{{ $message }}</div>
                  @enderror
                     </div>

                     <script>
                        function togglePassword() {
                           const passwordInput = document.getElementById("password");
                           const icon = document.getElementById("togglePasswordIcon");

                           if (passwordInput.type === "password") {
                              passwordInput.type = "text";
                              icon.classList.remove("fa-eye");
                              icon.classList.add("fa-eye-slash");
                           } else {
                              passwordInput.type = "password";
                              icon.classList.remove("fa-eye-slash");
                              icon.classList.add("fa-eye");
                           }
                        }
                     </script>

                     <div class="mb-3">
                        <input type="password" id="confirmpassword" name="confirmpassword"
                           class="form-control @error('confirmpassword') is-invalid @enderror"
                           placeholder="Confirm Password*" required>
                        @error('confirmpassword')
                     <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                     </div>

                     <input type="hidden" name="url" value="{{ $obj->forgot_url }}">

                     <div class="btnn">
                        <button type="submit" name="submit" style="background: #AAB3C3 !important;">{{ translate('Verify') }}</button>
                     </div>
                  </form>

                  <div class="mt-4 text-center">
                     <a href="{{ route('user.login') }}" class="text-decoration-none">←{{ translate(' Back to Login') }}</a>
                  </div>

                  <div class="mt-3">
                     @if($errors->any())
                   <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                     @if(session('error'))
                   <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                     @if(session('success'))
                   <div class="alert alert-success">{{ session('success') }}</div>
                @endif
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
