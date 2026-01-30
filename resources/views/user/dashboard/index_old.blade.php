@extends('user.dashboard.layout.master')
@section('user-contant')

<style>
   .all_orderborder{
   border-right:1px solid rgb(228 235 242);
   }
</style>
<body>
   <div class="loader"></div>
   <div id="app">
      <div class="main-wrapper main-wrapper-1 supreme-container">
         <div class="navbar-bg">
         </div>
         <!-- Main Content -->
         <div class="main-content">
            <section class="section" style="margin-top:-34px;">
               <div class="row ">
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                       <h5 class="font-15">COD Balance</h5>
                                       <h2 class="mb-3 font-18">0.00</h2>
                                       <p class="mb-0"><span class="col-green">18%</span>
                                          Increase
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                       <img src="user/assets/img/banner/3.png" alt="">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                       <h5 class="font-15">Wallet Balance</h5>
                                       <h2 class="mb-3 font-18">{{currency_symbol()}}0</h2>
                                       <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                       <img src="user/assets/img/banner/4.png" alt="">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--first row start-->
                  <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-xs-12 card">
                     <h3 class="font-22 pt-2"style="color:black;">Today</h3>
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">All Order</h3>
                                       <h2 class="mb-3 font-18 pt-3">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Create Order</h3>
                                       <h2 class="mb-3 font-18">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(255,192,0)">Processing</h3>
                                       <h2 class="mb-3 font-18 pt-3"style="color:rgb(255,192,0);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900; color:rgb(0,32,96);">Pending Pickup</h3>
                                       <h2 class="mb-3 font-18" style="color:rgb(0,32,96);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900; color:rgb(0,112,192);">Intransit</h3>
                                       <h2 class="mb-3 font-18 pt-3" style="color:rgb(0,112,192);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(84,130,53);">Delivered</h3>
                                       <h2 class="mb-3 font-18 pt-3" style="color:rgb(84,130,53);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(255,192,0)">OFD</h3>
                                       <h2 class="mb-3 font-18 pt-3"style="color:rgb(255,192,0);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(255,0,0);">RTO</h3>
                                       <h2 class="mb-3 font-18 pt-3" style="color:rgb(255,0,0);">0</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Lost</h3>
                                       <h2 class="mb-3 font-18 pt-3">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(255,0,0);">Cancelled</h3>
                                       <h2 class="mb-3 font-18 pt-3"style="color:rgb(255,0,0);">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;color:rgb(255,0,0);">Failed</h3>
                                       <h2 class="mb-3 font-18 pt-3"style="color:rgb(255,0,0);">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Manifest</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- first row end        -->
                  <!-- seconed row start -->
                  <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-xs-12 card">
                     <h3 class="font-22 pt-2"style="color:black;">Current Month</h3>
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">All Order</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Create Order</h3>
                                       <h2 class="mb-3 font-18 "> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Processing</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Pending Pickup</h3>
                                       <h2 class="mb-3 font-18"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Intransit</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Delivered</h3>
                                       <h2 class="mb-3 font-18 pt-3">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">OFD</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">RTO</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Lost</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Cancelled</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Failed</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Manifest</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- seconed row end -->
                  <!-- third row start -->
                  <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-xs-12 card">
                     <h3 class="font-22 pt-2"style="color:black;">Last Month</h3>
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">All Order</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Create Order</h3>
                                       <h2 class="mb-3 font-18">5</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Processing</h3>
                                       <h2 class="mb-3 font-18 pt-3">8 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Pending Pickup</h3>
                                       <h2 class="mb-3 font-18">6</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Intransit</h3>
                                       <h2 class="mb-3 font-18 pt-3">1 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Delivered</h3>
                                       <h2 class="mb-3 font-18 pt-3">2</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">OFD</h3>
                                       <h2 class="mb-3 font-18 pt-3">3</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">RTO</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Lost</h3>
                                       <h2 class="mb-3 font-18 pt-3">2 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Cancelled</h3>
                                       <h2 class="mb-3 font-18 pt-3">4</h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Failed</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Manifest</h3>
                                       <h2 class="mb-3 font-18 pt-3">11 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- third row end -->
                  <!-- four row start -->
                  <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-xs-12 card">
                     <h3 class="font-22 pt-2" style="color:black;">Courier Partners</h3>
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Xpressbees</h3>
                                       <h2 class="mb-3 font-18 pt-3">9 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Delhivery</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Ekart</h3>
                                       <h2 class="mb-3 font-18 pt-3">4 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">DTDC</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Shadowfax</h3>
                                       <h2 class="mb-3 font-18 pt-3">8 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Amazon</h3>
                                       <h2 class="mb-3 font-18 pt-3">3 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="card">
                        <div class="card-statistic-4">
                           <div class="align-items-center justify-content-between">
                              <div class="row ">
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Tekies</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Blue Dart</h3>
                                       <h2 class="mb-3 font-18 pt-3"> </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Ecom</h3>
                                       <h2 class="mb-3 font-18 pt-3">7 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Xpressbees Bulky Surface</h3>
                                       <h2 class="mb-3 font-18 pt-3">6 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Xpressbees Surface</h3>
                                       <h2 class="mb-3 font-18 pt-3">4 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 pr-0 pt-3 all_orderborder">
                                    <div class="card-content">
                                       <h3 class="font-13"style="font-weight:900;">Shree Maruti</h3>
                                       <h2 class="mb-3 font-18 pt-3">0 </h2>
                                       <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- four row end -->
               </div>
               <div class="row">
                  <div class="col-12 col-sm-12 col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <div class="row">
                              <div class="col-md-12">
                                 <select class=" form-control">
                                    <option value="---Download Your Order---">---Select Range---</option>
                                    <option value="Last seven days orders">Last seven days </option>
                                    <option value="Current Month Order">Current Month </option>
                                    <option value="Last Month Order">Last Month </option>
                                    <option value="All Time Order">All Time
                                    </option>
                                    <option value="Custom Date Range">Custom Date Range</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <ul class="nav nav-pills" id="myTab3" role="tablist">
                              <li class="nav-item">
                                 <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                    role="tab" aria-controls="home" aria-selected="true">Over All Performnce
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2"
                                    role="tab" aria-controls="profile" aria-selected="false">Zone Wise
                                 Performance</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                    role="tab" aria-controls="profile" aria-selected="false">Voulume Trend
                                 </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#profile4"
                                    role="tab" aria-controls="profile" aria-selected="false">Courier Wise
                                 Performance</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#profile5"
                                    role="tab" aria-controls="profile" aria-selected="false">State Wise </a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab6" data-toggle="tab" href="#profile6"
                                    role="tab" aria-controls="profile" aria-selected="false">SKU Wise</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab7" data-toggle="tab" href="#profile7"
                                    role="tab" aria-controls="profile" aria-selected="false">TAT Wise</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" id="profile-tab8" data-toggle="tab" href="#profile8"
                                    role="tab" aria-controls="profile" aria-selected="false">Service
                                 Type</a>
                              </li>
                           </ul>
                           <div class="tab-content" id="myTabContent2">
                              <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                 aria-labelledby="home-tab3">
                                 <table class="table table-responsive">
                                    <thead>
                                       <tr>
                                          <th scope="col">Over All Performnce</th>
                                          <th scope="col">Date </th>
                                          <th scope="col">Count</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                    </thead>
                                 </table>
                                 <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                       <div class="card ">
                                          <div class="card-header">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <select class="form-control  ">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Over All
                                                         Performnce
                                                      </option>
                                                      <option value="Current Month Order">Zone Wise
                                                         Performance
                                                      </option>
                                                      <option value="Last Month Order">Voulume Trend
                                                      </option>
                                                      <option value="All Time Order">Courier Wise
                                                         Performance
                                                      </option>
                                                      <option value="Custom Date Range">State Wise
                                                      </option>
                                                      <option value="Custom Date Range">SKU Wise
                                                      </option>
                                                      <option value="Custom Date Range">TAT Wise
                                                      </option>
                                                      <option value="Custom Date Range">Service Type
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6">
                                                   <select class="form-control " id="type">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Last
                                                         seven days orders
                                                      </option>
                                                      <option value="Current Month Order">Current
                                                         Month Order
                                                      </option>
                                                      <option value="Last Month Order">Last Month
                                                         Order
                                                      </option>
                                                      <option value="All Time Order">All Time
                                                         Order
                                                      </option>
                                                      <option value="Custom Date Range">Custom Date
                                                         Range
                                                      </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                   <h6>Over All Performnce</h6>
                                                   <div id="chart1"></div>
                                                   <div class="row mb-0">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="row mt-5">
                                                      <div class="col-7 col-xl-7 mb-3">Date </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">8,257</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Count</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$9,857</span>
                                                         <sup class="text-danger">-18%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Delivered</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">28</span>
                                                         <sup class="col-green">+16%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Intransit</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$6,287</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Undelivered /
                                                         Expection
                                                      </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">684</span>
                                                         <sup class="col-green">+22%</sup>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="profile2" role="tabpanel"
                                 aria-labelledby="profile-tab2">
                                 <table class="table ">
                                    <thead>
                                       <tr>
                                          <th>Zone</th>
                                          <th scope="col">Count</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                       <tr>
                                          <td>East</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <th>West</th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                       </tr>
                                       <tr>
                                          <td>North</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <th>South</th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                       </tr>
                                       <tr>
                                          <td>Central</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <th>North east</th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"></th>
                                          <th scope="col"></th>
                                          <th scope="col"> </th>
                                          <th scope="col"> </th>
                                       </tr>
                                    </thead>
                                 </table>
                                 <!-- seconed chart start -->
                                 <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                       <div class="card ">
                                          <div class="card-header">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <select class="form-control  ">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Over All
                                                         Performnce
                                                      </option>
                                                      <option value="Current Month Order">Zone Wise
                                                         Performance
                                                      </option>
                                                      <option value="Last Month Order">Voulume Trend
                                                      </option>
                                                      <option value="All Time Order">Courier Wise
                                                         Performance
                                                      </option>
                                                      <option value="Custom Date Range">State Wise
                                                      </option>
                                                      <option value="Custom Date Range">SKU Wise
                                                      </option>
                                                      <option value="Custom Date Range">TAT Wise
                                                      </option>
                                                      <option value="Custom Date Range">Service Type
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6">
                                                   <select class="form-control " id="type">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Last
                                                         seven days orders
                                                      </option>
                                                      <option value="Current Month Order">Current
                                                         Month Order
                                                      </option>
                                                      <option value="Last Month Order">Last Month
                                                         Order
                                                      </option>
                                                      <option value="All Time Order">All Time
                                                         Order
                                                      </option>
                                                      <option value="Custom Date Range">Custom Date
                                                         Range
                                                      </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                   <h6>Zone Wise Performance</h6>
                                                   <div id="chart2"></div>
                                                   <div class="row mb-0">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="row mt-5">
                                                      <div class="col-7 col-xl-7 mb-3">Date </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">8,257</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Count</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$9,857</span>
                                                         <sup class="text-danger">-18%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Delivered</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">28</span>
                                                         <sup class="col-green">+16%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Intransit</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$6,287</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Undelivered /
                                                         Expection
                                                      </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">684</span>
                                                         <sup class="col-green">+22%</sup>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="profile3" role="tabpanel"
                                 aria-labelledby="profile-tab3">
                                 <table class="table  ">
                                    <tbody>
                                       <tr>
                                          <th scope="col">Mode</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                       <tr>
                                          <td scope="col"> COD</td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td scope="col">Prepaid</td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td scope="col"> RVP</td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <!-- third chart start -->
                                 <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                       <div class="card ">
                                          <div class="card-header">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <select class="form-control  ">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Over All
                                                         Performnce
                                                      </option>
                                                      <option value="Current Month Order">Zone Wise
                                                         Performance
                                                      </option>
                                                      <option value="Last Month Order">Voulume Trend
                                                      </option>
                                                      <option value="All Time Order">Courier Wise
                                                         Performance
                                                      </option>
                                                      <option value="Custom Date Range">State Wise
                                                      </option>
                                                      <option value="Custom Date Range">SKU Wise
                                                      </option>
                                                      <option value="Custom Date Range">TAT Wise
                                                      </option>
                                                      <option value="Custom Date Range">Service Type
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6">
                                                   <select class="form-control " id="type">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Last
                                                         seven days orders
                                                      </option>
                                                      <option value="Current Month Order">Current
                                                         Month Order
                                                      </option>
                                                      <option value="Last Month Order">Last Month
                                                         Order
                                                      </option>
                                                      <option value="All Time Order">All Time
                                                         Order
                                                      </option>
                                                      <option value="Custom Date Range">Custom Date
                                                         Range
                                                      </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                   <h6>Voulume Trend</h6>
                                                   <div id="chart3"></div>
                                                   <div class="row mb-0">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="row mt-5">
                                                      <div class="col-7 col-xl-7 mb-3">Date </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">8,257</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Count</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$9,857</span>
                                                         <sup class="text-danger">-18%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Delivered</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">28</span>
                                                         <sup class="col-green">+16%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Intransit</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$6,287</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Undelivered /
                                                         Expection
                                                      </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">684</span>
                                                         <sup class="col-green">+22%</sup>
                                                      </div>
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
                                 <table class="table ">
                                    <tbody>
                                       <tr>
                                          <th>Courier </th>
                                          <th scope="col">Count</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                       <tr>
                                          <td>Amazon</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Blue Dart</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Delhivery Surface</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Delhivery Air</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Delhivery Bulky 5Kg</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Delhivery Bulky 10 Kg</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Ekart </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Shree Maruti Courier Air</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Shree Maruti Courier Surface</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Shadowfax</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>pressbees Surface</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Xpressbees Air</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Xpressbees Bulky</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <!-- fourth chart start -->
                                 <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                       <div class="card ">
                                          <div class="card-header">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <select class="form-control  ">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Over All
                                                         Performnce
                                                      </option>
                                                      <option value="Current Month Order">Zone Wise
                                                         Performance
                                                      </option>
                                                      <option value="Last Month Order">Voulume Trend
                                                      </option>
                                                      <option value="All Time Order">Courier Wise
                                                         Performance
                                                      </option>
                                                      <option value="Custom Date Range">State Wise
                                                      </option>
                                                      <option value="Custom Date Range">SKU Wise
                                                      </option>
                                                      <option value="Custom Date Range">TAT Wise
                                                      </option>
                                                      <option value="Custom Date Range">Service Type
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6">
                                                   <select class="form-control " id="type">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Last
                                                         seven days orders
                                                      </option>
                                                      <option value="Current Month Order">Current
                                                         Month Order
                                                      </option>
                                                      <option value="Last Month Order">Last Month
                                                         Order
                                                      </option>
                                                      <option value="All Time Order">All Time
                                                         Order
                                                      </option>
                                                      <option value="Custom Date Range">Custom Date
                                                         Range
                                                      </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                   <h6>Courier Wise Performance</h6>
                                                   <div id="chart4"></div>
                                                   <div class="row mb-0">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="row mt-5">
                                                      <div class="col-7 col-xl-7 mb-3">Date </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">8,257</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Count</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$9,857</span>
                                                         <sup class="text-danger">-18%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Delivered</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">28</span>
                                                         <sup class="col-green">+16%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Intransit</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$6,287</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Undelivered /
                                                         Expection
                                                      </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">684</span>
                                                         <sup class="col-green">+22%</sup>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="profile5" role="tabpanel"
                                 aria-labelledby="profile-tab5">
                                 <table class="table ">
                                    <thead>
                                       <tr>
                                          <th scope="col">State Wise </th>
                                          <th scope="col">State </th>
                                          <th scope="col">Count</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <div class="row">
                                    <div class="col-12 col-sm-12 col-lg-12">
                                       <div class="card ">
                                          <div class="card-header">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <select class="form-control  ">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Over All
                                                         Performnce
                                                      </option>
                                                      <option value="Current Month Order">Zone Wise
                                                         Performance
                                                      </option>
                                                      <option value="Last Month Order">Voulume Trend
                                                      </option>
                                                      <option value="All Time Order">Courier Wise
                                                         Performance
                                                      </option>
                                                      <option value="Custom Date Range">State Wise
                                                      </option>
                                                      <option value="Custom Date Range">SKU Wise
                                                      </option>
                                                      <option value="Custom Date Range">TAT Wise
                                                      </option>
                                                      <option value="Custom Date Range">Service Type
                                                      </option>
                                                   </select>
                                                </div>
                                                <div class="col-md-6">
                                                   <select class="form-control " id="type">
                                                      <option value="---Download Your Order---">
                                                         ---Select Range---
                                                      </option>
                                                      <option value="Last seven days orders">Last
                                                         seven days orders
                                                      </option>
                                                      <option value="Current Month Order">Current
                                                         Month Order
                                                      </option>
                                                      <option value="Last Month Order">Last Month
                                                         Order
                                                      </option>
                                                      <option value="All Time Order">All Time
                                                         Order
                                                      </option>
                                                      <option value="Custom Date Range">Custom Date
                                                         Range
                                                      </option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="card-body">
                                             <div class="row">
                                                <div class="col-lg-9">
                                                   <h6>Courier Wise Performance</h6>
                                                   <div id="chart5"></div>
                                                   <div class="row mb-0">
                                                   </div>
                                                </div>
                                                <div class="col-lg-3">
                                                   <div class="row mt-5">
                                                      <div class="col-7 col-xl-7 mb-3">Date </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">8,257</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Count</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$9,857</span>
                                                         <sup class="text-danger">-18%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Delivered</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">28</span>
                                                         <sup class="col-green">+16%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Intransit</div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">$6,287</span>
                                                         <sup class="col-green">+09%</sup>
                                                      </div>
                                                      <div class="col-7 col-xl-7 mb-3">Undelivered /
                                                         Expection
                                                      </div>
                                                      <div class="col-5 col-xl-5 mb-3">
                                                         <span class="text-big">684</span>
                                                         <sup class="col-green">+22%</sup>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tab-pane fade" id="profile6" role="tabpanel"
                                 aria-labelledby="profile-tab6">
                                 <table class="table ">
                                    <thead>
                                       <tr>
                                          <th scope="col">KU Wise </th>
                                          <th scope="col">Product</th>
                                          <th scope="col">Count</th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit </th>
                                          <th scope="col">Undelivered / Expection</th>
                                          <th scope="col">RTO</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Delivered</th>
                                          <th scope="col">Intransit</th>
                                          <th scope="col">Undelivered / Expection </th>
                                          <th scope="col">RTO </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="tab-pane fade" id="profile7" role="tabpanel"
                                 aria-labelledby="profile-tab7">
                                 <table class="table ">
                                    <tbody>
                                       <tr>
                                          <th scope="col">Count</th>
                                          <th scope="col">A</th>
                                          <th scope="col">B </th>
                                          <th scope="col"> C</th>
                                          <th scope="col">D</th>
                                          <th scope="col">E </th>
                                          <th scope="col">F</th>
                                          <th scope="col">Percentage</th>
                                          <th scope="col">A</th>
                                          <th scope="col">B </th>
                                          <th scope="col"> C</th>
                                          <th scope="col">D</th>
                                          <th scope="col">E </th>
                                          <th scope="col">F</th>
                                       </tr>
                                       <tr>
                                          <td>Before TAT</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>On TAT</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Out of TAT</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="tab-pane fade" id="profile8" role="tabpanel"
                                 aria-labelledby="profile-tab8">
                                 <table class="table ">
                                    <tbody>
                                       <tr>
                                          <th scope="col">Priority</th>
                                          <th scope="col">Count </th>
                                          <th scope="col">Before TAT </th>
                                          <th scope="col"> On TAT</th>
                                          <th scope="col">Out of TAT</th>
                                          <th scope="col">Percentage </th>
                                          <th scope="col">Before TAT</th>
                                          <th scope="col">On TAT</th>
                                          <th scope="col">Out of TAT</th>
                                       </tr>
                                       <tr>
                                          <td>SDD</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>NDD</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                       <tr>
                                          <td>Statndard</td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"></td>
                                          <td scope="col"></td>
                                          <td scope="col"> </td>
                                          <td scope="col"> </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
   <!-- recharge model  -->
   <script src="https://unpkg.com/sweetalert%402.1.2/dist/sweetalert.min.js"></script>
   <style>
      .modal-backdrop.show {
      opacity: 0 !important;
      z-index:0;
      }
   </style>
   @endsection