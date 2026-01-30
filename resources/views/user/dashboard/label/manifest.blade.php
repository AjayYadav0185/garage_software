@extends('user.dashboard.layout.master')
@section('user-contant')
<style>
    .costum_modalcss {
    margin-top: 4rem;
}
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

.dhjvsdghv{
        min-width:100px;
    }
    table thead tr th{
        min-width:65px;
    }
    .Update_class{
      background-color:#93D9F1 !important;
      font-weight:600;
    }
      
  
    .custom-file-input {
 
    opacity: 1 !important;
    border:1px solid rgb(187 184 184);
    padding-top: 3px;
    padding-left: 4px;
}

.center{
    text-align:center;
}

th{
    text-align:center!important;
}

td{
    padding:0px 10px!important;
}
  


</style>

<div class="main-content">
    <section class="section" style="margin-top:-34px;">
        <div class="section-body">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="display: block;">

                        <div class="row" >
                            <div class="col-sm-10">
                            <h4 class="float-left">Manage Pickup & Manifest</h4>
                            </div>
                            <div class="col-sm-2 text-center">
                                <a href="{{route('user.shipment')}}" class="btn btn-primary mr-1 go_forbtn float-right" style="color:white;border-radius: 5px;padding: 0.3rem 0.8rem !important;" data-toggle="tooltip" data-placement="top" title="Go Back" type="submit" ><i class="fa-sharp fa fa-arrow-left"></i></a>
                            </div>
                            </div>
                           
                        </div>
                        <hr>
                        <div class="card-header-form">
                            <div class=" text-right " style="margin-right:2% ;">
                                <a  href="javascript:void()" onclick="window.location.href='{{route('user.manifest')}}'" class="btn btn-outline-primary" type="reset">&nbsp;Refresh &nbsp;</i></a>
                                <a href="#" class="btn btn-outline-primary"
                                    onclick="myFunction()">&nbsp;Filter&nbsp;</i></a>
                                <a href="javascript:void(0)"><button type="button" id="upload_report"  name="upload_report" class="btn btn-outline-primary">&nbsp;Export&nbsp;</button></i></a>
                                
                            </div>

                        </div>

                       
        <div class="col-md-12 my-2 " id="myDIV" style="display: none;">
            <div class="card  ">
                <div class="card-header">
                    <h4>Filter</h4>
                    <div class="card-header-action">
                    </div>
                </div>
            <div class="card-body  " style="background-color: #bfbfbf;">
                <form class="order_filter" method="post" id="IdFilterData">
                {!! csrf_field() !!}
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label" style="color:#0d0d0d ;">Date Range</label>
                        <div class="list-inline text-center">
                            <div class="form-group ">
                                <select class="form-control " id="date_range" name="date_range"> 
                                    <option value="">---Select Data Range---</option>
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="-7 days">Last seven days </option>
                                    <option value="first day of">Current Month </option>
                                    <option value="-1 months">Last Month </option>
                                    <option value="All Time Order">All Time
                                    </option>
                                    <option value="CustomDateRange">Custom Date Range</option>
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


                    <div class="col-md-3">
                        <label class="form-label" style="color:#0d0d0d ;">Courier</label>
                        <div class="form-group">
                            <select class="form-control" id="courier" name="courier">
                            <option value="" >Select</option>
                                @foreach($couriersList as $couriers)
                                <option value="{{$couriers->id}}">{{$couriers->courier_name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" style="color:#0d0d0d ;">Warehouse</label>
                        <div class="form-group">
                            <select class="form-control" id="warehouse" name="warehouse">
                                

                                <option value="" >Select</option>
                                @foreach($pickupAddresses as $pickup)
                                <option value="{{$pickup->id}}">{{$pickup->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    


                   
                    
                    
                    
                    <div class="col-md-3 my-2">
                        <label class="form-label"></label>
                        <div class="form-group" style="margin-top:1% ;">
                            

                            <button type="button" class="btn btn-outline-primary" id="filterButton"> Search....</button>

                        </div>

                    </div>

                </div>
                
                </form>

             </div>
                            </div>
                        </div>
                        


                <div class="card-body">

                    <input type="hidden" id="order_status1" value="Pending">
                    <input type="hidden" id="shipstatus" value="0">
                    
                    <div class="tab-content excel" id="myTabContent2">
                        
                        <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered center" id="profile3-table">
                                    <thead> 
                                    <tr>
                                        <th>Date</th>
                                        <th>Courier </th>
                                        <th>Warehouse</th>
                                        <th>Count</th>
                                        <th>Pickup Scheduled</th>
                                        <th>Manifest / Label</th>
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody class="tbodyfiltr_data">
                                    
                                        
                                    
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






<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.2/xlsx.full.min.js"></script>

<script>

function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    

    $(document).ready(function() {
      var _ = $('body');
      
      var table = $('#profile3-table').DataTable({
        processing: true,
        serverSide: true,
        dom: 'rtlip',
        ajax: {
            url: "{{route('user.manifest-list-ajax')}}",
            type: "GET",
            datatype: "json",
            data: function(d) {
                    d.courier=$('#courier').val();
                    d.warehouse = $('#warehouse').val();
                    d.date_range = $('#date_range').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
        },
        columns: [
          { data: 'Rec_Time_Date',orderable:true,width: '75px' },
          { data: 'courier_name',orderable:true,width: '250px'},
          { data: 'warehouse_name' ,orderable:true,width: '250px'},
          { data: 'total',orderable:true ,width: '75px'},
          { data: 'pickupSchedule' ,orderable:true,width: '150px'},
          { data: 'action',orderable:false },
          
        ],
        "lengthMenu": [[25,50, 100, 200, 500,-1], [ 25, 50, 100,200,500,"All"]],
        order: [
                [0, 'DESC']
            ]
        
        
      });
      
      $('#filterButton').click(function(){
        table.ajax.reload();
      });

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


        $('body').on('click', '.printmanifest', function() {
        //    alert("hiii");
            var awbno = $(this).attr('data-id');
            console.log(awbno);
            
            if (awbno.length >= 1) {
                window.location.href = `{{ route('user.getmanifestprint') }}?awbno=${awbno}`;
            } else {
                toastr.error('Something went wrong ..');
            }
        });

    

    $('body').on('click', '.printlabel', function() {
    
        var awbno = $(this).attr('data-id');
        if (awbno.length >= 1) {
            window.location.href = `{{ route('user.getlabel') }}?awbno=${awbno}`;
        } else {
            toastr.error('Something went wrong ..');
        }
    });

    document.getElementById('upload_report').addEventListener('click', function () {

    const element = document.querySelector('.excel');

    const currentDate = new Date();

    const formattedDate = currentDate.toLocaleString();

    const sanitizedDate = formattedDate.replace(/[:/ ]/g, '_');

    const fname ='Pickup_pending' + sanitizedDate;

    const table = document.querySelector('table');

    const ws = XLSX.utils.table_to_sheet(table);

    const wb = XLSX.utils.book_new();

    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    XLSX.writeFile(wb, fname+'.xlsx');

    });

});
    
</script>
@endsection


