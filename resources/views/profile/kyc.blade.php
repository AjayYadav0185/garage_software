@extends('user.dashboard.layout.master')
@section('user-contant')
    <div class="main-content supreme-container">
        <section class="section " style="margin-top:-34px;">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">
                            <div class="card-header supreme-container" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;
                                            <h4 class="mb-0">{{ translate('Profile') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card-header">
                                <h4>Profile</h4>
                            </div> --}}
                            @if (session('alert'))
                                <div class="alert alert-warning">
                                    {{ session('alert') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="card-body">
                                <ul class="nav nav-pills id=" myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                            aria-controls="home" aria-selected="true">{{ translate('Personal Profile') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                            aria-controls="profile" aria-selected="false">{{ translate('Company Profile &
                                            KYC') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                            aria-controls="contact" aria-selected="false">{{ translate('Accont Details') }} </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <div class="card col-md-10 ">
                                            <div class="card-header">
                                                <h4>{{ translate('Personal Profile') }}</h4>
                                            </div>
                                            <div class="card-body">
                                                <form method="post" enctype="multipart/form-data" id="personal_profile">
                                                    {!! csrf_field() !!}
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('First Name') }}<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="first_name"
                                                                id="first_name" required=""
                                                                value="{{ $getUserData->first_name }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Last Name') }}</label>
                                                            <input type="text" class="form-control" name="last_name"
                                                                id="last_name" value="{{ $getUserData->last_name }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Mobile Number') }}<span class="text-danger">*</span></label>
                                                            <input type="text" name="Reg_Mobile" id="Reg_Mobile"
                                                                class="form-control contactvalid"
                                                                value="{{ $getUserData->Reg_Mobile ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Alt Mobile Number') }}</label>
                                                            <input type="text" class="form-control contactvalid"
                                                                name="Reg_Landline" id="Reg_Landline"
                                                                value="{{ $getUserData->Reg_Landline ?? '' }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ translate('Email ID') }}</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    @
                                                                </div>
                                                            </div>
                                                            <input type="email" name="Email" id="Email" class="form-control"
                                                                value="{{ $getUserData->Email }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{ translate('Address') }} <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="Reg_Address"
                                                            id="Reg_Address" required=""
                                                            value="{{ $getUserData->Reg_Address }}"
                                                            onKeyPress="if(this.value.length==60) return false;">
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('City') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="Reg_City"
                                                                id="Reg_City" required=""
                                                                value="{{ $getUserData->Reg_City }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('State') }}<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="Reg_State"
                                                                id="Reg_State" required=""
                                                                value="{{ $getUserData->Reg_State }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('Pincode') }}<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="Reg_Pin"
                                                                id="Reg_Pin" required="" value="{{ $getUserData->Reg_Pin }}"
                                                                onKeyPress="if(this.value.length==6) return false;">
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-outline-primary" name="submitfirst"
                                                        class="btn btn-primary mr-1" value="Update">
                                                    <!-- <a href="#" class="btn btn-outline-primary">submit</a> -->
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                        <div class="card col-md-10">
                                            <div class="card-header">
                                                <h4>{{ translate('Company Profile & KYC') }}</h4>
                                            </div>
                                            <form method="post" enctype="multipart/form-data" id="companyprofile">
                                                {!! csrf_field() !!}
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Type Of Company Profile') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control selectric" name="company_profile"
                                                                id="company_profile" required>
                                                                <option {{ $getUserData->company_profile == 'Propritor' ? 'selected' : '' }}>{{ translate('Propritor') }}</option>
                                                                <option {{ $getUserData->company_profile == 'Partnership' ? 'selected' : '' }}>{{ translate('Partnership') }}</option>
                                                                <option {{ $getUserData->company_profile == 'Public Limited Company' ? 'selected' : '' }}>{{ translate('Public Limited Company') }}
                                                                </option>
                                                                <option {{ $getUserData->company_profile == 'Limited Liability Partnership' ? 'selected' : '' }}>{{ translate('Limited Liability
                                                                    Partnership') }}</option>
                                                                <option {{ $getUserData->company_profile == 'Private Limited Company' ? 'selected' : '' }}>{{ translate('Private Limited Company') }}
                                                                </option>
                                                                <option {{ $getUserData->company_profile == 'Non GST' ? 'selected' : '' }}>{{ translate('Non GST') }}</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Agreement') }}</label><br>
                                                            <a href="{{ asset('RAPPIDX GLOBAL_USER AGREEMENT.pdf') }}"
                                                                class="btn btn-primary" target="_blank">
                                                                {{ translate('View Agreement') }}
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('TAX Number ') }}</label>
                                                            <input type="text" name="GST_No" id="GST_No"
                                                                class="form-control" value="{{ $getUserData->GST_No }}"
                                                                onKeyPress="if(this.value.length==15) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Upload GST') }}</label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input1" id="GST_cert"
                                                                    name="GST_cert" value="{{ $getUserData->GST_cert }}">
                                                                <label class="custom-file-label1" for="GST_cert"></label>
                                                                @php
                                                                    $userId = Auth::user()->User_Id;
                                                                @endphp
                                                                @if ($getUserData->GST_cert != '')
                                                                    <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->GST_cert) }}"
                                                                        class="btn btn-primary" target="_blank">{{ translate('View
                                                                        Doc') }}</a>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Pan Number') }}<span class="text-danger">*</span></label>
                                                            <input type="text" id="Pan" name="Pan" class="form-control"
                                                                required="" value="{{ $getUserData->Pan }}"
                                                                onKeyPress="if(this.value.length==10) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Upload PAN') }}<span class="text-danger">*</span></label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input1" id="Pancard"
                                                                    name="Pancard" required="">
                                                                <label class="custom-file-label1" for="Pancard"></label>
                                                                @if ($getUserData->Pancard != '')
                                                                    <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->Pancard) }}"
                                                                        class="btn btn-primary" target="_blank">{{ translate('View
                                                                        Doc') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Aadhar Number') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="aadhar_no" id="aadhar_no"
                                                                class="form-control" required=""
                                                                value="{{ $getUserData->aadhar_no }}"
                                                                onKeyPress="if(this.value.length==12) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Upload Aadhar') }}<span class="text-danger">*</span></label>
                                                            <div class="custom-file">
                                                                <!-- <input type="file" name="aadhar_card" id="aadhar_card"  class="custom-file-input" required=""> -->
                                                                <input type="file" name="aadhar_card" id="aadhar_card"
                                                                    class="custom-file-input1" required="">
                                                                <label class="custom-file-label1" for="aadhar_card"></label>
                                                                @if ($getUserData->aadhar_card != '')
                                                                    <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->aadhar_card) }}"
                                                                        class="btn btn-primary" target="_blank">{{ translate('View
                                                                        Doc') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Brand Name ') }}</label>
                                                            <input type="text" name="brand" id="brand" class="form-control"
                                                                value="{{ $getUserData->brand }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Website') }}</label>
                                                            <input type="text" name="Website" id="Website"
                                                                class="form-control" value="{{ $getUserData->Website }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Upload Logo') }}</label>
                                                            <div class="custom-file">
                                                                <input type="file" name="brand_logo" id="brand_logo"
                                                                    class="custom-file-input1">
                                                                <label class="custom-file-label1" for="brand_logo"></label>
                                                                @if ($getUserData->brand_logo != '')
                                                                    <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->brand_logo) }}"
                                                                        class="btn btn-primary" target="_blank">{{ translate('View
                                                                        Doc') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        {{-- <div class="form-group col-md-6">
                                                            <label>Aadhar Number <span class="text-danger">*</span></label>
                                                            <input type="text" name="aadhar_no" id="aadhar_no"
                                                                class="form-control" required=""
                                                                value="{{ $getUserData->aadhar_no }}"
                                                                onKeyPress="if(this.value.length==12) return false;">
                                                        </div> --}}
                                                        {{-- <div class="form-group col-md-6">
                                                            <label>Upload Agreement<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="custom-file">
                                                                <input type="file" name="agreement_doc" id="agreement_doc"
                                                                    class="custom-file-input1" required="">
                                                                <label class="custom-file-label1"
                                                                    for="agreement_doc"></label>
                                                                @if ($getUserData->agreement_doc != '')
                                                                <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->agreement_doc) }}"
                                                                    class="btn btn-primary" target="_blank">View
                                                                    Doc</a>
                                                                @endif
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="card-header">
                                                    <h5>{{ translate('Communication Address') }}</h5>
                                                </div>

                                                <div class="card-body">
                                                    {{-- <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Same as
                                                            Registered Address
                                                        </label>
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label>{{ translate('Address') }} </label>
                                                        <input type="text" class="form-control" name="Com_Address"
                                                            id="Com_Address" value="{{ $getUserData->Com_Address }}"
                                                            onKeyPress="if(this.value.length==60) return false;">
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('City') }} </label>
                                                            <input type="text" class="form-control" name="Com_City"
                                                                id="Com_City" value="{{ $getUserData->Com_City }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('State') }}</label>
                                                            <input type="text" class="form-control" name="Com_State"
                                                                id="Com_State" value="{{ $getUserData->Com_State }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('Pincode') }}</label>
                                                            <input type="text" class="form-control" name="Com_Pin"
                                                                id="Com_Pin" value="{{ $getUserData->Com_Pin }}"
                                                                onKeyPress="if(this.value.length==6) return false;">
                                                        </div>
                                                    </div>
                                                    <input type="submit" class="btn btn-outline-primary" name="submitsecond"
                                                        id="submitsecond" class="btn btn-primary mr-1" value="Update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                        <form method="post" enctype="multipart/form-data" id="bankprofile">
                                            {!! csrf_field() !!}
                                            <div class="card col-md-10">
                                                <div class="card-header">
                                                    <h4>{{ translate('Accont Details') }}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Beneficiary Name') }} <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" name="Beneficiaryname"
                                                                id="Beneficiaryname"
                                                                value="{{ $getUserData->Beneficiaryname }}" required=""
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Account Number') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="Bankaccount"
                                                                id="Bankaccount" value="{{ $getUserData->Bankaccount }}"
                                                                required=""
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('IFSC Code') }} <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="IFSC" id="IFSC"
                                                                value="{{ $getUserData->IFSC }}" required=""
                                                                onKeyPress="if(this.value.length==15) return false;">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Account Type') }} <span class="text-danger">*</span></label>
                                                            <select class="form-control" name="Acc_Type" id="Acc_Type"
                                                                required>
                                                                <option value="">{{ translate('Select Account Type') }}</option>
                                                                <option value="Saving" {{ $getUserData->Acc_Type == 'Saving' ? 'selected' : '' }}>{{ translate('Saving') }}</option>
                                                                <option value="Current" {{ $getUserData->Acc_Type == 'Current' ? 'selected' : '' }}>{{ translate('Current') }}</option>
                                                                {{-- <option value="OD" {{ $getUserData->Acc_Type == 'OD' ? 'selected' : '' }}>OD</option>
                                                                <option value="CC" {{ $getUserData->Acc_Type == 'CC' ? 'selected' : '' }}>CC</option> --}}
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label>{{ translate('Bank Name') }} </label>
                                                            <input type="text" class="form-control" name="Bankname"
                                                                id="Bankname" value="{{ $getUserData->Bankname }}"
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div>
                                                        {{-- <div class="form-group col-md-6">
                                                            <label>Branch <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="Branch"
                                                                id="Branch" value="{{ $getUserData->Branch }}" required=""
                                                                onKeyPress="if(this.value.length==30) return false;">
                                                        </div> --}}
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label>{{ translate('Upload Cancelled Cheque') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input1"
                                                                    name="Can_Cheque" id="Can_Cheque" required="">
                                                                <label class="custom-file-label1" for="customFile"></label>

                                                                <!-- value="{{ $getUserData->Can_Cheque }}" -->
                                                            </div>
                                                        </div>
                                                        @if ($getUserData->Can_Cheque != '')
                                                            <div class="form-group col-md-4 mb-4">
                                                                <a href="{{ asset('user/upload/docs/' . $userId . '/' . $getUserData->Can_Cheque) }}"
                                                                    class="btn btn-primary" target="_blank"
                                                                    style="margin-top: 36px;">{{ translate('View Cheque') }}</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <input type="submit" class="btn btn-outline-primary" name="submitthird2"
                                                        id="submitthird2" class="btn btn-primary mr-1" value="Update">
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        $(document).on('submit', '#personal_profile', function (e) {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: "personal_profile_update",
                data: $(this).serialize(),

                success: function (response) {

                    if (response.status == 'success') {
                        //alert(response.message);
                        //$('#add_courier1', current).attr('disabled', 'disabled');
                        Swal.fire({
                            icon: 'success',
                            title: response.message,

                        });

                        //window.location.reload();
                        toastr.success(response.message).delay(1000).fadeOut(1000);

                    } else if (response.status == 'error') {
                        Swal.fire({
                            icon: 'error',
                            title: response.message

                        });
                        toastr.error(response.message).delay(1000).fadeOut(1000);
                    } else if (response.status == 'exceptionError') {
                        CommonManager.forcelogout();
                    }
                },
            })
        });



        $(document).ready(function () {

            $('#submitsecond').click(function (e) {
                e.preventDefault();
                var formData = new FormData($('#companyprofile')[0]);
                $.ajax({
                    url: "{{ route('user.company_profile_update') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,

                        });
                        toastr.success(response.message).delay(1000).fadeOut(1000);
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: response.message,

                        });
                        toastr.error(response.message).delay(1000).fadeOut(1000);
                    }
                });
            });

            $('#submitthird2').click(function (e) {

                e.preventDefault();
                var formData = new FormData($('#bankprofile')[0]);
                $.ajax({
                    url: "{{ route('user.bank_profile_update') }}",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            toastr.success(response.message);
                        } else {

                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while processing your request. Please try again later.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });

            })

        });
    </script>
@endsection
