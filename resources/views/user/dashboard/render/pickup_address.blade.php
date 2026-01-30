<div class="col-md-12 ">
  <h6 style="color:black;">Pickup Address <i class="fa fa-check" style="color: #05a818; font-size:20px;"></i></h6>
	    <div class="row">
       
    	    <div class="col-md-12">
				<p>{{$pickupAddress->name}},</br>{{$pickupAddress->address}},&nbsp;&nbsp;&nbsp;{{$pickupAddress->city}},&nbsp;&nbsp;{{$pickupAddress->state}}&nbsp;,&nbsp;&nbsp;{{$pickupAddress->pin}},{{$pickupAddress->Gstin}}<br>{{$pickupAddress->phone}}</p>

    	    	<input type="hidden" name="pickupaddressid" value="{{$pickupAddress->id}}">
    	    	<input type="hidden" name="originpincode"
										id="originpincode"
										class="form-control phone-number"
										maxlength="6" value="{{$pickupAddress->pin}}">
    	    	 <input type="hidden" name="originpin-city"
		                id="originpin-city" value="{{$pickupAddress->city}}">
		            <input type="hidden" name="originpin-state"
		                id="originpin-state" value="{{$pickupAddress->state}}">
		            <input type="hidden" name="originpin-country"
		                id="order_type" value="single_order">

    	    </div>

    	    

	    </div>

	</div>

	<br>