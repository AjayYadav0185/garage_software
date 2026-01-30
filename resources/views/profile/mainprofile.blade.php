@extends('user.dashboard.layout.master')
@section('user-contant')
<style>
.emp-profile {
    padding: 3%;
    margin-top: 3%;
    margin-bottom: 3%;
    border-radius: 0.5rem;
    background: #fff;
}

.profile-img {
    text-align: center;
}

.profile-img img {
    width: 70%;
    height: 100%;
}
.theme-white .nav-pills .nav-link.active {
    color: #fff;
    background-color: #6777ef;
}
.profile-img .file {
    position: relative;
    overflow: hidden;
    margin-top: -20%;
    width: 70%;
    border: none;
    border-radius: 0;
    font-size: 15px;
    background: #212529b8;
}

.profile-img .file input {
    position: absolute;
    opacity: 0;
    right: 0;
    top: 0;
}

.profile-head h5 {
    color: #333;
}

.profile-head h6 {
    color: #0062cc;
}

.profile-edit-btn {
    border: none;
    border-radius: 1.5rem;
    width: 70%;
    padding: 2%;
    font-weight: 600;
    color: #6c757d;
    cursor: pointer;
}

.proile-rating {
    font-size: 12px;
    color: #818182;
    margin-top: 5%;
}

.proile-rating span {
    color: #495057;
    font-size: 15px;
    font-weight: 600;
}

.profile-head .nav-tabs {
    margin-bottom: 5%;
}

.profile-head .nav-tabs .nav-link {
    font-weight: 600;
    border: none;
}

.profile-head .nav-tabs .nav-link.active {
    border: none;
    border-bottom: 2px solid #0062cc;
}

.profile-work {
    padding: 14%;
    margin-top: -15%;
}

.profile-work p {
    font-size: 12px;
    color: #818182;
    font-weight: 600;
    margin-top: 10%;
}

.profile-work a {
    text-decoration: none;
    color: #495057;
    font-weight: 600;
    font-size: 14px;
}

.profile-work ul {
    list-style: none;
}

.profile-tab label {
    font-weight: 600;
}

.profile-tab p {
    font-weight: 600;
    color: #0062cc;
}
.theme-white .nav-pills .nav-link.active {
    color: #fff;
    background-color: #6777ef;
    margin-right: 4px;
}
.profile-card{
    border: 2px solid #11151f;
    max-width: 1100px !important;
    background : #FFFF !important;
    color: #333;
    height: 100%;
    align-items: center;
    box-shadow: none !important
}
.profile-card h3 {
    margin-top: 70px !important;
}
</style>


<div class="loader"></div>
    <div id="app">

        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg">

            </div>


            <!-- Main Content -->

            <div class="main-content">

                <section class="section">
                    <div class="container">
                        <div class="profile-card shadow rounded bg-light">
                            <!-- Profile Image and Info -->
                            {{-- style="background-color: #f9c922; padding: 20px; border-radius: 8px;" --}}
                            <div class="text-center mb-4" >
                                <img src="{{asset('user/assets/img/user.png')}}" alt="User Image" class="profile-img rounded-circle mb-3" width="120">
                                <h3 class="font-weight-bold">
                                               @if (get_role(Auth::user()->usertype) == 2)
                                    {{ Auth::guard('web')->user()->Company_Name . '  Admin' }}
                                @else
                                    {{ Auth::guard('web')->user()->Company_Name }}
                                @endif
                                </h3>
                            </div>

                            <div class="container">
                                <form>
                                    <div class="row">
                                        <!-- Left Column -->
                                        <div class="col-md-6">
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="fullName" class="form-label me-3" style="min-width: 120px;">{{ translate('Full Name') }}</label>
                                                <input type="text" id="fullName" class="form-control" value="{{$userData->first_name}} {{$userData->last_name}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="userId" class="form-label me-3" style="min-width: 120px;">{{ translate('User ID') }}</label>
                                                <input type="text" id="userId" class="form-control" value="{{$userData->User_Email}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="contactNumber" class="form-label me-3" style="min-width: 120px;">{{ translate('Contact Number') }}</label>
                                                <input type="text" id="contactNumber" class="form-control" value="{{$userData->Reg_Mobile}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="email" class="form-label me-3" style="min-width: 120px;">{{ translate('Email ID') }}</label>
                                                <input type="text" id="email" class="form-control" value="{{$userData->Email}}" readonly>
                                            </div>



                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="email" class="form-label me-3" style="min-width: 120px;">{{ translate('Active COD Cycle') }}</label>
                                                <input type="text" id="email" class="form-control" value="{{$userData->Cod_Rem}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="email" class="form-label me-3" style="min-width: 120px;">{{ translate('Billing Type') }}</label>
                                                <input type="text" id="email" class="form-control" value="{{$userData->Billing_Type}}" readonly>
                                            </div>


                                        </div>

                                        <!-- Right Column -->
                                        <div class="col-md-6">
                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="salesManagerName" class="form-label me-3" style="min-width: 140px;">{{ translate('Sales Manager Name') }}</label>
                                                <input type="text" id="salesManagerName" class="form-control" value="{{$userData->Client_poc}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="salesManagerNumber" class="form-label me-3" style="min-width: 140px;">{{ translate('Sales Manager Number') }}</label>
                                                <input type="text" id="salesManagerNumber" class="form-control" value="{{$userData->Poc_Mobile}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="keyAccountManager" class="form-label me-3" style="min-width: 140px;">{{ translate('Sales Manager Email') }}</label>
                                                <input type="text" id="keyAccountManager" class="form-control" value="{{$userData->Poc_Email}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="keyAccountManager" class="form-label me-3" style="min-width: 140px;">{{ translate('Key Account Manager') }}</label>
                                                <input type="text" id="keyAccountManager" class="form-control" value="{{$userData->Bd_Name}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="keyAccountManager" class="form-label me-3" style="min-width: 140px;">{{ translate('Key Account Manager Number') }}</label>
                                                <input type="text" id="keyAccountManager" class="form-control" value="{{$userData->Bd_Mobile}}" readonly>
                                            </div>

                                            <div class="mb-3 d-flex align-items-center">
                                                <label for="keyAccountManager" class="form-label me-3" style="min-width: 140px;">{{ translate('Key Account Manager Email Id') }}</label>
                                                <input type="text" id="keyAccountManager" class="form-control" value="{{$userData->Bd_mail}}" readonly>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-12 d-flex align-items-center">
                                                <label for="email" class="form-label me-12" style="min-width: 100px;">{{ translate('Location') }}</label>
                                                <input type="text" id="email" class="form-control" value="{{Auth::guard('web')->user()->Reg_Address}}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </section>


        </div>

    </div>



@endsection
