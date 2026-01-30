@extends('user.dashboard.layout.master')
@section('user-contant')

    <div class="loader"></div>

    <div class="main-content">
        <section class="section" style="margin-top:-34px;">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card ">

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
                                        <h4 class="mb-0">Print Labels</h4>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- <div class="card-header">
                            <h4>Print Labels</h4>
                        </div> --}}

                        <div class="printableArea2">

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <div class="card-header">
                                        <h4>Print Shipping Labels</h4>

                                    </div>

                                    <form action="" method="POST" id="orderBulk_print">
                                        @csrf

                                        <div class="list-inline my-3 ">
                                            <textarea class="form-control"
                                                placeholder="Enter AWB Numbers separated by commas, like 346739607685, 164696936972"
                                                name="shippinglabelawbno" class="my-5" id="shippinglabelawbno"
                                                required></textarea>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-2  my-3">
                                                <div class="buttons ">
                                                    <a href="" id="download_ship_lebel" hidden=""></a>
                                                    <button type="submit"
                                                        class="btn btn-primary form-control">Print</button>
                                                    {{-- <input type="button" class="btn btn-primary form-control"
                                                        value="Print" id="print_ship_level"> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </form>

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
        $("#nav a").click(function (e) {
            e.preventDefault();
            $(".toggle").hide();
            var toShow = $(this).attr('href');
            $(toShow).show();
        });


        $(document).ready(function () {
            $('#orderBulk_print').on('submit', function (e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('user.getBulkLabel') }}",
                    type: "GET",
                    data: formData,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {

                        var blob = new Blob([response], { type: 'application/pdf' });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = 'labels.pdf';
                        link.click();

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Labels downloaded successfully.',
                            width: '400px',
                        });
                        window.location.reload();
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            width: '400px',
                        });
                    },
                });
            });
        });

    </script>

@endsection