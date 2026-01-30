<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>
  <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">

  <title>Rappidx Login Page</title>
  <style>
    /* Custom Styling */
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      /* display: flex; */
      justify-content: center;
      align-items: center;
      margin: 0;
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

    .custom-btn {
      background: white;
      border: none;
      padding: 0.8rem 2rem;
      border-radius: 50px;
      font-weight: bold;
      transition: background 0.3s ease-in-out;
    }

    .custom-btn:hover {
      /* background: #e0a800; */
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

    .login-card {
      border-radius: 2rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .login-card img {
      width: 40px;
    }

    .google-btn {
      border: 1px solid #dfe1e5;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .google-btn img {
      width: 20px;
    }

    .text-muted {
      color: #6c757d !important;
    }

    .form-control {
      border-radius: 0.5rem;
    }
  </style>

  <style>
    .signup-link {
      background: linear-gradient(to right, #FDD835, #FF8F00);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-weight: bold;
    }

    .signup-link:hover {
      text-decoration: underline;
      /* Optional: underline on hover */
    }


    .small-swal-popup {
      max-width: 300px !important;
      padding: 0px !important;
      font-size: 14px;
    }

    .custom-text-color {
      color: blue;
      font-size: 16px;
    }

    .custom-text-error-color {
      color: blue;
      font-size: 16px;
    }

    .custom-title-color {
      color: #2b8a3e;
      font-size: 20px;
    }

    .custom-text-error-color {
      color: red;
      font-size: 16px;
    }

    .custom-title-error-color {
      color: red;
      font-size: 20px;
    }
  </style>
  <style>
    .main-footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      border-top: 1px solid #e9ecef;
      font-size: 14px;
      color: #6c757d;
    }

    .container {
      width: 100%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
      max-width: 1200px;
    }

    .footer-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
    }

    .footer-section {
      padding: 5px 0;
    }

    .footer-links {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      justify-content: center;
    }

    .footer-link:hover {
      color: #007bff;
      text-decoration: underline;
    }

    .footer-divider {
      color: #dee2e6;
      margin: 0 5px;
    }

    .footer-text {
      display: inline-block;
    }

    @media (max-width: 768px) {
      .footer-content {
        flex-direction: column;
        text-align: center;
      }

      .footer-section {
        margin-bottom: 10px;
      }

      .footer-links {
        flex-direction: column;
      }

      .footer-divider {
        display: none;
      }

      .footer-link {
        margin: 5px 0;
      }


    }

    input::placeholder {
      font-size: 14px;
      /* set your desired size here */
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row align-items-center justify-content-center p-6">
      <!-- Left Section -->
      <div class="col-md-7 mb-4 mb-md-0 d-flex flex-column justify-content-between">

        <div
          class="col-md-12 d-flex flex-column justify-content-center align-items-center text-center mb-4 mt-4 mb-md-0">
          <h1 class="display-6 fw-bold text-dark">WELCOME TO RAPPIDX</h1>
          <p class="fs-5 text-muted">Next Level Shipping Solution</p>
        </div>

        <!-- Image Section with Feature Points -->
        <div class="image-container mt-4">
          <img src="set.png" alt="Delivery Person" class="img-fluid">

          <!-- Feature Boxes -->
          <div class="feature-box" style="top: 5%; left: 5%;"><i class="fa fa-google-wallet" aria-hidden="true"
              style="color:#FEC92B;"></i> RTO REDUCE UPTO 50%</div>
          <div class="feature-box" style="top: 25%; left: 70%;"><i class="fa fa-google-wallet" aria-hidden="true"
              style="color:#FEC92B;"></i> FAST COD REMITTANCE</div>
          <div class="feature-box" style="bottom: 5%; left: 5%;"><i class="fa fa-rub" aria-hidden="true"
              style="color:#FEC92B;"></i> REAL TIME TRACKING</div>
          <div class="feature-box" style="left: 5%;"><i class="fa fa-google-wallet" aria-hidden="true"
              style="color:#FEC92B;"></i> BRANDED TRACKING PAGE</div>
          <div class="feature-box" style="top: 50%; left: 60%;"><i class="fa fa-keyboard-o" aria-hidden="true"
              style="color:#FEC92B;"></i> MULTIFUNCTIONAL DASHBOARD</div>
        </div>

        <!-- Button -->
        <div class="text-center mt-3">
          <button class="custom-btn">Success Simplified</button>
        </div>
      </div>

      <!-- Right Section -->
      <div class="col-md-5" style="border-radius: 25px;">
        <div class="card login-card p-4">
          <div class="card-body">
            <!-- Logo and Welcome -->
            <div class="text-center mb-4">
              <img src="logo.png" alt="Rappidx Logo" class="mb-3">
              <h2 class="fw-bold">Welcome</h2>
            </div>

            <!-- Google Sign-In -->
            {{-- <button class="btn google-btn rounded-3 w-100 mb-3" style="border-radius: 2rem !important;">
              <img src="google.png" alt="Google Logo" class="me-2">
              Sign in with Google
            </button>

            <div class="text-center text-muted mb-3">OR</div> --}}

            <!-- Login Form -->
            <form id="loginForm" action="{{ route('user.logincheck') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">User Id</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="name@email.com" required>
              </div>
              <!-- Font Awesome CDN (place in <head>) -->
              {{--
              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
              --}}

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required>
                  <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                  </span>
                </div>
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

              <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('user.forgetpassword') }}" target="_blank" class="text-decoration-none text-primary">
                  Forget Your Password ?<span class="ms-3">Click here</span>
                </a>
              </div>


              <div class="d-grid gap-2">
                <button class=" btn btn" type="submit"
                  style="background: #AAB3C3 !important; color: black;">Login</button>
              </div>

              {{-- <button type="submit" class="btn btn-primary w-100">Continue</button> --}}
            </form>
            <div class="text-muted mt-4">
              <span style="color: black;">By clicking on login, I accept the</span>
              <a href="https://rappidx.intileotech.com/terms-condition/" class="text-decoration-none text-primary"
                target="_blank" rel="noopener noreferrer">Terms & Conditions</a>
              <span style="color: black;">&</span>
              <a href="https://rappidx.intileotech.com/privacy-policy/" class="text-decoration-none text-primary"
                target="_blank" rel="noopener noreferrer">Privacy Policy</a>
            </div>


            <div class="text-muted mt-2 ">
              <span style="color: black;">New to Rappidx?</span>
              <a href="{{ route('user.singup') }}" target="_blank" class="text-decoration-none text-primary ">Signup</a>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Add the footer right after the main container -->
  {{-- <footer class="main-footer m-2">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <span class="footer-text">CIN: U63030DL2020PTC370737</span>
        </div>
        <div class="footer-section footer-links">
          <a href="{{ asset('policies/TERMS.pdf') }}" class="footer-link">Terms & Conditions</a>
          <span class="footer-divider">|</span>
          <a href="{{ asset('policies/REFUND.pdf') }}" class="footer-link">Privacy Policy</a>
          <span class="footer-divider">|</span>
          <a href="{{ asset('policies/privacy A.pdf') }}" class="footer-link">Refund & Cancellation
            Policy</a>
        </div>
        <div class="footer-section">
          <span class="footer-text">© 2025 Rappidx. All rights reserved.</span>
        </div>
      </div>
    </div>
  </footer> --}}

  <!-- Make sure the CSS is either in your main stylesheet or in the head section -->



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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

      $('.passwordchars').on('keypress', function (e) {

        var regex = new RegExp("^[a-zA-Z@#!$0-9 ]");
        var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (!regex.test(key)) {
          e.preventDefault();
          return false;
        }

      });

      $('#togglePassword').click(function () {
        // Get the password input field
        var passwordField = $('#password');

        // Get the type attribute
        var passwordFieldType = passwordField.attr('type');

        // Toggle between password and text
        passwordField.attr('type', passwordFieldType === 'password' ? 'text' : 'password');

        // Toggle the eye icon
        $('#togglePassword').toggleClass('fa-eye fa-eye-slash');
      });

    });

  </script>

</body>

</html>