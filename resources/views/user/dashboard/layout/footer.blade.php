

<footer class="main-footer">
    
  <!-- <strong>&copy; 2025 <a href="http://otodigital.in/">OTODIGITAL TECHNOLOGIES PVT LTD.</a></strong> All rights reserved. -->
    {{-- <div class="footer-left">
        <h6>Copyright © All Rights Reserved - © 2025 OTODIGITAL TECHNOLOGIES PVT LTD</h6>
    </div>
    <div class="footer-right">
        <h6 style="color: #0052DF;  font-family: Poppins, Sans-serif; font-size: 16px; font-weight: 400;">
            <a href="#">Terms & Condition</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="#">Refund policy</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <a href="#">Privacy policy</a>&nbsp;
        </h6>
    </div> --}}
</footer>

</div>
</div>
<!-- recharge model  -->
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="exampleModalLabel"><b>Recharge Your Wallet</b> </h5>

                    <h6 style="margin-top: 10px;">Current Balance : {{getWalletAmt(Auth::user()->User_Id)}}</h6>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div> --}}

            <div class="modal-body " style="padding: 0px !important;">
                <?php
                $oid = 'RPWLN' . rand(1000000, 999999999);
                ?>


                {{-- <div class="container container-custom py-4"> --}}
                <div class="row">


                    <div class="col-lg-12 col-md-12 col-12 left-section p-3">

                        <form id="payment-form" method="POST">
                            @csrf
                            {{-- <input type="hidden" id="ORDER_ID" name="ORDER_ID" value="{{ $oid }}">
                                <input type="hidden" id="CUST_ID" name="CUST_ID" value="1234">
                                <input type="hidden" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" value="123">
                                <input type="hidden" id="CHANNEL_ID" name="CHANNEL_ID" value="WEB">
                                <input type="hidden" id="MID" name="MID" value="SbGbUZ15376909217929">
                                <div id='checksum'></div>
                                <input type="hidden" name="CALLBACK_URL" value="http://127.0.0.1:8000/paytm-callback">
                                <input type="hidden" name="WEBSITE" value="WEBSTAGING"> --}}
                            <h3 style="color: #985FC4; font-size:14px;"><strong>Recharge Your Wallet</strong></h3>
                            <p>Current Wallet Amount: <span id="walletBalance"
                                    style="color: #61bf9e; font-weight: 700;"> {{currency_symbol()}}</span></p>
                            <div class="bottom-section" style="background-color: #d4feef;">
                                <p style="font-size:15px;">Enter the amount to recharge</p>
                                <div class="input-group">
                                    <span class="input-group-text"
                                        style="color: aliceblue; background-color: #bbbbbb;"><strong>{{currency_symbol()}}</strong></span>
                                    <input type="text" id="rechargeAmount" value="1" name="amount"
                                        class="form-control" min="500" max="500000"
                                        placeholder="Minimum Recharge {{currency_symbol()}}500" oninput="updateAmount()">
                                </div>
                                <p class="text-muted" style="font-size: 12px;">Min value: {{currency_symbol()}}500 & Max value:
                                    {{currency_symbol()}}5,00,000
                                </p>
                                <span id="error-message" class="text-danger"></span>
                                <p class="mt-3" style="font-size:15px;">Select an amount from below to quick
                                    recharge
                                </p>
                                <div>
                                    <button type="button" class="btn btn-outline-dark amount-btn"
                                        style="font-size: 10px;" onclick="setAmount(500)">{{currency_symbol()}} 500</button>
                                    <button type="button" class="btn btn-outline-dark amount-btn"
                                        style="font-size: 10px;" onclick="setAmount(2000)">{{currency_symbol()}} 2000</button>
                                    <button type="button" class="btn btn-outline-dark amount-btn"
                                        style="font-size: 10px;" onclick="setAmount(5000)">{{currency_symbol()}} 5000</button>
                                    <button type="button" class="btn btn-outline-dark amount-btn"
                                        style="font-size: 10px;" onclick="setAmount(10000)">{{currency_symbol()}} 10000</button>
                                </div>



                            </div>

                            <div class="bottom-section" style="background-color: #d4fef8">

                                <div class="form-group mb-2">
                                    <p class="mt-3" style="font-size:14px;">Enter your coupon code below to redeem</p>
                                    <div class="input-group">
                                        <input type="text" id="rechargeAmount" name="TXN_AMOUNT" class="form-control"
                                            placeholder="Enter coupon code">
                                        <button class="btn" type="button"
                                            style="background-color: #bbbbbb; color: #000000; height: 100%;">Apply
                                            Now</button>
                                    </div>
                                </div>




                                <div class="form-group" style="margin-bottom: 0px !important;">
                                    <div class="input-group">
                                        {{-- <input type="text" id="rechargeAmount" name="TXN_AMOUNT"
                                                class="form-control" placeholder="Enter coupon code"> --}}
                                        <select name="" id="" class="form-control">
                                            <option value="">View Available Coupon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="bottom-section p-3" style="background-color: #d4fcfe;">
                                <div class="d-flex justify-content-between">
                                    <p>Recharge Amount:</p>
                                    <p>{{currency_symbol()}} <span id="displayRecharge">0</span></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Wallet Cashback:</p>
                                    <p>{{currency_symbol()}} <span id="displayCashback">0</span></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p>Payable Amount:</p>
                                    <p>{{currency_symbol()}} <span id="displayPayable">0</span></p>
                                </div>
                            </div>

                            <style>
                                p,
                                ul:not(.list-unstyled),
                                ol {
                                    line-height: 15px;
                                }
                            </style>
                            <br>
                            <div class="d-flex justify-content-end">
                                {{-- <button class="btn btn-outline-dark" id="close-btn">Cancel</button> --}}
                                &nbsp;<button type="submit" class="btn" style="background-color: #FFFF00;"
                                    id="payment_form_click">Continue to Payment</button>
                            </div>
                        </form>
                    </div>


                    {{-- <div class="col-lg-3 col-md-6 col-12 right-section text-center d-flex">
                            <img src="{{asset('man-talking-mobile.jpg')}}" alt="Logo" class="img-fluid mb-2">
                        </div> --}}
                </div>
                {{--
                </div> --}}

                {{-- <form id="payment-form" action="https://securegw.paytm.in/theia/processTransaction" method="POST"
                    target="_blank">

                    <input type="hidden" id="ORDER_ID" name="ORDER_ID" value="{{$oid}}">
                    <input type="hidden" id="CUST_ID" name="CUST_ID" value="1234">
                    <input type="hidden" id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" value="123">
                    <input type="hidden" id="CHANNEL_ID" name="CHANNEL_ID" value="WEB">
                    <input type="hidden" id="MID" name="MID" value="SbGbUZ15376909217929">
                    <div id='checksum'></div>
                    <input type="hidden" name="CALLBACK_URL" value="
                    http://127.0.0.1:8000/paytm-callback">
                    <input type="hidden" name="WEBSITE" value="DEFAULT">

                    <h6>Enter the amount below to recharge</h6>
                    <div class="text-center ">
                        <div class="row my-4">
                            <div class="col-md-4 my-1">
                                <p> <strong>Enter Amount</strong> </p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{{currency_symbol()}}" class="form-control"
                                    style="border-color:#33333373;border-radius:20px" value="1" name="TXN_AMOUNT"
                                    id="first-name" placeholder="0.0">

                            </div>
                            <div class="col-md-3"></div>

                        </div>
                        <p> <strong>Or Select from below</strong> </p>
                        <div class="text-center my-3">
                            <a href="#" class="btn btn-primary badge button12">500</i></a>
                            <a href="#" class="btn btn-primary badge button12">1000</i></a>
                            <a href="#" class="btn btn-primary badge button12">2000</i></a>
                            <a href="#" class="btn btn-primary badge button12">5000</i></a>
                            <a href="#" class="btn btn-primary badge button12">10000</i></a>
                        </div>

                        <button type="button" class="btn btn-info" id="payment_form_click"
                            style="border-radius:20px">Recharge</button>
                    </div>
                </form> --}}

            </div>

        </div>
    </div>
</div>
{{--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

<script>
    function setAmount(amount) {
        if (amount < 500 || amount > 500000) {
            document.getElementById('error-message').textContent = "Amount should be between {{currency_symbol()}}500 and {{currency_symbol()}}500000.";
            return;
        } else {
            document.getElementById('error-message').textContent = "";
        }
        document.getElementById('rechargeAmount').value = amount;
        document.getElementById('displayRecharge').textContent = amount;
        document.getElementById('displayPayable').textContent = amount;
    }

    function updateAmount() {
        let amount = document.getElementById('rechargeAmount').value;
        if (amount < 500 || amount > 500000) {
            document.getElementById('error-message').textContent = "Amount should be between {{currency_symbol()}}500 and {{currency_symbol()}}500000.";
            document.getElementById('displayRecharge').textContent = 0;
            document.getElementById('displayPayable').textContent = 0;
        } else {
            document.getElementById('error-message').textContent = "";
            document.getElementById('displayRecharge').textContent = amount;
            document.getElementById('displayPayable').textContent = amount;
        }
    }

    function processPayment() {
        let amount = document.getElementById('rechargeAmount').value;
        if (amount >= 500 && amount <= 500000) {
            alert("Proceeding to payment of {{currency_symbol()}}" + amount);
        } else {
            alert("Please enter a valid recharge amount between {{currency_symbol()}}500 and {{currency_symbol()}}500000.");
        }
    }
</script>

<script>
    $('#close-btn').on('click', function() {
        // alert('Hello');
        window.location.reload();
    });
    $("#nav a").click(function(e) {
        e.preventDefault();
        $(".toggle").hide();
        var toShow = $(this).attr('href');
        $(toShow).show();
    });
</script>

<script>
    $(".button12").click(function() {
        $rchr = $(this).text();
        $("#first-name").val($rchr);

    });
</script>

<script>
    $(".rchrg").on("click", function() {
        $rchcoupn = $(this).text();

        $("#first-name").val($rchcoupn);
    });
</script>

{{--
<script type="text/javascript">
    $(document).ready(function () {
        $('body').on('click', '#payment_form_click', function (e) {
            e.preventDefault();
            var form = $('#payment-form');
            $.ajax({
                type: "POST",
                url: "#",
                data: form.serialize(),
                dataType: "json",
                success: function (data) {
                    console.log('Paytm Payment Initiate Response:', data);

                    var config = {
                        "root": "",
                        "flow": "DEFAULT",
                        "data": {
                            "orderId": data.orderId,
                            "token": data.txnToken,
                            "tokenType": "TXN_TOKEN",
                            "amount": data.amount
                        },
                        "handler": {
                            "notifyMerchant": function (eventName, data) {
                                console.log("Paytm Event: " + eventName, data);
                            }
                        }
                    };

                    if (window.Paytm && window.Paytm.CheckoutJS) {
                        Paytm.CheckoutJS.init(config).then(function onSuccess() {
                            Paytm.CheckoutJS.invoke();
                        }).catch(function onError(error) {
                            console.log("Paytm Error => ", error);
                        });
                    }
                }
            });
            //document.getElementById("payment_form").submit();
            //$('#payment_form').trigger('submit');


        });
    });
</script> --}}
<script type="application/javascript" crossorigin="anonymous"
    src="https://securegw-stage.paytm.in/merchantpgpui/checkoutjs/merchants/{{ env('PAYTM_MERCHANT_ID') }}.js"></script>

{{-- <script type="application/javascript" crossorigin="anonymous"
    src="https://securegw.paytm.in/merchantpgpui/checkoutjs/merchants/{{ env('PAYTM_MERCHANT_ID') }}.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        $('body').on('click', '#payment_form_click', function(e) {
            e.preventDefault();

            var form = $('#payment-form');

            $.ajax({
                type: "POST",
                url: "#",
                data: form.serialize(),
                dataType: "json",
                success: function(data) {
                    console.log('Paytm Payment Initiate Response:', data);

                    var config = {
                        "root": "",
                        "flow": "DEFAULT",
                        "data": {
                            "orderId": data.orderId,
                            "token": data.txnToken,
                            "tokenType": "TXN_TOKEN",
                            "amount": data.amount
                        },
                        "handler": {
                            "notifyMerchant": function(eventName, data) {
                                console.log("Paytm Event:", eventName, data);
                            }
                        }
                    };

                    if (window.Paytm && window.Paytm.CheckoutJS) {
                        window.Paytm.CheckoutJS.init(config).then(function onSuccess() {
                            window.Paytm.CheckoutJS.invoke();
                        }).catch(function onError(error) {
                            console.log("Paytm CheckoutJS Error:", error);
                        });
                    } else {
                        console.log("Paytm CheckoutJS library not loaded.");
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", xhr.responseText);
                }
            });
        });
    });
</script>



<script src="{{ asset('user/assets/js/app.min.js') }}"></script>

<script src="{{ asset('user/assets/js/app.min.js') }}"></script>

<script src="{{ asset('js/jquery.min.js') }}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        $jq('#dataTable').DataTable();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#reportrange span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#reportrange').on('apply.daterangepicker', function(ev, picker) {


            $('#dashfromdate').val(picker.startDate.format('YYYY-MM-DD'));
            $('#dashfromdate').val(picker.endDate.format('YYYY-MM-DD'));

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchFilteredData1(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            var fromDate = $('#dashfromdate').val();
            var toDate = $('#dashtodate').val();

            $jq.ajax({

                url: "#",
                type: "GET",
                data: {
                    start_date: fromDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    console.log(response);

                    let newChartLabels = response.weightlabels;
                    let newChartData = response.weightdata;

                    chartLabels = newChartLabels;
                    chartData = newChartData;

                    myChart.data.labels = chartLabels;
                    myChart.data.datasets[0].data = chartData;

                    myChart.update();


                    let volumeLabels = response.volumelabels;
                    let volumeChartData = response.volumedata;

                    volumeChartLabels = volumeLabels;
                    volumechartData = volumeChartData;

                    myChart1.data.labels = volumeChartLabels;
                    myChart1.data.datasets[0].data = volumechartData;

                    myChart1.update();

                    if (response.performanceLabels && response.performanceData) {
                        const performanceLabelsChartLabels = response.performanceLabels;
                        const performanceDataChartData = response.performanceData;

                        myChart2.data.labels = performanceLabelsChartLabels;
                        myChart2.data.datasets[0].data = performanceDataChartData;

                        myChart2.update();
                    }


                }

            });

        }


        function fetchFilteredData1(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    var totalShipmentData = response.totalShipmentData;

                    if (totalShipmentData) {

                        $('#shipmentDataTable').html(
                            '<tr class="text-center">' +
                            '<td>' + (totalShipmentData.total_shipment || 0) + '</td>' +
                            '<td>' + (totalShipmentData.total_pending || 0) + '</td>' +
                            '<td>' + (totalShipmentData.total_delivered || 0) + '</td>' +
                            '<td>' + (totalShipmentData.total_transit || 0) + '</td>' +
                            '<td>' + (totalShipmentData.total_rto || 0) + '</td>' +
                            '<td>' + (totalShipmentData.NDR || 0) + '</td>' +
                            '</tr>'
                        );

                    }

                    var totalcodData = response.totalcodData;
                    if (totalcodData) {

                        $('#codstatus').html(
                            '<tr class="text-center">' +
                            '<td>' + (totalcodData.total_shipment || 0) + '</td>' +
                            '<td>' + (totalcodData.total_shipment || 0) + '</td>' +
                            '<td>' + (totalcodData.total_shipment || 0) + '</td>' +
                            '<td>' + (totalcodData.total_shipment || 0) + '</td>' +
                            '</tr>'
                        );

                    }

                    var totalrevenueData = response.totalrevenueData;

                    if (totalrevenueData) {

                        $('#revenuetable').html(
                            '<tr class="text-center">' +
                            '<td>' + ((totalrevenueData.total_cod_amount || 0) + (
                                totalrevenueData.total_prepaid_amount || 0)) + '</td>' +
                            '<td>' + (totalrevenueData.total_cod_amount || 0) + '</td>' +
                            '<td>' + (totalrevenueData.total_prepaid_amount || 0) + '</td>' +
                            '</tr>'
                        );

                    }

                    var querydata = response.querydata;

                    if (querydata) {

                        $('#treandandanalytics').empty();

                        querydata.forEach(function(row) {
                            $('#treandandanalytics').append(
                                '<tr class="text-center">' +
                                '<td>' + (row.courier_name || '') + '</td>' +
                                '<td>' + (row.count || 0) + '</td>' +
                                '<td>' + (row.delivered || 0) + '</td>' +
                                '<td>' + (row.rto_delivered || 0) + '</td>' +
                                '<td>' + (row.rto_undelivered || 0) + '</td>' +
                                '<td>' + (row.pending || 0) + '</td>' +
                                '</tr>'
                            );
                        });
                    }
                    var totaldelhivery = response.totaldelhivery;

                    if (totaldelhivery) {

                        $('#courierwiselead').empty();

                        totaldelhivery.forEach(function(data) {
                            var html = `
                        <div class="col-xl-2 col-lg-2 mb-4">
                            <div class="progress rounded-circle" data-value="${data.count}">
                                <span class="progress-left">
                                    <span class="progress-bar ${data.graph_color}"></span>
                                </span>
                                <span class="progress-right">
                                    <span class="progress-bar ${data.graph_color}"></span>
                                </span>
                                <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h5 font-weight-bold">${data.count}<sup class="small">%</sup></div>
                                </div>
                            </div>
                            <div class="h6 font-weight-bold p-2">${data.courier_name}</div>
                        </div>
                    `;
                            $('#courierwiselead').append(html);
                        });


                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


    });
</script>


<script>
    $(document).ready(function() {
        var $jq = jQuery.noConflict();

        // Initialize daterangepicker with default last 30 days
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            var startDate = start.format('YYYY-MM-DD');
            var endDate = end.format('YYYY-MM-DD');

            // Display selected range in your daterangepicker span
            $jq('#alldate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
            // Set values in your inputs
            $('.dashfromdate').val(startDate);
            $('.dashtodate').val(endDate);

            // Call all data loading functions with updated dates
            check(startDate, endDate);
            checkWeightTrend(startDate, endDate);
            checkVolumeTrend(startDate, endDate);
            loadCourierSplit(startDate, endDate);
            loadDeliveryPerformance(startDate, endDate);
            loadMyChart3(startDate, endDate);
            loadMyChart1(startDate, endDate);
            loadTatChart(startDate, endDate);
        }

        $jq('#alldate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        // Set initial date values and call data loading functions
        cb(start, end);

        // Listen to daterangepicker apply event
        $jq('#alldate').on('apply.daterangepicker', function(ev, picker) {
            var selectedStart = picker.startDate.format('YYYY-MM-DD');
            var selectedEnd = picker.endDate.format('YYYY-MM-DD');

            $('.dashfromdate').val(selectedStart);
            $('.dashtodate').val(selectedEnd);

            check(selectedStart, selectedEnd);
            checkWeightTrend(selectedStart, selectedEnd);
            checkVolumeTrend(selectedStart, selectedEnd);
            loadCourierSplit(selectedStart, selectedEnd);
            loadDeliveryPerformance(selectedStart, selectedEnd);
            loadMyChart3(selectedStart, selectedEnd);
            loadMyChart1(selectedStart, selectedEnd);
            loadTatChart(selectedStart, selectedEnd);
        });

        // Optional: If user manually changes date input fields
        $('.dashfromdate, .dashtodate').on('change', function() {
            var fromDate = $('.dashfromdate').val();
            var toDate = $('.dashtodate').val();

            check(fromDate, toDate);
            checkWeightTrend(fromDate, toDate);
            checkVolumeTrend(fromDate, toDate);
            loadCourierSplit(fromDate, toDate);
            loadDeliveryPerformance(fromDate, toDate);
            loadMyChart3(fromDate, toDate);
            loadMyChart1(fromDate, toDate);
            loadTatChart(fromDate, toDate);
        });
    });



    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        $jq('#dataTable').DataTable();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#Overalldate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#Overalldate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#Overalldate').on('apply.daterangepicker', function(ev, picker) {

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'overall'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    window.overalltable.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


    });



    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#zonedate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#zonedate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#zonedate').on('apply.daterangepicker', function(ev, picker) {

            fetchzonedateData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchzonedateChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchzonedateData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'Zonnewisedata'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    //  alert('Calling Satate wise');
                    window.Zonnewisedata.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchzonedateChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart5'
                },
                success: function(response) {
                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    const myChart5ChartLabels = response.data.map(value => value.toFixed(2));;
                    const myChart5DataChartData = myChart5ChartLabels.reduce((acc, value) => acc +
                        parseFloat(value), 0).toFixed(2);

                    if (myChart5 && myChart5.data && myChart5.data.datasets && myChart5.data
                        .datasets.length > 0) {
                        myChart5.data.labels = myChart5ChartLabels;
                        myChart5.data.datasets[0].data = myChart5DataChartData;
                        myChart5.update();
                    }
                    myChart5.update();
                    loadChartData().reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

    });



    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#statewise span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#statewise').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#statewise').on('apply.daterangepicker', function(ev, picker) {
            const formattedStart = picker.startDate.format('YYYY-MM-DD');
            const formattedEnd = picker.endDate.format('YYYY-MM-DD');

            fetchStatewiseData(formattedStart, formattedEnd);
            fetchStatewiseChartData(formattedStart, formattedEnd);
        });

        function fetchStatewiseData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'statewise'
                },
                success: function(response) {
                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    if (window.statewisedata && window.statewisedata.ajax) {
                        window.statewisedata.ajax.reload();
                    }
                },
                error: function(error) {
                    console.error('Error fetching statewise data:', error);
                }
            });
        }

        function fetchStatewiseChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'statewisechart'
                },
                success: function(response) {
                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    const chartLabels = response.labels || [];
                    const chartData = response.data.map(value => parseFloat(value.toFixed(2)));

                    if (window.myChart5 && window.myChart5.data && window.myChart5.data.datasets
                        .length > 0) {
                        window.myChart5.data.labels = chartLabels;
                        window.myChart5.data.datasets[0].data = chartData;
                        window.myChart5.update();
                    }

                    if (typeof loadStatewiseNewChart === 'function') {
                        loadStatewiseNewChart().reload();
                    }
                },
                error: function(error) {
                    console.error('Error fetching statewise chart data:', error);
                }
            });
        }

    });


    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#courierDate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#courierDate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#courierDate').on('apply.daterangepicker', function(ev, picker) {
            fetchstatewiseData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchAllocationChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchStatus1ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchStatus2ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchstatewiseData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'courierwisedata'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    //  alert('Calling Satate wise');
                    window.courierwisedata.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchAllocationChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart6'
                },
                success: function(response) {
                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    if (typeof loadMyChart6 === 'function') {
                        loadMyChart6().reload();
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


        function fetchStatus1ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart7'
                },
                success: function(response) {
                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    if (typeof loadMyChart7 === 'function') {
                        loadMyChart7().reload();
                    }
                    const myChart7ChartLabels = response.details;
                    const myChart7DataChartData = response.labels;

                    if (myChart7 && myChart7.data && myChart7.data.datasets && myChart7.data
                        .datasets.length > 0) {

                        myChart7.data.labels = myChart7ChartLabels;
                        myChart7.data.datasets[0].data = myChart7DataChartData;

                        myChart7.update();
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchStatus2ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart8'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    const myChart8ChartLabels = response.data.map(value => value.toFixed(2));;
                    const myChart8DataChartData = myChart8ChartLabels.reduce((acc, value) => acc +
                        parseFloat(value), 0).toFixed(2);

                    if (myChart8 && myChart8.data && myChart8.data.datasets && myChart8.data
                        .datasets.length > 0) {

                        myChart8.data.labels = myChart8ChartLabels;
                        myChart8.data.datasets[0].data = myChart8DataChartData;

                        myChart8.update();
                    }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


    });


    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#productdate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#productdate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#productdate').on('apply.daterangepicker', function(ev, picker) {

            fetchstatewiseData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchproductChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchstatewiseData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'productwisedata'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    //  alert('Calling Satate wise');
                    window.productwisedata.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchproductChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart9'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    if (typeof loadMyChart9 === 'function') {
                        loadMyChart9().reload();
                    }

                    // const myChart9ChartLabels = response.data.map(value => value.toFixed(2));;
                    // const myChart9DataChartData = myChart9ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);

                    // if (myChart9 && myChart9.data && myChart9.data.datasets && myChart9.data
                    //     .datasets.length > 0) {

                    //     myChart9.data.labels = myChart9ChartLabels;
                    //     myChart9.data.datasets[0].data = myChart9DataChartData;

                    //     myChart9.update();
                    // }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

    });

    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#volumedate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#volumedate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#volumedate').on('apply.daterangepicker', function(ev, picker) {

            fetchstatewiseData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchmyChart10ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchmyChart11ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchmyChart12ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchmyChart13ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
            fetchmyChart14ChartData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchstatewiseData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'volumetreanddata'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    //  alert('Calling Satate wise');
                    window.volumetreanddata.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchmyChart10ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart10'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    if (typeof loadMyChart9 === 'function') {
                        loadMyChart9().reload();
                    }

                    // const myChart10ChartLabels = response.data.map(value => value.toFixed(2));;
                    // const myChart10DataChartData = myChart10ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);

                    // if (myChart10 && myChart10.data && myChart10.data.datasets && myChart10.data
                    //     .datasets.length > 0) {

                    //     myChart10.data.labels = myChart10ChartLabels;
                    //     myChart10.data.datasets[0].data = myChart10DataChartData;

                    //     myChart10.update();
                    // }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchmyChart11ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart11'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    if (typeof loadMyChart9 === 'function') {
                        loadMyChart11().reload();
                    }

                    // const myChart11ChartLabels = response.data.map(value => value.toFixed(2));;
                    // const myChart11DataChartData = myChart11ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);

                    // if (myChart11 && myChart11.data && myChart11.data.datasets && myChart11.data
                    //     .datasets.length > 0) {

                    //     myChart11.data.labels = myChart11ChartLabels;
                    //     myChart11.data.datasets[0].data = myChart11DataChartData;

                    //     myChart11.update();
                    // }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchmyChart12ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart12'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    // const myChart12ChartLabels = response.data.map(value => value.toFixed(2));;
                    // const myChart12DataChartData = myChart12ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);

                    // if (myChart12 && myChart12.data && myChart12.data.datasets && myChart12.data
                    //     .datasets.length > 0) {

                    //     myChart12.data.labels = myChart12ChartLabels;
                    //     myChart12.data.datasets[0].data = myChart12DataChartData;

                    //     myChart12.update();
                    // }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


        function fetchmyChart13ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart13'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    // const myChart13ChartLabels = response.data.map(value => value.toFixed(2));;
                    // const myChart13DataChartData = myChart13ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);

                    // if (myChart13 && myChart13.data && myChart13.data.datasets && myChart13.data
                    //     .datasets.length > 0) {

                    //     myChart13.data.labels = myChart13ChartLabels;
                    //     myChart13.data.datasets[0].data = myChart13DataChartData;

                    //     myChart13.update();
                    // }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        function fetchmyChart14ChartData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'myChart14'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);

                    // const myChart14ChartLabels =response.data.map(value => parseFloat(value.toFixed(2)));
                    // const myChart14DataChartData = myChart14ChartLabels.reduce((acc, value) => acc +
                    //     parseFloat(value), 0).toFixed(2);


                    const volumedatadData14 = response.data.map(value => parseFloat(value.toFixed(
                        2)));
                    const totalvolume14 = volumedatadData14.reduce((acc, value) => acc + value, 0)
                        .toFixed(2);

                    if (myChart14 && myChart14.data && myChart14.data.datasets && myChart14.data
                        .datasets.length > 0) {

                        myChart14.data.labels = volumedatadData14;
                        myChart14.data.datasets[0].data = totalvolume14;

                        myChart14.update();
                    }


                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


    });

    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#surfacedate span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#surfacedate').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#surfacedate').on('apply.daterangepicker', function(ev, picker) {

            fetchstatewiseData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchstatewiseData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}',
                    type: 'surfacetreanddata,Airtat,ShipmentProgress'
                },
                success: function(response) {

                    $('.overallfrom').val(startDate);
                    $('.overallto').val(endDate);
                    //  alert('Calling Satate wise');
                    window.surfacetreanddata.ajax.reload();
                    window.Airtat.ajax.reload();
                    window.ShipmentProgress.ajax.reload();

                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

    });

    $(document).ready(function() {

        var $jq = jQuery.noConflict();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#reportrange3 span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#reportrange3').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#reportrange3').on('apply.daterangepicker', function(ev, picker) {

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                'YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            $jq.ajax({
                url: '#',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {




                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        }


    });
</script>

{{-- <!-- JS Libraies --> --}}
<script src="{{ asset('user/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('user/assets/js/page/index.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('user/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->

<script
    src="https://jqueryscript.net/demo/jQuery-Plugin-For-Simultaneous-Downloads-With-One-Click-multiDownload/jquery.multiDownload.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
<script src="{{ asset('user/assets/js/custom.js') }}"></script>

<!-- <script src="user/assets/js/page/chart-amchart.html"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js "></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js "></script>


<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '.logouttrigger', function() {
            if (confirm('Are you sure, you want to logout?')) {
                document.getElementById('logout-form').submit();
                return true;
            }
            return false;
        });

        $('.specialchar').on('keypress', function(e) {
            var regex = new RegExp("^[a-zA-Z& ]");
            var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (!regex.test(key)) {
                e.preventDefault();
                return false;
            }
        });

        $('.contactvalid').on('keypress', function(e) {
            var regex = new RegExp("^[0-9]$");
            var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (!regex.test(key)) {
                e.preventDefault();
                return false;
            }
        });

        $('.emailvalid').on('keypress', function(e) {
            var regex = new RegExp("^[a-zA-Z0-9&_@. ]");
            var key = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (!regex.test(key)) {
                e.preventDefault();
                return false;
            }
        });



    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.openBulkUploadModal = function(type) {

            const modal = $('#bulkUploadModal');
            const form = $('#bulkUploadForm');
            const downloadLink = $('#bulkDownloadLink');
            const noteTypeInput = $('#noteType');


            modal.modal('show');
        }
    });


    document.getElementById('bulkDownloadLink').addEventListener('click', function(e) {
        e.preventDefault();
        $('.loader').show();

        const downloadUrl = $('#bulkDownloadLink').attr('href');
        console.log(downloadUrl);

        fetch(downloadUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Download failed');
                }
                return response.blob();
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = 'sample-file.xlsx'; // You could also pass this dynamically
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            })
            .catch(error => {
                alert('Error: ' + error.message);
            })
            .finally(() => {
                $('.loader').hide();
            });
    });



</script>
@if (session('bulkorderfile'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Invalid File',
            html: 'Only <strong>.xlsx</strong> files are allowed.'
        });
    </script>
@endif

<!-- Bulkorder popup Center -->
<script>
    @if (session('session_scount') || session('session_count'))
        var msg = "Total no. of records imported successfully " +
            "<span style='color:green;'><b>{{ session('session_scount') }}</b></span><br>" +
            "No. of failed records <span style='color:red;'><b>{{ session('session_count') }}</b></span><br></br>";

        @if (session('session_count') > 0 && session('session_url'))
            msg +=
                `<a href='#' onclick="downloadFailedReport('{{ session('session_url') }}'); return false;">
                    <button class='btn btn-danger ml-3'>Download Failed Report</button>
                </a>`;
        @endif

        Swal.fire({
            icon: 'info',
            title: 'Upload Result',
            html: msg
        });
    @endif

    function downloadFailedReport(url) {
        console.log(url);

        $.ajax({
            url: "{{ url('/') }}/" + url,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                let blob = new Blob([data], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'failed_report.xlsx';
                document.body.appendChild(link);
                link.click();
                link.remove();
                window.URL.revokeObjectURL(link.href);
            },
            error: function() {
                Swal.fire('Error', 'Failed to download the report.', 'error');
            }
        });
    }
</script>


</body>

</html>
