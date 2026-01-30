@extends('user.dashboard.layout.master')

@section('user-contant')
    <style>
        #loaderOverlay img {
            animation: pulse 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <style>
        .downloading-text {
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .dots span {
            animation: blink 1.4s infinite both;
            font-size: 1.5rem;
        }

        .dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes blink {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        input::placeholder {
            font-size: 12px;
            /* color: #888; */
        }
    </style>
    <div class="loader" style="display:none;"></div>
    <div class="main-content supreme-container">
        {{-- <div id="loaderOverlay"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                                                         background-color: rgba(255, 255, 255, 0.7); z-index: 9999; text-align: center;">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="d-flex align-items-center gap-4">
                    <!-- Logo -->
                    <img src="https://rappidx.intileotech.com/wp-content/uploads/2024/06/logo-removebg-preview-21.png"
                        alt="Logo" style="height: 80px;" />
                    <!-- Animated Downloading Text -->
                    <div class="downloading-text">
                        Downloading<span class="dots"><span>.</span><span>.</span><span>.</span></span>
                    </div>
                </div>
            </div>
        </div> --}}
        <section class="section mt-3">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- Header -->
                            <div class="card-header py-3">
                                <div class="row align-items-center">
                                    <div class="col-sm-2 text-right">
                                        <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                            class="btn btn-primary go_forbtn"
                                            style="color:white;border-radius:5px;padding:0.3rem 0.8rem;"
                                            data-toggle="tooltip" title="Go Back">
                                            <i class="fa fa-arrow-left"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-10">
                                        <h4 class="mb-0">Serviceable Pincodes</h4>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="card-body px-4 py-4">
                                <!-- Search Input & Button -->
                                <div class="row mb-4">
                                    <div class="col-md-3 mb-3">
                                        <div class="input-group">
                                            <input type="text" id="pincode_input" class="form-control"
                                                placeholder="Enter Origin Pincode" maxlength="6" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4 align-items-center mb-3" style=" height: 36px; display: flex;">
                                        <a href="javascript:void(0);" class="btn btn-info btn-primary ml-md-3"
                                            style=" display: block;" id="serviceable_report">
                                            Zone Mapped Pincode
                                        </a>
                                        <a onclick="openBulkUploadModal('serviceable_pincode')"
                                            class="btn btn-info btn-primary ml-md-3" style=" display: block;"><i
                                                class="fa fa-cloud-upload" aria-hidden="true"></i>
                                            Bulk Upload
                                        </a>
                                    </div>
                                </div>

                                <!-- Pincode Input Fields -->
                                <div class="row mb-4">
                                    <input type="hidden" id="zonebtwn1">
                                    <input type="hidden" class="form-control" id="originpin-city" placeholder="Pickup City"
                                        readonly>
                                    <input type="hidden" class="form-control" id="originpin-state"
                                        placeholder="Pickup State" readonly>
                                    <input type="hidden" class="form-control" id="destinationpin-city"
                                        placeholder="Delivery City" readonly>
                                    <input type="hidden" class="form-control" id="destinationpin-state"
                                        placeholder="Delivery State" readonly>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label>Pickup- Pincode</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i data-feather="map-pin"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="originpincode" id="originpincode"
                                                    class="form-control phone-number" onblur="oripindetails(this.value)"
                                                    maxlength="6" placeholder="Origin Pincode">

                                                <input type="hidden" name="originpin-city" id="originpin-city">
                                                <input type="hidden" name="originpin-state" id="originpin-state">
                                                <input type="hidden" name="originpin-country" id="originpin-country">
                                            </div>
                                            <span class="text-center" style="color:#6777ef "
                                                id="originpin-state-show"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-group">
                                            <label>Delivery Pincode</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i data-feather="map-pin"></i>
                                                    </div>
                                                </div>
                                                <input type="text" name="destinationpincode" id="destinationpincode"
                                                    class="form-control phone-number" onblur="despindetails(this.value)"
                                                    maxlength="6" placeholder="Destination Pincode">
                                                <input type="hidden" name="destinationpin-city" id="destinationpin-city">
                                                <input type="hidden" name="destinationpin-state"
                                                    id="destinationpin-state">
                                                <input type="hidden" name="destinationpin-country"
                                                    id="destinationpin-country">

                                                <input type="hidden" name="distancebtwn" id="distancebtwn">
                                                <input type="hidden" name="distancebtwnkm" id="distancebtwnkm">
                                                <input type="hidden" name="distancebtwntype" id="distancebtwntype">
                                            </div>
                                            <span class="text-center" style="color:#6777ef "
                                                id="destinationpin-state-show"></span>
                                        </div>
                                    </div>
                                    <!-- Get Data Button -->
                                    <div class="col-md-4">
                                        <a class="btn btn-primary" onclick="calculateraterefresh()"
                                            style="height: 35px; margin-top: 25px;"><i class="fa fa-rss-square"
                                                aria-hidden="true"></i> Get
                                            Data</a>
                                    </div>
                                </div>



                                <div class="col-lg-12" id="rate_calcule_amountsdiv" style="display: none;">
                                    <div class="rate_cal_shadow_css">
                                        {{-- <div class="row p-3">
                                            <div class="col-md-6" style="color: blue;text-align:left;">
                                                <strong>Pickup Pincode: <span id="pikcuppinno" style="color: black;">
                                                        <span></strong> <br>
                                            </div>
                                            <div class="col-md-6" style="color: blue;text-align:right;">
                                                <strong>Destination Pincode : <span id="destinpinno" style="color: black;">
                                                        <span> </strong><br>
                                            </div>
                                        </div> --}}
                                        <div id="b2c_calculate_list">B2C estimate couries loading...</div>
                                    </div>
                                    {{-- <p class=""><span style="color:blue">*</span>GST Additional</p> --}}
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div id="All_Records"></div>
                                    </div>
                                </div>
                            </div> <!-- card-body -->
                        </div> <!-- card -->
                    </div> <!-- col-12 -->
                </div> <!-- row -->
            </div> <!-- section-body -->
        </section>
    </div>

    <script type="text/javascript">
        function data_return() {

            oripin = $("#originpincode").val();
            destinpin = $("#destinationpincode").val();
            zone = $("#zonebtwn1").val();
            html = '';
            paymode = $("#paymentmode").val();
            prodamt = $("#valueininr").val();
            order_type = $("#order_type").val();
            freightWeightare = $("#FreightWeightare").val();

            if (oripin === '' || destinpin === '') {
                alert("Both origin and destination pincodes are required.");
                return false;
            }



            let pinRegex = /^\d{6}$/;

            if (!pinRegex.test(oripin)) {
                alert("Origin pincode is invalid. It should be a 6-digit number.");
                return false;
            }

            if (!pinRegex.test(destinpin)) {
                alert("Destination pincode is invalid. It should be a 6-digit number.");
                return false;
            }
            $.ajax({
                type: "GET",
                url: 'zonemap',
                data: {
                    param: zone,
                    paymode: paymode,
                    prodamt: prodamt,
                    freightWeightare: freightWeightare,
                    order_type: order_type,
                    oripin: oripin,
                    destinpin: destinpin
                },
                success: function(data) {
                    // data = isJson(data) ? JSON.parse(data) : data;

                    $("#rate_calcule_amountsdiv").css({
                        'display': 'block'
                    });
                    $("#Export").css({
                        'display': 'block'
                    });
                    $("#b2c_calculate_list").html(data.html);
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#serviceable_report', function() {
            const pincode = $('#pincode_input').val().trim();
            if (pincode === '') {
                alert("origin pincode is required.");
            } else {
                if (pincode.length == 6) {
                    let pinRegex = /^\d{6}$/;
                    if (!pinRegex.test(pincode)) {
                        alert("Origin pincode is invalid. It should be a 6-digit number.");
                        return false;
                    }
                    $('.loader').show();
                    $('#serviceable_report').prop('disabled', true).text('Downloading...');
                    $.ajax({
                        url: "{{ route('user.export-serviceable-pin') }}",
                        type: "GET",
                        data: {
                            pincode: pincode
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(data, status, xhr) {
                            const filename = xhr.getResponseHeader('Content-Disposition')?.split(
                                'filename=')[1] || 'serviceable-pincodes.xlsx';
                            const blob = new Blob([data], {
                                type: xhr.getResponseHeader('Content-Type')
                            });
                            const link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = filename.replaceAll('"', '');
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        },
                        error: function(xhr) {
                            console.error('Download error', xhr);
                            alert('Error downloading file.');
                        },
                        complete: function() {
                            $('.loader').hide();
                            $('#serviceable_report').prop('disabled', false).text('Download Report');
                        }
                    });
                } else {

                }
            }
        });
    </script>
@endsection
