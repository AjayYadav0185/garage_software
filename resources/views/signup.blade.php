<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rappidx </title>
    <!-- Meta tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Rappidx"/>
     <link rel="icon" href="{{ asset('assets/images/favicon.jpg')}}" type="image/gif" sizes="16x16">
    <script>
        addEventListener("load", function () { setTimeout(hideURLbar, 0); }, false); function hideURLbar() { window.scrollTo(0, 1); }
    </script>
    <!-- Meta tags -->
    <!-- font-awesome icons -->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link href="{{asset('assets/css/style.css')}}" rel='stylesheet' type='text/css' media="all">
    <!--//style sheet end here-->
    <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
</head>

<body style="background-color:#ffe141">
    <!-- <h1 class="error">Allied Login Form</h1> --><br>
    <div class="w3layouts-two-grids" style="border-radius:20px">
        <div class="mid-class">

<div class="img-right-side" style="border-top-left-radius: 20px;border-bottom-left-radius: 28px;">

    <h3><a href="index.php" style="color:black">{{ translate('Welcome To Rappidx') }}</a></h3>
    <!-- <p>Serving Happiness</p> -->
    <img src="{{ asset('assets/images/b11.png') }}" class="img-fluid" alt="">



</div>
<div class="txt-left-side" style="background-color:#1a1a1a;border-top-right-radius: 28px;border-bottom-right-radius: 28px;">
    <h2> {{ translate('Sign Up') }} </h2>



<style type="text/css">
input[type="text" i] {
    padding: 1px 2px;
}
</style>

<style type="text/css">
.singnupform{
    width:100%;
    background-color:#1a1a1a;
    color:white
}
</style>

<form action="{{ url('singupsave') }}" method="POST">
    @csrf
    <div class="form-left-to-w3l">
        <span class="fa fa-user" aria-hidden="true"></span>
        <input type="text" name="name" class="from-control singnupform" placeholder="Name *" autocomplete="off" required="">
        <div class="clear"></div>
    </div>

    <div class="form-left-to-w3l">
        <span class="fa fa-mobile" aria-hidden="true"></span>
        <input type="text" name="mobile" class="from-control singnupform" placeholder="Mobile *" autocomplete="off" required="">
        <div class="clear"></div>
    </div>

    <div class="form-left-to-w3l">
        <span class="fa fa-envelope-o" aria-hidden="true"></span>
        <input type="email" name="email" placeholder="Email"  autocomplete="off" required="">
        <div class="clear"></div>
    </div>

    <div class="form-left-to-w3l">
        <span class="fa fa-university" aria-hidden="true"></span>
        <input type="text" name="companystorename" class="from-control singnupform" placeholder="Company/ Store Name *" autocomplete="off" required="">
        <div class="clear"></div>
    </div>

    <div class="form-left-to-w3l">
        <span class="fa fa-filter" aria-hidden="true"></span>
        <select class="from-control singnupform" name="sellertype" required>
            <option value="">{{ translate('Select Seller Type') }} *</option>
            <option value="Online Store / D2C">{{ translate('Online Store / D2C') }}</option>
            <option value="Market Place">{{ translate('Market Place') }}</option>
            <option value="Franchise">{{ translate('Franchise')}}</option>
            <option value="Others">{{ translate('Others') }}</option>
        </select>
        <div class="clear"></div>
    </div>

    <!--<div class="form-left-to-w3l">-->
    <!--    <span class="fa fa-lock" aria-hidden="true"></span>-->
    <!--    <input type="password" name="password" placeholder="Password *" required="">-->
    <!--    <div class="clear"></div>-->
    <!--</div>-->

    <!-- <div class="main-two-w3ls">
        <div class="left-side-forget">
            <input type="checkbox" class="checked">
            <span class="remenber-me">Remember me </span>
        </div>
        <div class="right-side-forget">
            <a href="#" class="for">Forgot password...?</a>
        </div>
    </div> -->

    <div class="btnn">
        <button type="submit" style="margin:0px">{{ translate('Sign up ') }}</button>
    </div>
</form>



<div class="w3layouts_more-buttn">
    <h3>Already Have an account..? <a href="{{route('user.login')}}"> {{ translate('Sign In Here') }}</a></h3>
</div>



            </div>
        </div>
    </div>

</body>

</html>
