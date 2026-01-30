@extends('user.dashboard.layout.master')
@section('user-contant')
    <div class="main-content">

        <style>
            .table-header {
                background-color: #4B0082;

                color: white;

            }

            .table-header:hover {
                border: #4B0082 solid !important;
            }

            #btn-purple {
                background-color: #6f42c1;
                color: #fff;
                border: 1px solid #4b2889 !important;
                transition: all 0.3s ease;
                /* border-radius: 4px; */
            }

            #btn-purple:hover {
                border: 1px solid #4b2889 !important;
                transition: all 0.3s ease !important;
                /* border-radius: 1px; */
                background-color: #fff !important;
                color: black !important;
            }

            #border-purple {
                border: 1px solid #4b2889 !important;
                /* border-radius: 4px !important; */

            }

            #i-purple {
                background-color: #6f42c1;
                color: #fff;
                border: 1px solid #4b2889 !important;
                transition: all 0.3s ease;
                /* border-radius: 4px; */
            }

            #i-purple:hover {
                border: 1px solid #4b2889 !important;
                transition: all 0.3s ease !important;
                border-radius: 1px;
                background-color: #fff !important;
                color: black !important;
            }

            #i-purple {
                border: 1px solid #4b2889 !important;
                /* border-radius: 4px !important; */

            }

            #card {
                box-shadow: inset 0 0 12px rgba(0, 123, 255, 0.2);
                /* inner blue shadow */
                border-radius: 10px;
            }


            .btn-purple-custom {
                background-color: #6f42c1;
                color: #fff;
                border: 2px solid transparent !important;
                border-radius: 30px;
                transition: all 0.3s ease !important;
                /* border-radius: 4px !; */
            }

            .btn-purple-custom:hover {
                border: 2px solid #4b2889 !important;
                transition: all 0.3s ease !important;
                border-radius: 30px;
                background-color: #fff !important;
                color: black !important;
            }
        </style>

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
            </div>
        </div>

        <section class="section">
            <div class="">
                <div class="" style="text-align: center;">
                    <div class="card" style="text-align: center;">
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

                                        @if (!empty($docPath))
                                            <h4 class="mb-0">Rappidx Integration / Rest API</h4>
                                        @else
                                            <h4 class="mb-0">Channel Integration API</h4>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-12 col-lg-8 " style="margin:1%; text-align: center;">
                                <form method="post" enctype="multipart/form-data" id="createform">
                                    {!! csrf_field() !!}
                                    <div class="card" id="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <div>
                                                <h4>Generate API Key</h4>
                                                <p class="mb-1">
                                                    (Before you get our API key and develop
                                                    {{-- <a href="$docPath" class="btn btn-purple btn-sm" target="_blank">See our documentation</a>) --}}
                                                    )</p>
                                            </div>

                                            @if (!empty($docPath))
                                                <div class="btn-purple-custom">
                                                    <a href="{{ $docPath }}" class="btn btn-purple-custom btn-sm"
                                                        target="_blank">
                                                        See our documentation
                                                    </a>
                                                </div>
                                            @endif


                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content excel" id="myTabContent2" style="text-align: center;">
                                                <div class="tab-pane fade show active my-2" id="contact3" role="tabpanel"
                                                    aria-labelledby="contact-tab3">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped xys" id="pending_pickup_tab">
                                                            <thead></thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <label>Your API Key<small
                                                                                class="text-danger">*</small></label>
                                                                    </td>
                                                                    <td>
                                                                        <div style="position: relative; max-width: auto;">
                                                                            <input type="text"
                                                                                class="form-control specialchar"
                                                                                name="key" id="key"
                                                                                value="{{ $apiKeyData }}" disabled
                                                                                style="padding-right: 35px; cursor: default;">

                                                                            <!-- Copy icon -->
                                                                            <button type="button" onclick="copyApiKey()"
                                                                                style="position: absolute; right: 5px; top: 50%; transform: translateY(-50%); border: none; background: transparent; cursor: pointer; padding: 0;">
                                                                                <!-- You can use an SVG or font-awesome icon here -->
                                                                                📋
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="card-footer text-center">
                                                        <div class="input-group justify-content-center"
                                                            style="max-width: 300px; margin: 0 auto;">
                                                            <div class="input-group-prepend">
                                                                <span id="i-purple" class="btn btn-purple btn-sm">
                                                                    <i class="fas fa-plus"></i>
                                                                </span>
                                                            </div>
                                                            <input type="submit" name="submitaddress"
                                                                class="btn btn-purple btn-sm " value="Generate Key"
                                                                id="btn-purple">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript">
            $(document).ready(function() {
                var _ = $('body');
                var createRecord = 'Are you sure you want to generate the api key?';


                $('body').on('submit', '#createform', function(e) {

                    e.preventDefault();
                    var current = $(this);
                    if (confirm(createRecord)) {
                        var data = current.serialize();
                        $.ajax({
                            url: "{{ route('user.update-api-key') }}",
                            dataType: "json",
                            type: "post",
                            data: data,
                            success: function(response) {

                                $('.submit').removeAttr('disabled');

                                if (response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'API Key Generated Successfully.',
                                    });
                                    window.location.reload();
                                } else if (response.status == 'error') {
                                    $('#name').after('<span class="name_error" style="color:red">' +
                                        response.error + '</span>');
                                    $('#amount').after(
                                        '<span class="amount_error" style="color:red">' +
                                        response.error + '</span>');
                                }

                            },
                        });
                        return false;
                    }
                    return false;
                });
            });
        </script>

        <script>
            function copyApiKey() {
                const input = document.getElementById('key');
                const textToCopy = input.value.trim();

                if (!textToCopy) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Nothing to copy',
                        showConfirmButton: false,
                        timer: 1000,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                    });
                    return; // Stop here, no copy
                }

                input.disabled = false;
                input.select();
                input.setSelectionRange(0, 99999);

                navigator.clipboard.writeText(textToCopy).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        showConfirmButton: false,
                        timer: 1000,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                    });
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to copy',
                        showConfirmButton: false,
                        timer: 1000,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                    });
                });

                input.disabled = true;
                window.getSelection().removeAllRanges();
            }
        </script>
    @endsection
