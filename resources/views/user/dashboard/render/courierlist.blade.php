<option val="">Select Courier</option>
@foreach($getData as $courier)

<option value="{{$courier->id}}"> {{$courier->courier_name}} </option>
@endforeach
