@extends('user.dashboard.layout.master')
@section('user-contant')


<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <form method="post" enctype="multipart/form-data" id="createform">
            {!! csrf_field() !!}
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="d-flex align-items-center gap-2">
                      <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}"
                         class="btn btn-primary go_forbtn"
                         style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;"
                         data-toggle="tooltip" data-placement="top" title="Go Back">
                        <i class="fa-sharp fa fa-arrow-left"></i>
                      </a>
                      <h4 class="mb-0 ms-2">Add Warehouse</h4>
                    </div>
                  </div>
                </div>
                <hr>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <label>Warehouse Name<small class="text-danger">*</small></label>
                    <input type="text" class="form-control specialchar1" name="name" id="name" required
                           onKeyPress="if(this.value.length==30) return false;">
                  </div>
                  <div class="col-md-3">
                    <label>Contact Number<small class="text-danger">*</small></label>
                    <input type="text" class="form-control contactvalid" name="phone" id="phone" required
                           onKeyPress="if(this.value.length==10) return false;" placeholder="Enter 10 dig Mobile Number">
                  </div>
                  <div class="col-md-3">
                    <label>Alt. Number</label>
                    <input type="text" class="form-control contactvalid" name="alt_num" id="alt_num"
                           onKeyPress="if(this.value.length==10) return false;" placeholder="Enter 10 dig Mobile Number ">
                  </div>
                  <div class="col-md-3">
                    <label>Email ID</label>
                    <input type="email" class="form-control" name="email" id="email"
                           onKeyPress="if(this.value.length==30) return false;" placeholder="Enter email address">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-3">
                    <label>Contact Person<small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="contact_person" id="contact_person" required
                           onKeyPress="if(this.value.length==30) return false;">
                  </div>
                  <div class="col-md-3">
                    <label>State<small class="text-danger">*</small></label>
                    <select class="form-control specialchar" name="state" id="state" required>
                      <option value="">Select State</option>
                      @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label>City<small class="text-danger">*</small></label>
                    <input type="text" class="form-control specialchar" name="city" id="city" required
                           onKeyPress="if(this.value.length==20) return false;">
                  </div>
                  <div class="col-md-3">
                    <label>Pincode<small class="text-danger">*</small></label>
                    <input type="text" class="form-control contactvalid" name="pin" id="pin" required
                           onKeyPress="if(this.value.length==6) return false;" placeholder="Enter Pincode">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-3">
                    <label>TAX Number - Optional <small class="text-danger"></small></label>
                    <input type="text" class="form-control" name="warehouse_gst" id="warehouse_gst"
                           onKeyPress="if(this.value.length==20) return false;" required>
                  </div>
                  <div class="col-md-9">
                    <label>Address<small class="text-danger">* (Maximum 60 characters allowed)</small></label>
                    <input type="text" class="form-control" name="address" id="address" required
                           onKeyPress="if(this.value.length==60) return false;" placeholder="Enter Pickup Address">
                  </div>
                </div>

                <div class="mt-3">
                  <label>Address2 - Optional</label>
                  <input type="text" class="form-control" name="address2" id="address2" placeholder="Enter Pickup Address ">
                </div>

                <br>
                <div>
                  <p><b>Return Details</b></p>
                  <label><span class="text-danger" id="returnText">Return address is the same as Pickup Address</span></label>
                  <input type="checkbox" name="same_return_add" id="same_return_add" onclick="toggleReturnAddress()">
                </div>

                <div id="returnAddressFields">
                  <div class="row mt-3">
                    <div class="col-md-6">
                      <label>Contact Person<small class="text-danger">*</small></label>
                      <input type="text" class="form-control" name="return_person" id="return_person"
                             onKeyPress="if(this.value.length==30) return false;" required>
                    </div>
                    <div class="col-md-6">
                      <label>Contact Number<small class="text-danger">*</small></label>
                      <input type="text" class="form-control contactvalid" name="return_phone" id="return_phone"
                             onKeyPress="if(this.value.length==10) return false;" required>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-4">
                      <label>State<small class="text-danger">*</small></label>
                      <select class="form-control specialchar" name="return_state" id="return_state" required>
                        <option value="">Select State</option>
                        @foreach($states as $state)
                          <option value="{{ $state->id }}">{{ $state->state }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label>City<small class="text-danger">*</small></label>
                      <input type="text" class="form-control specialchar" name="return_city" id="return_city" required>
                    </div>
                    <div class="col-md-4">
                      <label>Pincode<small class="text-danger">*</small></label>
                      <input type="text" class="form-control contactvalid" name="return_pin" id="return_pin" required>
                    </div>
                  </div>
                  <div class="mt-3">
                    <label>Address<small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="return_address" id="return_address"
                           onKeyPress="if(this.value.length==60) return false;" required>
                  </div>
                </div>

                <br>
                <div>
                  <p><b>Seller Details</b></p>
                  <label><span class="text-danger" id="sameSeller">Seller Details is the same as Contact Person Details.</span></label>
                  <input type="checkbox" name="same_seller" id="same_seller" onclick="toggleSellerDetails()" >
                </div>

                <div id="returnSellerFields">
                  <div class="row mt-3">
                    <div class="col-md-4">
                      <label>Seller Name<small class="text-danger">*</small></label>
                      <input type="text" class="form-control specialchar" name="seller_name" id="seller_name" required>
                    </div>
                    <div class="col-md-8">
                      <label>Seller Address<small class="text-danger">*</small></label>
                      <input type="text" class="form-control" name="seller_address" id="seller_address" required>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-md-3">
                      <label>Seller Number<small class="text-danger">*</small></label>
                      <input type="text" class="form-control contactvalid" name="seller_phone" id="seller_phone"
                             onKeyPress="if(this.value.length==10) return false;" required>
                    </div>
                    <div class="col-md-3">
                      <label>State<small class="text-danger">*</small></label>
                      <select class="form-control specialchar" name="seller_state" id="seller_state" required>
                        <option value="">Select State</option>
                        @foreach($states as $state)
                          <option value="{{ $state->id }}">{{ $state->state }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>City<small class="text-danger">*</small></label>
                      <input type="text" class="form-control specialchar" name="seller_city" id="seller_city" required>
                    </div>
                    <div class="col-md-3">
                      <label>Pincode<small class="text-danger">*</small></label>
                      <input type="text" class="form-control contactvalid" name="seller_pin" id="seller_pin" required>
                    </div>
                     <div class="col-md-3">
                    <label>TAX Number<small class="text-danger"></small></label>
                    <input type="text" class="form-control" name="seller_gst" id="seller_gst"
                           onKeyPress="if(this.value.length==20) return false;">
                  </div>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="form-group col-md-6 d-none">
                    <label for="waretype">Type</label>
                    <select class="form-control" name="waretype" id="waretype">
                      <option value="B2C">B2C</option>
                      <option value="D2C">D2C</option>
                      <option value="B2B">B2B</option>
                      <option value="Hyperlocal">Hyperlocal</option>
                    </select>
                  </div>
                </div>
              </div> <!-- card-body -->

              <div class="card-footer text-right">
                <input type="submit" name="submitaddress" class="btn btn-primary mr-1">
                <input type="reset" class="btn btn-secondary">
              </div>
            </div> <!-- card -->
          </form>
        </div> <!-- col -->
      </div> <!-- row -->
    </div> <!-- section-body -->
  </section>
</div> <!-- main-content -->


  <script type="text/javascript">
    function toggleReturnAddress() {
    var checkbox = document.getElementById('same_return_add');
    const returnText = document.getElementById('returnText');
    var returnAddressFields = document.getElementById('returnAddressFields');
    if (checkbox.checked) {
      document.getElementById('return_person').value = document.getElementById('contact_person').value;
      document.getElementById('return_phone').value = document.getElementById('phone').value;
      document.getElementById('return_address').value = document.getElementById('address').value;
      document.getElementById('return_state').value = document.getElementById('state').value;
      document.getElementById('return_city').value = document.getElementById('city').value;
      document.getElementById('return_pin').value = document.getElementById('pin').value;
      // document.getElementById('pickupgstin').value = document.getElementById('warehouse_gst').value;


      returnAddressFields.style.display = 'none';
      returnText.classList.remove('text-danger');
      returnText.classList.add('text-success');
    } else {
      document.getElementById('return_address').value = '';
      document.getElementById('return_state').value = '';
      document.getElementById('return_city').value = '';
      document.getElementById('return_pin').value = '';
      document.getElementById('return_person').value = '';
      document.getElementById('return_phone').value = '';
      // document.getElementById('pickupgstin').value = '';

      returnAddressFields.style.display = 'block';
      returnText.classList.remove('text-success');
      returnText.classList.add('text-danger');
    }
    }



    function toggleSellerDetails() {
    // alert("hi");
    var sell_checkbox = document.getElementById('same_seller');
    var returnSellerFields = document.getElementById('returnSellerFields');
    const sameSeller = document.getElementById('sameSeller');
    if (sell_checkbox.checked) {

      document.getElementById('seller_name').value = document.getElementById('contact_person').value;
      document.getElementById('seller_address').value = document.getElementById('address').value;
      document.getElementById('seller_gst').value = document.getElementById('warehouse_gst').value;
      document.getElementById('seller_phone').value = document.getElementById('phone').value;
      document.getElementById('seller_state').value = document.getElementById('state').value;
      document.getElementById('seller_city').value = document.getElementById('city').value;
      document.getElementById('seller_pin').value = document.getElementById('pin').value;

      returnSellerFields.style.display = 'none';
      sameSeller.classList.remove('text-danger');
      sameSeller.classList.add('text-success');
    } else {
      document.getElementById('seller_name').value = '';
      document.getElementById('seller_address').value = '';
      document.getElementById('seller_gst').value = '';

      document.getElementById('seller_phone').value = '';
      document.getElementById('seller_state').value = '';
      document.getElementById('seller_city').value = '';
      document.getElementById('seller_pin').value = '';

      returnSellerFields.style.display = 'block';
      sameSeller.classList.remove('text-success');
      sameSeller.classList.add('text-danger');
    }
    }
    document.addEventListener('DOMContentLoaded', function () {
    toggleReturnAddress();
    toggleSellerDetails();
    });
    $(document).ready(function () {
    var _ = $('body');
    var createRecord = 'Are you sure you want to save the record?';
    var updateRecord = 'Are you sure you want to modify this record?';
    var deleteRecord = 'Are you sure you want to delete this record?';
    $('body').on('submit', '#createform', function (e) {
      e.preventDefault();
      var current = $(this);
      if (confirm(createRecord)) {
      var data = current.serialize();
      $.ajax({
        url: "{{route('user.warehouse-save')}}",
        dataType: "json",
        type: "post",
        data: data,
        success: function (response) {
        $('.submit').removeAttr('disabled');
        if (response.status == 'success') {
          $('#name').val('');
          $('#phone').val('');
          $('#alt_num').val('');
          $('#email').val('');
          $('#contact_person').val('');
          $('#address').val('');
          $('#state').val('');
          $('#city').val('');
          $('#pin').val('');
          $('#pickupgstin').val('');
          $('#waretype').val('');
          //   Swal.fire({
          //                icon: 'success',
          //                title: 'Success!',
          //                text: response.message,
          //            });
          Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: response.message,
          }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "{{ route('user.warehouse') }}";
          }
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
  </script>
@endsection