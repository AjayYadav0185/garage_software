@if (!empty($pincodes))
    @foreach ($pincodes as $pincode)
        <div class="col-md-12 p-0" style=" margin-bottom:50px;font-size:18px;border-bottom:2px solid gold">
            <div class="card mb-3">
                <div class="card-body d-flex flex-wrap">
                    <div class="col-md-6 mb-2">
                        <strong>PinCode: </strong> {{ $pincode->pincode }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Area Code: </strong> {{ $pincode->areacode }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Progress Code: </strong> {{ $pincode->processcode }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Hub Zone Name: </strong> {{ $pincode->hubzonename }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Hub City: </strong> {{ $pincode->hubcity }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Hub State: </strong> {{ $pincode->hubstate }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>COD: </strong> {{ $pincode->cod }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Prepaid: </strong> {{ $pincode->prepaid }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Has Reverse Pickup Service: </strong> {{ $pincode->hasreversepickupservice }}
                    </div>
                </div>
            </div>
            

            <div class="col-md-6"></div>
            <div class="col-md-12">
                <center>
                    <!-- <button type="button" class="btn" style="background-color:#009688;border-color:#009688;color:white;border-radius:10px" data-toggle="modal" data-target="#myModal{{ $pincode->pincode }}">
            &ensp;&ensp; Click Here To Disable Pincode For Clients &ensp;&ensp;
        </button> -->
                </center>

                <div class="modal fade" id="myModal{{ $pincode->pincode }}" role="dialog">
                    <div class="modal-dialog modal-lg">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Select Client To Disable <span
                                        style="color:blue">{{ $pincode->pincode }}</span> Pincode</h4>
                            </div>
                            <div class="modal-body">
                                <!--  -->
                                <div class="container-fluid">
                                    <!--  --><!--  -->
                                    @foreach ($allClients as $client)
                                        <div class="col-md-6" style="border:1px solid #60baaf;">
                                            <div class="row">
                                                <div class="col-md-10" style="float:left;padding:0px;font-size:13px">
                                                    {{ $client->Company_Name }}
                                                    ({{ substr($client->commercialstype, 2) . '' . strtoupper(substr($client->commercialstype, 0, 2)) }})
                                                    <input type="hidden" name="selectedclientid[]"
                                                        value="{{ $client->User_Id }}">
                                                </div>
                                                <div class="col-md-2" style="float:right;padding:0px">
                                                    @php
                                                        // Assuming $client->pincode exists and contains the pincode for this iteration
                                                        $pincode = $client->pincode;
                                                        $clientidisa = $client->User_Id;
                                                        // Assuming each client has disableclientids attribute
                                                        $crtusers = explode(',', $client->disableclientids);
                                                    @endphp

                                                    @if (in_array($clientidisa, $crtusers))
                                                        <label class="switch" style="padding:0px">
                                                            <input type="checkbox"
                                                                onclick="disablepin('{{ $pincode }}','{{ $clientidisa }}','on')"
                                                                checked>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    @else
                                                        <label class="switch" style="padding:0px">
                                                            <input type="checkbox"
                                                                onclick="disablepin('{{ $pincode }}','{{ $clientidisa }}','off')">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--  --><!--  -->
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endforeach
@endif

<script type="text/javascript">
    function disablepin(pincode, idisa, smode) {
        // alert(pincode);
        // alert(idisa);
        $.ajax({
            type: "GET",
            url: "ServiceableNotPincodeActiveCode/ClientNotUsethisservice.php",
            data: {
                idisa: idisa,
                pincode: pincode,
                smode: smode
            },
            success: function(data) {
                // alert(data);
                return view('your_partial_view', ['records' => $data]) - > render();

            },
            error: function(data) {
                alert('data');
                // return view('your_partial_view', ['records' => $data])->render();
            }
        });
    }
</script>
