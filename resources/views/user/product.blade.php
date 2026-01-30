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
table.dataTable{
    width: 100% !important;
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
.dataTables_length{
    margin-top: 15px!important;

}
th{
    text-align: center!important;
}


</style>

<div class="main-content">
    <section class="section" style="margin-top:-34px;">
        <div class="section-body">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="display: block;">
                           

                          <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('user.index') }}" 
                                                class="btn btn-primary go_forbtn" 
                                                style="color: white; border-radius: 5px; padding: 0.3rem 0.8rem;" 
                                                data-toggle="tooltip" 
                                                data-placement="top" 
                                                title="Go Back">
                                                <i class="fa-sharp fa fa-arrow-left"></i>
                                            </a>&nbsp;
                                            <h4 class="mb-0">Product Category</h4>
                                        </div>
                                        <a href="javascript:void(0)" id="addproduct"
                                        class="btn btn-primary " 
                                        style="text-decoration: none; color: white; border-radius: 5px; padding: 0.3rem 0.8rem;" 
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Add">Add
                                     </a>                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="card-body">
                <div class="tab-content excel" id="myTabContent2" style="text-align: center;">

                    <div class="row addforn" style="display:none;">
                        <form action="" class="d-flex align-items-center gap-2" method="POST" id="addform">
                            @csrf
                            <input type="hidden" id="id" name="id">
                            {{-- <label for="product-name" class="me-2">Product Category</label>&nbsp; --}}
                            <input type="text" class="form-control w-auto" name="product_name" id="product_name" placeholder="Product Category Name" required>&nbsp; &nbsp;
                            <button class="btn btn-primary" type="submit">Save</button>
                        </form>
                    </div>                                             
                                
                    <div class="tab-pane fade show active my-2" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="datatable">
                                <thead>

                                    <tr>

                                        <th>SR No.</th>

                                        <th>Product Category Name</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>
                                <tbody class="tbodyfiltr_data"></tbody>
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

<script>

  $(document).ready(function(){

    $('#addproduct').on('click' , function(){
        // alert('Calling');
        $('.addforn').css('display' , 'block');
    });

    $('#addform').on('submit' , function(e){
        e.preventDefault();
        // alert('Hello');
        var formdata = $(this).serialize();

        $.ajax({
            url : "{{route('product_save')}}",
            type : "POST",
            data : formdata,
            success : function(response){
                // console.log(response);

                if(response.status == 'success'){

                    Swal.fire({
                   icon: 'success',
                   title: 'Success',
                   text: Response.message,
                   // width: '400px'
                   customClass: {
           popup: 'small-swal-popup',
           htmlContainer: 'custom-text-color', 
           title: 'custom-title-color' 
       }
               });

               window.location.reload();

                }

                if(response.status == 'error'){

                    Swal.fire({
                   icon: 'error',
                   title: 'Error!',
                   text: 'Please Select Order',
                   // width: '400px'
                   customClass: {
           popup: 'small-swal-popup',
           htmlContainer: 'custom-text-error-color', 
           title: 'custom-title-error-color' 
       }
               });

                }

            }
        });
    });

    // table

    var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        language: {
        search: "_INPUT_",
        searchPlaceholder: "Search"
        },
        dom: 'ftlip',
        ajax: {
            url: "{{route('product_list')}}",
            type: "GET",
            datatype: "json",
            data: function(d) {
                    d.status=$('#status').val();

            }
        },
        columns: [
                    { data: 'id',orderable:false},
                    { data: 'name',orderable:true},
                    { data: 'action'},
                ],
        "lengthMenu": [[50, 100, 200, 500,-1], [50, 100,200,500,"All"]],
        order: [
                [2, 'DESC']
            ]
      });

      $('body').on('click' , '.delete' , function(){
        // alert('hello');
        var id = $(this).attr('data-id');
        // alert(id);
        $.ajax({
            url  : "{{route('product_delete')}}",
            type : "GET",
            data : {'delete' : id},
            success : function(response){
                // console.log(response);

                if(response.status == 'success'){

Swal.fire({
icon: 'success',
title: 'Success',
text: Response.message,
// width: '400px'
customClass: {
popup: 'small-swal-popup',
htmlContainer: 'custom-text-color', 
title: 'custom-title-color' 
}
});

window.location.reload();

}

if(response.status == 'error'){

Swal.fire({
icon: 'error',
title: 'Error!',
text: 'Please Select Order',
// width: '400px'
customClass: {
popup: 'small-swal-popup',
htmlContainer: 'custom-text-error-color', 
title: 'custom-title-error-color' 
}
});

}

            }
        });
      });

    //   featch record 

    $('body').on('click' , '.edit' , function(){
        // alert('Calling fetch');
        var id = $(this).attr('data-id');

        $.ajax({
            url : "{{route('product_delete')}}",
            type : "GET",
            data : {'edit' : id},
            success : function(response){
                console.log(response);

                if(response.status == "success"){
                    $('.addforn').css('display' , 'block');
                  $('#product_name').val(response.data.name);
                  $('#id').val(response.data.id);

                }

            }
        });

    });

  });

</script>

@endsection


