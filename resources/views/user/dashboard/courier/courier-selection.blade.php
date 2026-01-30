@extends('user.dashboard.layout.master')
@section('user-contant')
<style>
  th ,td {
    padding: 10px;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
  }
  .tab_shadow{
       background-color: #fff;
    border-radius: 10px;
    border: none;
    position: relative;
    margin-bottom: 30px;
    box-shadow: 0 0.46875rem 2.1875rem rgba(90,97,105,0.1), 0 0.9375rem 1.40625rem rgba(90,97,105,0.1), 0 0.25rem 0.53125rem rgba(90,97,105,0.12), 0 0.125rem 0.1875rem rgba(90,97,105,0.1);
}  
  }
</style>
<style>
    .nav-pills .nav-item .nav-link:hover {
    background-color: #e2e60a;
    margin-left:4px !important;
}
.theme-white .nav-pills .nav-link.active {
    color: #fff;
    background-color: #6777ef;
      margin-left:4px !important; 
        margin-bottom:4px !important; 
}
.nav-pills .nav-item .nav-link {
    color: #6777ef;
    /* padding-left: 15px !important; */
    /* padding-right: 15px !important; */
    margin-left: 4px;
     margin-bottom:4px !important; 
}
</style>
    <div class="main-content supreme-container">
        <section class="section" style="margin-top:-34px;">
            <div class="section-body">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Select Courier Priority</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2">
                                    <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#home4"
                                               role="tab" aria-controls="home" aria-selected="true">Courier Wise</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4"
                                               role="tab" aria-controls="profile" aria-selected="false">Lane wise</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 col-sm-12 col-md-1"></div>
                                <div class="col-12 col-sm-12 col-md-8 tab_shadow">
                                    <div class="tab-content no-padding" id="myTab2Content">
                                        <div class="tab-pane fade show active" id="home4" role="tabpanel"
                                             aria-labelledby="home-tab4">
                                            <div class="card-body">
                                                <ul class="nav nav-pills" id="myTab3" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="home-tab3" data-toggle="tab"
                                                           href="#home3" role="tab" aria-controls="home"
                                                           aria-selected="true">Recommended By Rappidx</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="profile-tab3" data-toggle="tab"
                                                           href="#profile3" role="tab" aria-controls="profile"
                                                           aria-selected="false">Customize</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent2">
                                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                                         aria-labelledby="home-tab3">
                                                        Amazon
                                                    </div>
                                                    <div class="tab-pane fade" id="profile3" role="tabpanel"
                                                         aria-labelledby="profile-tab3">
                                                        <div class="">
                                                            <div class="">
                                                                <div class="card-header">
                                                                    <h4>Drag & Drop Row</h4>
                                                                    <div class="card-header-action">
                                                                    </div>
                                                                </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-hover table-striped py-5">
                                        <thead>
                                        <tr class="table-active">
                                            <th class="border">
                                                <strong
                                                    style="color: black;"><i
                                                        class="fas fa-th text-dark"></i></strong>
                                            </th>
                                            <th class="border">
                                                <strong
                                                    style="color: black;">Courier
                                                    Name</strong></th>
                                            <th class="border">
                                                <strong
                                                    style="color: black;">Due
                                                    Date</strong></th>
                                        </tr>
                                        </thead>
                                <tbody class="sortable-table">
                                @forelse($courierData as $courier)
                                    <tr id="{{ $courier->id }}">
                                        <td class="border">
                                            <div class="sort-handler ">
                                                <i
                                                    class="fas fa-th"></i>
                                            </div>
                                        </td>
                                        <td class="border">{{ $courier->courier_name }}</td>
                                        <td
                                            class="text-center border"></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No records found</td>
                                    </tr>
                                @endforelse
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
                                        <div class="tab-pane fade" id="profile4" role="tabpanel"
                                             aria-labelledby="profile-tab4">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th>courier</th>
                                                        <th>
                                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                       data-checkbox-role="dad"
                                                                       class="custom-control-input">
                                                                <label for="checkbox-all"
                                                                       class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td>courier1</td>
                                                        <th>
                                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                                <input type="checkbox" data-checkboxes="mygroup"
                                                                       data-checkbox-role="dad"
                                                                       class="custom-control-input">
                                                                <label for="checkbox-all"
                                                                       class="custom-control-label">&nbsp;</label>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </table>
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

   
    <script type="text/javascript">
        $(function () {
            $(".sortable-table").sortable({
                dealy: 150,
                stop: function () {
                    var selectedData = [];
                    $('.sortable-table>tr').each(function () {
                        selectedData.push($(this).attr('id'));
                    });
                    updateOrder(selectedData);
                }
            });
        });


        function updateOrder(data) {
            $.ajax({
                url: "change-courier-priority.php",
                type: "post",
                data: {data},
                success: function (response) {
                    console.log(response);
                }
            })
        }
    </script>
@endsection


    

