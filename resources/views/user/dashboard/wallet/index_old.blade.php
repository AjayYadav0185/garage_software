@extends('user.dashboard.layout.master')
@section('user-contant')
<style>
    .nav-pills .nav-item .nav-link:hover {
    background-color: #e2e60a;
    margin-left:4px !important;
}
.theme-white .nav-pills .nav-link.active {
    color: #fff;
    background-color: #6777ef;
      margin-left:4px !important; 
}
.nav-pills .nav-item .nav-link {
    color: #6777ef;
    /* padding-left: 15px !important; */
    /* padding-right: 15px !important; */
    margin-left: 4px;
}
.aa{
        color:rgb(0,32,122);
    }
    .bb{
      color:rgb(0,112,192);  
    }
    .cc{
      color:rgb(86,131,55);  
    }
    .dd{
      color:rgb(255,193,3);  
    }
    .ee{
      color:rgb(255,0,0);  
    }
    .ff{
      color:rgb(64,64,64);  
    }
    .gg{
      color:rgb(255,0,0);  
    }
    .hh{
      color:rgb(255,0,0);  
    }
     .ii{
      color:rgb(255,220,132);  
    }
    .jj{
      color:rgb(84,130,53);  
    }
     .kk{
      color:rgb(117,62,63);  
    }

    .dataTables_length{
    margin-top: 15px!important;

}
</style>
<div class="main-content supreme-container">

    <section class="section" style="margin-top:-34px;">

        <div class="section-body">

            <div class="row">

                <div class="col-12 col-sm-12 col-lg-12 ">

                <div class="row">
                            <div class="col-sm-10">
                            <h4 class="float-left">Wallet</h4>
                            </div>
                            <div class="col-sm-2 text-center">
                                <a href="{{route('user.index')}}" class="btn btn-primary mr-1 go_forbtn float-right" style="color:white;" data-toggle="tooltip" data-placement="top" title="Go Back" type="submit" ><i class="fa-sharp fa fa-arrow-left"></i></a>
                            </div>
                            </div>

                    
                    
                    <div class=" card">

                        <div class="row">

                            <div class="col-md-10 my-1 ">

                                <div class="" style="margin-left:3%;"><i class="fas fa-wallet my-1"
                                        style="color:blue;border-radius: 50%;background-color: white;font-size:20px"></i><span
                                        style="font-size:15px"></i>

                                        <strong style="font-size: 12px;">Total Balance</strong>
                                        &nbsp;{{currency_symbol()}}&nbsp;{{$walletAmt}}</div>

                            </div>

                            <div class="col-md-2">

                            <div class="my-1">
                                <button type="button" class="btn " style="background-color:#00cc00;border-radius: 5%;" data-toggle="modal" data-target="#basicModal">&nbsp;Recharge Now

                                </button>
                            </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-12 my-1">

                <form class="order_filter" method="post" id="IdFilterData">
                {!! csrf_field() !!}

                    <div class="row">

                        <div class="col-md-3  ">

                            <!-- <label class="form-label" style="color:#0d0d0d ;">Date Range</label> -->

                            <div class="list-inline text-center">

                                <div class="form-group card">

                                    <select class="form-control " id="date_range" data_id="#home3">

                                        <option value="">---Select Date Range---</option>

                                        <option value="today">Today</option>

                                        <option value="yesterday">Yesterday</option>

                                        <option value="-7 days">Last seven days </option>

                                        <option value="first day of">Current Month </option>

                                        <option value="-1 months">Last Month </option>

                                        <option value="All Time Order">All Time

                                        </option>

                                       

                                        <!-- <option value="CustomDateRange">Custom Date Range</option> -->

                                    </select>

                                </div>

                            </div>
                            
                        </div>
                        
                        <!-- For Custom Date -->
                         
                    <div class="col-md-3 d-none" id="custom_date_from">
                        <label class="form-label" style="color:#0d0d0d;" for="from_date">From Date</label>
                        <input type="date" class="form-control" id="from_date" name="from_date">
                    </div>

                    <div class="col-md-3 d-none" id="custom_date_to">
                        <label class="form-label" style="color:#0d0d0d;" for="to_date">To Date</label>
                        <input type="date" class="form-control" id="to_date" name="to_date">
                    </div>
                    <!-- For Custom Date -->
                           

                           
                        <div class="col-md-5">

                            <div class="card">

                                <div class="input-group">

                                    <input type="text" class="form-control" id="blance_filter" placeholder="Search By AWB No.">
                                
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="row">

                                <div class="col-md-9"></div>

                            </div>

                            <div class="card pb-2" >

                                <div class="pt-2" style="margin-left:3%">

                                    <span class="my-1">Opening Balance</span> <i class="fas fa-wallet"
                                        style="color:blue;border-radius: 50%;background-color: white;font-size:15px;margin-left:1%"></i>

                                    <span style="font-size:15px">{{currency_symbol()}}&nbsp;{{$walletAmt}}</i></span>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

                </div>

                <div class="col-12 ">

                    <div class="card">

                        <div class="card-body">

                        {{-- <input type="hidden" id="type" value="Debit">

                            <ul class="nav nav-pills" id="myTab3" role="tablist">

                                <li class="nav-item">

                                    <a class="nav-link active tab_click tab_change" id="home-tab3" data-toggle="tab" href="#home3" role="tab"
                                        aria-controls="home" aria-selected="true" data-tab='Debit'>Deduction</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link tab_click tab_change" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                        aria-controls="profile" aria-selected="false" data-tab='Credit'>Recharge History</a>

                                </li>

                                <li class="nav-item">

                                    <a class="nav-link tab_click tab_change" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab"
                                        aria-controls="contact" aria-selected="false" data-tab='Refund'>Refunds</a>

                                </li>

                            </ul> --}}

                            <div class="tab-content" id="myTabContent2">

                                <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">

                                    <div class="">

                                        <table class="table table-striped table-hover" id="balance_table">

                                            <thead>

                                                <tr>

                                                    <th class="date-field">Date/Time</th>

                                                    <th>AWB</th>
                                                    
                                                    <th>Amount</th>

                                                    <th>Transaction ID</th>

                                                    <th>Bank Transaction ID</th>

                                                    <th>Type</th>

                                                    <th>Status</th>

                                                </tr>

                                            </thead>

                                            <tbody class="balance_table">


                                            </tbody>

                                        </table>

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

<script type="text/javascript">

var today = new Date().toISOString().split('T')[0];
        $('#from_date').attr('max', today);
        $('#to_date').attr('max', today);

      $('#date_range').change(function(){
            if($(this).val() == 'CustomDateRange'){
                $('#custom_date_from').removeClass('d-none');
                $('#custom_date_to').removeClass('d-none');
            } else {
                $('#custom_date_from').addClass('d-none');
                $('#custom_date_to').addClass('d-none');
            }
        });
    
    $(document).ready(function() {
            

        var table = $('#balance_table').DataTable({
        processing: true,
        serverSide: true,
        "bFilter": false,
        dom: 'rtlip',
        ajax: {
            url: "{{route('user.transaction-list')}}",
            type: "GET",
            datatype: "json",
            data: function(d) {
                    // d.status=$('#type').val();
                    
                     d.date_range = $('#date_range').val();
                     d.blance_filter = $('#blance_filter').val();
                    
                    }
        },
        columns: [
          { data: 'txn_date_time',orderable:true},
          { data: 'awb_no',orderable:true},
          { data: 'amount' ,orderable:true},

          { data: 'txnid',orderable:true},
          { data: 'banktxnid' ,orderable:true},

          { data: 'type',orderable:true },
          { data: 'status' ,orderable:true},
        ],
        "lengthMenu": [[50, 100, 200, 500,-1], [50, 100,200,500,"All"]],
        order: [
                [0, 'DESC']
            ]
      });
      $('#date_range').change(function(){
        table.ajax.reload();
      });
      $('#blance_filter').keyup(function(){
        table.ajax.reload();
      });

      

        $('.tab_change').click(function(){
        var type=$(this).attr('data-tab');
        var tabstatus=$(this).attr('data-status');

        $('#type').val(type);
        $('#shipstatus').val(tabstatus);

        
        table.ajax.reload();
        $('.tab_change').removeClass('active');

        $(this).addClass('active');

        });
      });

  </script> 

  

@endsection
