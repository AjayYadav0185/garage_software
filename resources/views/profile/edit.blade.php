@extends('user.dashboard.layout.master')
@section('user-contant')

@php
// Additional PHP code if needed
@endphp

<div class="main-content supreme-container">
    <section class="section" style="margin-top:-34px;">
        <div class="section-body">
            <div class="content-wrapper">
                <!-- Content Header -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="card-title">{{ translate('Edit Profile') }}</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">{{ translate('Home') }}</a></li>
                                    <li class="breadcrumb-item active">{{ translate('Profile') }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Content Section -->
                <section class="content">
                    <div class="row">
                        <!-- Profile Section (Left Column) -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ translate('Profile')}}</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Profile Picture -->
                                    <div class="form-group text-center">
                                        <img src="{{ asset(($user->img ?: 'default.png')) }}" id="imgPreview" class="img-radius" alt="User Image" style="width: 100px; border-radius: 15px; margin-bottom: 15px;">
                                        <br>
                                        <span class="badge badge-warning" style="font-size: 18px; font-weight: bold; color: #333;">{{ $user->g_name }}</span>
                                    </div>

                                    <!-- QR Code -->
                                    <div class="form-group text-center">
                                        <img src="{{ asset(($user->qrcode ?: 'default.png')) }}" id="qrcodePreview" class="img-radius" alt="QR Code" style="width: 100px; border-radius: 15px; margin-bottom: 10px;">
                                        <h6 class="text-center" style="font-size: 14px; color: #555;">{{ translate('QR Code') }}</h6>
                                    </div>

                                    <hr style="border-top: 1px dashed #ccc; margin: 10px 0;">

                                    <!-- Profile Details -->
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="contact" class="d-block" style="font-weight: 600;">{{ translate('Contact Number') }}:</label>
                                        <p>{{ $user->g_mob }}</p>
                                    </div>
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="gst" class="d-block" style="font-weight: 600;">{{ translate('TAX') }}:</label>
                                        <p>{{ $user->g_gst }}</p>
                                    </div>
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="email" class="d-block" style="font-weight: 600;">{{ translate('Email') }}:</label>
                                        <p>{{ $user->g_email }}</p>
                                    </div>
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="state" class="d-block" style="font-weight: 600;">{{ translate('State') }}:</label>
                                        <p>{{ $user->state ?: 'N/A' }}</p>
                                    </div>
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="city" class="d-block" style="font-weight: 600;">{{ translate('City') }}:</label>
                                        <p>{{ $user->city ?: 'N/A' }}</p>
                                    </div>
                                    <div class="form-group text-center" style="font-size: 14px; color: #444;">
                                        <label for="address" class="d-block" style="font-weight: 600;">{{ translate('Address') }}:</label>
                                        <p>{{ $user->g_address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile Section (Right Column) -->
                        <div class="col-md-8">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{ translate('Edit Details') }}</h3>
                                </div>
                                <div class="card-body">
                                    @if(session()->has('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    <form method="POST" action="{{ route('profile.updateProfile') }}" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Form Fields for Editing User Details -->
                                        <div class="form-group">
                                            <label for="g_name">{{ translate('Garage Name') }}</label>
                                            <input type="text" id="g_name" class="form-control" name="g_name" value="{{ old('g_name', $user->g_name) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="g_mob">{{ translate('Contact No') }}</label>
                                            <input type="number" id="g_mob" class="form-control" name="g_mob" value="{{ old('g_mob', $user->g_mob) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="g_gst">{{ translate('TAX No') }}</label>
                                            <input type="text" id="g_gst" class="form-control" name="g_gst" value="{{ old('g_gst', $user->g_gst) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="g_email">{{ translate('Email') }}</label>
                                            <input type="email" id="g_email" class="form-control" name="g_email" value="{{ old('g_email', $user->g_email) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="img">{{ translate('Upload Garage Logo') }}</label>
                                            <input type="file" id="img" class="form-control" name="img" onchange="previewImage(event, 'imgPreview')">
                                        </div>

                                        <div class="form-group">
                                            <label for="qrcode">{{ translate('Upload QR Code') }}</label>
                                            <input type="file" id="qrcode" class="form-control" name="qrcode" onchange="previewImage(event, 'qrcodePreview')">
                                        </div>

                                        <div class="form-group">
                                            <label for="stamp">{{ translate('Upload Garage Stamp') }}</label>
                                            <input type="file" id="stamp" class="form-control" name="stamp">
                                        </div>

                                        <div class="form-group">
                                            <label for="sign">{{ translate('Upload Signature') }}</label>
                                            <input type="file" id="sign" class="form-control" name="sign">
                                        </div>

                                        <div class="form-group">
                                            <label for="state">{{ translate('State') }}</label>
                                            <input type="text" id="state" class="form-control" name="state" value="{{ old('state', $user->state) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="city">{{ translate('City') }}</label>
                                            <input type="text" id="city" class="form-control" name="city" value="{{ old('city', $user->city) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="g_address">{{ translate('Address') }}</label>
                                            <input type="text" id="g_address" class="form-control" name="g_address" value="{{ old('g_address', $user->g_address) }}">
                                        </div>

                                        <div class="form-group d-flex justify-content-between">
                                            <button type="submit" class="btn btn-success">{{ translate('Save Changes') }}</button>
                                            <a href="#" class="btn btn-secondary">{{ translate('Cancel') }}</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
    // Preview the selected image
    function previewImage(event, previewId) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById(previewId);
            output.src = reader.result; // Update image src with the selected file
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
