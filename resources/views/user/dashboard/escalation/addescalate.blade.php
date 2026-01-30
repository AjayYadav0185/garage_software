@extends('user.dashboard.layout.master')
@section('user-contant')
    <div class="loader"></div>
    <div class="main-content supreme-container">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">

                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-header" style="display: block;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                                                class="btn btn-primary go_forbtn"
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                                                data-toggle="tooltip" data-placement="top" title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;&nbsp;


                                            <h4>Need Help -</h4>
                                            <p class="mt-3">Raise a Ticket</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form method="post" id="addForm">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label">subject<span
                                                                class="text-danger">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control" name="subject" id="subject"
                                                                required>
                                                                <option value="">Select</option>
                                                                <option value="Shipment Related">Shipment Related</option>
                                                                <option value="Delivery Related">Delivery Related</option>
                                                                <option value="Billing Related">Billing Related</option>
                                                                <option value="COD Related">COD Related</option>
                                                                <option value="Pickup Related">Pickup Related</option>
                                                                <option value="Weight Related">Weight Related</option>
                                                                <option value="Tech Related">Tech Related</option>
                                                                <option value="Dashboard Related">Dashboard Related</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><label class="form-label">Awb Number<span
                                                                class="text-danger">*</span></label>
                                                        <input class="form-control" type="text" name="awb_number">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><label class="form-label">Message<span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control" name="escalation_message"
                                                            id="escalation_message" required=""></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                    </fieldset>
                                    <div class="row col-md-6">
                        
                                            <button type="submit" name="submit" class="btn btn-primary "
                                                style="text-align: center;">Submit
                                            </button>
                                     
                                    </div>
                                </form>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var _ = $('body');
            var createRecord = 'Are you sure you want to save the record?';
            $('body').on('submit', '#addForm', function (e) {
                e.preventDefault();
                var current = $(this);
                if (confirm(createRecord)) {
                    var data = current.serialize();
                    console.log(data);

                    Swal.fire({
                        title: "Please wait...",
                        html: "Processing..."
                    })
                    Swal.showLoading();
                    $.ajax({
                        url: "{{ route('user.save_escalations') }}",
                        dataType: "json",
                        type: "post",
                        data: data,
                        success: function (response) {
                            $('.submit').removeAttr('disabled');
                            if (response.status == 'success') {
                                $('#subject').val('');
                                //$('#escalation_date').val('');
                                $('#escalation_message').val('');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                });
                            } else if (response.status == 'error') {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message,
                                });
                            }
                        },
                    });
                    return false;
                }
                return false;
            });
        });

        var today = new Date().toISOString().split('T')[0];
        $('#escalation_date').attr('max', today);
    </script>
@endsection