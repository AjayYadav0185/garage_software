
<!DOCTYPE html>
<html lang="en">

<head>
    <title>India's smartest e-commerce logistics & shipping solutions | Courier Aggregator</title>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Rappidx is India's best logistics solutions & cheapest courier company in India for e-commerce business Rappidx offers the best shipping rates with multiple courier partners & integrates easily with all e-commerce platforms." />
    <meta name="description" content="Rappidx is India's best logistics solutions & cheapest courier company in India for e-commerce business Rappidx offers the best shipping rates with multiple courier partners & integrates easily with all e-commerce platforms." />
    <meta name="author" content="Singhaniya" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


    <link rel="icon" href="{{ asset('assets/images/favicon.jpg')}}" type="image/gif" sizes="16x16">
    
    <!-- Meta tags -->
    <!-- font-awesome icons -->
     <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="{{asset('assets/css/style.css')}}" rel='stylesheet' type='text/css' media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>
   
    <!--//style sheet end here-->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>

<body style="background-color:#ffe141">
    <!-- <h1 class="error">Allied Login Form</h1> --><br><br>
    <div class="w3layouts-two-grids" style="border-radius:20px">
        <div class="mid-class">

<div class="img-right-side" style="border-top-left-radius: 20px;border-bottom-left-radius: 28px;">

    <h3><a href="index.php" style="color:black">Welcome To Rappidx</a></h3>
    <!-- <p>Serving Happiness</p> -->
    <img src="{{ asset('assets/images/b11.png') }}" class="img-fluid" alt="">

</div>
<div class="txt-left-side" style="background-color:#1a1a1a;border-top-right-radius: 28px;border-bottom-right-radius: 28px;">
<div class="col-md mb-4 mb-md-0">
                           
            @if($errors->any())
            <div id="err" style="color: red">
            <div class="alert alert-danger">{{$errors->first()}}</div>
            </div>
          @endif
                  
          <div id="err" style="color: red">
            @if(session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
          </div>
                  
          <div id="err" style="color: yellow">
            @if(session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
          </div>
     </div>
<h2> Sign In </h2>
 <form id="loginForm" method="POST">
    @csrf
       <div class="form-left-to-w3l">
        <span class="fa fa-envelope-o" aria-hidden="true"></span>
        <input type="email" name="email" id="email" placeholder="Email" required="">

        <div class="clear"></div>
    </div>
    <div class="form-left-to-w3l ">
        <span class="fa fa-lock" aria-hidden="true"></span>
        <input type="password" name="password" id="password" placeholder="Password" required="">
        <div class="clear"></div>
    </div>
    
        <div class="right-side-forget">
            <!-- <a href="#" class="for">Forgot password...?</a> -->
            <strong><a href="{{route('user.forgetpassword')}}" class="for" style="color:#60baaf">Forgot password...?</a></strong>
        </div>
    <!-- </div> -->
    <div class="btnn">
        <button type="submit" id="login" name="loginchekc">Sign In </button>
    </div>
</form>

<div class="w3layouts_more-buttn">
    <h3>Don't Have an account..? <a href="{{route('user.singup')}}"> Sign Up</a></h3>
</div>





            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>

    $(document).ready(function () {

            
			$('body').on('submit', '#loginForm', function(e) {
                e.preventDefault();
                var current = $(this);
                var formData = current.serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('user.logincheck') }}",
            data: formData,
            success: function (response) {
                if (response.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Credentials Verified!',
                        text: 'You have successfully logged into the system.',
                        timer: 3000,
                        showConfirmButton: false
                    }).then(function () {
                        window.location.href = "{{ url('user/index') }}";
                    });
                } else {
                    //alert(response.data);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Login Credentials Not Verified!',
                    });
                }
            },
            error: function (error) {
                console.log("Error:", error);
            }
        });


    });

        $('.passwordchars').on('keypress',function(e){

        var regex=new RegExp("^[a-zA-Z@#!$0-9 ]");
        var key=String.fromCharCode(!e.charCode ? e.which :e.charCode);
        if(!regex.test(key)){
            e.preventDefault();
            return false;
        }

        });

        $('#togglePassword').click(function(){
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
