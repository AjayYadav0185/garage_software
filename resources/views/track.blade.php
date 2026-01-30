<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rappidx Tracking</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('style.css')}}">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

      <script src="{{asset('user/assets/js/app.min.js')}}"></script>
      <script src="{{asset('user/assets/js/scripts.js')}}"></script>

      

  </head>
  <body>

    <br><br><br><br>

<div class="text-dark">
<div class="container">

    <div class="">
        <a href="https://rappidx.intileotech.com/" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
      </div>

    <div class="container">
    <div class="row align-items-center w-100">
      <!-- Left Column -->
      <div class="col-md-6 text-center text-md-start">
        <h1 class="track-order-title">Track Your Order</h1>
        {{-- <p class="description mt-3">Lorem ipsum ipsum lorem sumrem lkore</p> --}}
      </div>
      <!-- Right Column -->

      

      <div class="col-md-6">
        <div class="track-card">

      

            <div class="mb-3">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button 
                            class="nav-link {{ $awb ? 'active' : '' }}" 
                            id="pills-home-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#pills-home" 
                            type="button" 
                            role="tab" 
                            aria-controls="pills-home" 
                            aria-selected="{{ $awb ? 'true' : 'false' }}">
                            AWB No
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button 
                            class="nav-link {{ $orderid ? 'active' : '' }}" 
                            id="pills-profile-tab" 
                            data-bs-toggle="pill" 
                            data-bs-target="#pills-profile" 
                            type="button" 
                            role="tab" 
                            aria-controls="pills-profile" 
                            aria-selected="{{ $orderid ? 'true' : 'false' }}">
                            Order ID
                        </button>
                    </li>

                </ul>
              
            </div>
          
            <form action="" method="POST" id="trackorder">
              @csrf
             
              <div class="tab-content" id="pills-tabContent">
                <div 
                    class="tab-pane fade {{ $awb ? 'show active' : '' }}" 
                    id="pills-home" 
                    role="tabpanel" 
                    aria-labelledby="pills-home-tab">
                    <input 
                        type="text" 
                        name="awb_number" 
                        value="{{ $awb }}" 
                        class="form-control" 
                        id="awb-no" 
                        placeholder="AWB NO">
                </div>
                <div 
                    class="tab-pane fade {{ $orderid ? 'show active' : '' }}" 
                    id="pills-profile" 
                    role="tabpanel" 
                    aria-labelledby="pills-profile-tab">
                    <input 
                        type="text" 
                        name="order_id" 
                        value="{{ $orderid }}" 
                        class="form-control" 
                        id="order_id" 
                        placeholder="ORDER ID">
                </div>
            </div>
          
              <div class="row-12 text-end">
                  <br>
                  <button type="submit" class="btn track-btn w-25">TRACK</button>
              </div>
          </form>
         
          <script>
              document.querySelectorAll('[data-bs-toggle="pill"]').forEach(tab => {
               
                  tab.addEventListener('shown.bs.tab', function (e) {
                
                      const inputs = document.querySelectorAll('#pills-tabContent input');
                      inputs.forEach(input => {
                          input.value = ''; 
                      });
                  });
              });
          </script>          
          
          <p class="mt-2 text-muted">
            See the tracking id on shipping document. <a href="#">Help</a>
          </p>
        </div>
      </div>

    </div>
  </div>

  <br><br>

  <div id="noRecordMessage" style="display: none; color: red; font-weight: bold;">No record found</div>
    <div class="container" id="orderpage" style="">
    {{-- <h3 class="mb-4">1 Active Orders</h3> --}}
    <div class="order-card border border-secondary">

        <div class="container py-3">
            <div class="row align-items-center">
               
                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                    <div class="d-flex align-items-center">
                       
                        <div class="me-3">
                            <img src="{{asset('img/logo1.png')}}" alt="Logo" class="" height="50">
                        </div>
                     
                        <div class="me-3">
                            <h5 class="mb-0 ordernumber" id="">{{$singleproqueryResult->orderno ?? ''}}</h5>
                            <small class="text-muted">Courier Partner - <span id="couriername">{{$singleproqueryResult->courier_name ?? ''}}</span></small>
                        </div>
                       
                        <div class="vr mx-3 d-none d-md-block"></div>
                       
                        <div>
                            <p class="mb-0"> <i class="fa fa-chevron-right" style="font-size:10px;"></i></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12">
                    <div class="d-flex align-items-center justify-content-between">
                       
                        <div class="text-center me-3">
                            <p class="mb-0 small">From <br><strong id="fromaddress">{{$singleproqueryResult->State ?? ''}}</strong></p>
                        </div>
                   
                        <div class="me-3">
                            <span class="badge bg-warning text-dark px-3 py-2"></span>
                        </div>
                     
                        <div class="flex-grow-1 me-3">
                            <div class="progress bg-light" style="height: 6px;">
                                <div
                                    class="progress-bar bg-warning"
                                    style="width: 75%;"
                                    role="progressbar"
                                    aria-valuenow="75"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </div>
                      
                        <div class="text-center me-3">
                            <p class="mb-0 small">To <br><strong id="toaddress">{{$singleproqueryResult->City ?? ''}}</strong></p>
                        </div>
                       
                        <div>
                            <a href="#" class="text-decoration-none text-primary fw-bold">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>        

    <hr>

    <div class="row">

        <div class="col-1">
            <p>Products</p>
        </div>

        <div class="col-1">
            <span id="productname">{{$singleproqueryResult->Item_Name ?? ''}}</span>
            {{currency_symbol()}}<span id="itemprice">{{$singleproqueryResult->Cod_Amount ?? ''}}</span>
        </div>

        <div class="col-1">
         
        </div>

        <div class="col-9"></div>

    </div>
     
      <hr>

      <div class="row">

        <?php
                                
        $current_statusdata = $singleproqueryResult->order_status1 ?? '';
        
            
         $current_statusdata= $current_statusdata == 'Shipped'? 'Pending Pickup':$current_statusdata;
          $current_statusdata= $current_statusdata == 'In Transit'? 'Intransit':$current_statusdata;
           $current_statusdata= $current_statusdata == 'Delivered'? 'Delivered':$current_statusdata;
            $current_statusdata= $current_statusdata == 'OFD'? 'Out For Delivery':$current_statusdata;
              $current_statusdata= $current_statusdata == 'RTO'? 'RTO':$current_statusdata;
                $current_statusdata= $current_statusdata == 'Lost'? 'Lost':$current_statusdata;
              $current_statusdata= $current_statusdata == 'Cancelled'? 'Cancelled':$current_statusdata;
               $current_statusdata= $current_statusdata == 'Failed'? 'Failed':$current_statusdata;
                $current_statusdata= $current_statusdata == 'Processing'? 'Processing':$current_statusdata;
               
                  $current_statusdata= $current_statusdata == 'Upload'? 'Ready To Ship':$current_statusdata;
                   $current_statusdata= $current_statusdata == 'Undelivered'? 'Undelivered':$current_statusdata;
           ?>



        <div class="col-8">

                <h3 style="font-size: 14px; color: black;">
                  Current Status : {{$allStatusLogs->order_status1 ?? ''}}
                  <span id="currentStatus" class=""><br>Time : {{ date('d-m-Y H:i:s', strtotime($allStatusLogs->created_at ?? '')) }}</span>
                </h3>
            
              
             
        </div>

        <div class="col-4">
            <div class="action-buttons d-flex justify-content-end mt-3 gap-3">
                <a href="#" class="text-primary icon-link">
                  <i class="bi bi-globe"></i> Website
                </a>
                <a href="#" class="text-warning icon-link">
                  <i class="bi bi-question-circle"></i> Need Help
                </a>
              </div>
        </div>

      </div>
      

    </div>
  </div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>



$(document).ready(function(){



    $('#trackorder').on('submit' , function(e){

        // alert('Calling');

        e.preventDefault();

        var formData = $(this).serialize();

         $.ajax({

            url : "{{route('summary')}}",
            type : "POST",
            data : formData,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  
              },
              success: function (response) {
   
    if (!response.singleproquery || Object.keys(response.singleproquery).length === 0) {
        $('#orderpage').css('display', 'none');
        $('#noRecordMessage').text('No record found').css('display', 'block'); 
    }
    else{
      $('#orderpage').css('display', 'block');
      $('#noRecordMessage').css('display', 'none'); 

    $('.ordernumber').text(response.singleproquery.orderno);
    $('#couriername').text(response.singleproquery.courier_name);
    $('#fromaddress').text(response.singleproquery.State);
    $('#toaddress').text(response.singleproquery.City);
    $('#productname').text(response.singleproquery.Item_Name);
    $('#itemprice').text(response.singleproquery.Cod_Amount);

    let currentStatus = response.singleproquery.order_status1 || '';

    const statusClassMap = {
        'Shipped': 'aa',
        'In Transit': 'bb',
        'Delivered': 'cc',
        'OFD': 'dd',
        'RTO': 'ee',
        'Lost': 'ff',
        'Cancelled': 'gg',
        'Failed': 'hh',
        'Processing': 'ii',
        'Upload': 'jj',
        'Undelivered': 'kk'
    };

    currentStatus = currentStatus === 'Shipped' ? 'Pending Pickup' :
                    currentStatus === 'In Transit' ? 'Intransit' :
                    currentStatus === 'Delivered' ? 'Delivered' :
                    currentStatus === 'OFD' ? 'Out For Delivery' :
                    currentStatus === 'Upload' ? 'Ready To Ship' : currentStatus;

                    $('#currentStatus')
        .text(currentStatus)
        .attr('class', statusClassMap[response.singleproquery.order_status1] || '');

        const timelineData = response.singleproquery.timeline || [];
    let timelineContent = '';
    timelineData.forEach(event => {
        timelineContent += `
            <div class="mt-3">
                <span class="timeline-point">${event.status}</span>
                <p class="timeline-event">${event.location}</p>
                <p class="timeline-event">${event.timestamp}</p>
            </div>
        `;
    });
    $('#timeline').html(timelineContent);

    }

},
  error: function (error) {
    console.error('Error fetching order details:', error);

            }

         });

    });

});

</script>
   
  </body>
</html>