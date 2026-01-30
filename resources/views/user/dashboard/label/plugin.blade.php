@extends('user.dashboard.layout.master')
@section('user-contant')

{{-- <style>
  .card {
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2); /* blue shadow */
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: none;
  }

  .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(0, 123, 255, 0.25);
  }

  .card-body {
      padding: 1.5rem;
  }

  .card-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #007bff;
      margin-bottom: 0.8rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid #007bff; /* line under title */
  }

  .card-text {
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 1rem;
  }

  .btn-primary {
      border-radius: 5px;
      padding: 0.4rem 1rem;
      font-weight: 500;
      background-color: #007bff;
      border: none;
  }

  .btn-primary:hover {
      background-color: #0056b3;
  }
</style> --}}


<style>
  #card {
      border-radius: 10px;
      box-shadow: inset 0 0 15px rgba(0, 123, 255, 0.2); /* inner blue shadow */
      border: 1px solid #e3e6f0;
      transition: box-shadow 0.3s ease;
  }

  .card-body {
      padding: 1.5rem;
  }

  .card-title {
      font-size: 1.2rem;
      font-weight: 600;
      color: #007bff;
      margin-bottom: 0.8rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid #007bff; /* bottom border line */
  }

  .card-text {
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 1rem;
  }

  .btn-primary {
      border-radius: 5px;
      padding: 0.4rem 1rem;
      font-weight: 500;
      background-color: #007bff;
      border: none;
  }

  .btn-primary:hover {
      background-color: #0056b3;
  }
</style>

    <div class="loader"></div>

    <div class="main-content">
        <section class="section" style="margin-top:-34px;">
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
                                        <h4 class="mb-0">Plugins & API Integrations</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-header">
                            <h4>Plugins & API Integrations</h4>
                        </div> --}}

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card" id="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Rappidx Integration / Rest API</h5>
                                            <p class="card-text">Integrate your existing systems with Rappidx using our
                                                flexible API to automate orders and shipping processes seamlessly.</p>
                                            <a href="{{ route('user.generate-api-key', ['type' => 'rest-api']) }}" class="btn btn-primary">Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card" id="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Channedel Integration</h5>
                                            <p class="card-text">
                                                Effortlessly connect and manage all your sales channels from one platform,
                                                automating order syncing and fulfillment for seamless operations.
                                            </p>    <a href="{{ route('user.generate-api-key', ['type' => 'channel']) }}" class="btn btn-primary">Get
                                                Started</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card" id="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Marketplace Integrations </h5>
                                            <p class="card-text">Connect with leading marketplaces to automate order syncing
                                                and fulfillment, all managed from a single dashboard.</p>
                                            <a href="#" class="btn btn-primary">Get Started</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>

    <script
        src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Simultaneous-Downloads-With-One-Click-multiDownload/jquery.multiDownload.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PrintArea/2.4.1/jquery.PrintArea.min.js"></script>
    <script>
        $("#nav a").click(function(e) {
            e.preventDefault();
            $(".toggle").hide();
            var toShow = $(this).attr('href');
            $(toShow).show();
        });

        $('#print_ship_level').click(function() {
            var awbno = $.trim($('#shippinglabelawbno').val());

            var awb_arr = awbno.split(',');
            var mobile = document.getElementById('mobilee').checked;
            var sel_mobilee = document.getElementById('sel_mobilee').checked;
            var sel_address = document.getElementById('sel_address').checked;
            var seller_rt_address = document.getElementById('seller_rt_address').checked;
            var select_size = $('#select_size_css option:selected').val();
            //alert(select_size);

            // if (awbno !== '') {
            //     $.ajax({
            //         url: "{{ route('user.getlabel') }}",
            //         type: 'get',
            //         data: {awbno,mobile, select_size,sel_mobilee,sel_address,seller_rt_address},
            //         success: function(response) {
            //             //console.log(response);
            //             $(".printableArea2").html(response.html);
            //             //$('.pdfprint_data').html('');
            //               var mode = 'iframe'; //popup
            //                 var close = mode == "popup";
            //                 var options = {
            //                     mode: mode,
            //                     popClose: close
            //                 };

            //                 $(".printableArea2").printArea(options);

            //                 var style = document.createElement('style');
            //             style.type = 'text/css';
            //             style.innerHTML = '@media print { body { color: #000;font-size: 25px; } }'; // Change #333 to your desired darker color
            //             document.head.appendChild(style);

            //                 $(".printableArea2").html('');

            //             }
            //     });
            // } else {
            //     toastr.error('Please Enter AWB Number');

            // }

            if (awbno !== '') {

                window.location.href = `{{ route('user.getlabel') }}?awbno=${awbno}`;

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please Select Valid Number',
                    width: '400px',
                });

            }

        });
    </script>
@endsection
