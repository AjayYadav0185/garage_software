<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

    $(document).ready(function () {

        var $jq = jQuery.noConflict();

        $jq('#dataTable').DataTable();

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $jq('#reportrange1 span').html(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        }

        $jq('#reportrange1').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#reportrange1').on('apply.daterangepicker', function (ev, picker) {

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            $jq.ajax({
                url: '{{route('user.dash1')}}',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {




                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $jq("html").niceScroll();

    });

    $(document).ready(function () {

        var $jq = jQuery.noConflict();

        $jq('#dataTable').DataTable();

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
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#reportrange3').on('apply.daterangepicker', function (ev, picker) {

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            $jq.ajax({
                url: '{{route('user.dash1')}}',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $jq("html").niceScroll();

    });

</script>


<script type="text/javascript">

    $(document).ready(function () {

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
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        $jq('#reportrange').on('apply.daterangepicker', function (ev, picker) {

            fetchFilteredData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
        });

        function fetchFilteredData(startDate, endDate) {
            $jq.ajax({
                url: '{{route('user.dash1')}}',
                method: 'POST',
                data: {
                    start_date: startDate,
                    end_date: endDate,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // console.log(response.totalShipmentData);
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
                            '<td>' + ((totalrevenueData.total_cod_amount || 0) + (totalrevenueData.total_prepaid_amount || 0)) + '</td>' +
                            '<td>' + (totalrevenueData.total_cod_amount || 0) + '</td>' +
                            '<td>' + (totalrevenueData.total_prepaid_amount || 0) + '</td>' +
                            '</tr>'
                        );

                    }

                    var querydata = response.querydata;

                    if (querydata) {

                        $('#treandandanalytics').empty();

                        querydata.forEach(function (row) {
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
                        $('#courierwiselead').empty(); // Clear existing content

                        totaldelhivery.forEach(function (data) {
                            $('#courierwiselead').append(
                                '<div class="col-xl-2 col-lg-2 mb-4">' +
                                '<div class="progress rounded-circle" data-value="' + (data.count || 0) + '">' +
                                '<span class="progress-left">' +
                                '<span class="progress-bar ' + (data.graph_color || '') + '"></span>' +
                                '</span>' +
                                '<span class="progress-right">' +
                                '<span class="progress-bar ' + (data.graph_color || '') + '"></span>' +
                                '</span>' +
                                '<div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">' +
                                '<div class="h5 font-weight-bold">' + (data.count || 0) + '<sup class="small">%</sup></div>' +
                                '</div>' +
                                '</div>' +
                                '<div class="h6 font-weight-bold p-2">' + (data.courier_name || '') + '</div>' +
                                '</div>'
                            );
                        });
                    }


                    //  var weightlabels = response.weightlabels;
                    //  var weightdata = response.weightdata;

                    //  if(weightlabels && weightdata){

                    //   document.getElementById('weightLabels').textContent = JSON.stringify(weightlabels);
                    //   document.getElementById('weightData').textContent = JSON.stringify(weightdata);

                    //  }


                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        $jq("html").niceScroll();

        function updateChart(labels, data) {
            // Assuming you have a function to recreate the chart using the new labels and data
            const chartLabels = labels;
            const chartData = data.map(value => parseFloat(value).toFixed(2));

            const ctx = document.getElementById('myChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Updated Weight Data',
                        data: chartData,
                        borderWidth: 2,
                        backgroundColor: Utils.barColors(chartData.length),
                        barThickness: 50
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

    });


</script>