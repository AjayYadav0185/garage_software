<style type="text/css">
    .table.table-bordered td, .table.table-bordered th {
    align-content: center;
    text-align: center;
    align-items: center;
    border-color: #f6f6f6;
}
.table.table-md th, 
.table.table-md td {
    padding: 5px;
}
</style>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-md">
            <tr>
                {{-- <th></th> --}}
                <th>Logo</th>
                <th>Courier</th>
                
                <th>Estimated Delivery Time</th>
                {{-- <th>Courier Charges</th>
                <th>COD Charges</th> --}}
                {{-- <th>GST</th>
                <th>Total Amount</th> --}}
            </tr>
            @php $modelid = 0; @endphp
            @foreach ($courierpermissions as $courierpermission)
                @php $modelid++; @endphp
                
                
                <tr>
                {{-- <td><input type="radio" name="awb_gen_by" class="qwerty" value ="{{$courierpermission['courier_id']}}"></td> --}}
                    <td><img alt="courier_logo" height="45px" width="45px" src="{{ asset('user/assets/img/courier_logo/' . $courierpermission['logo']) }}"></td>
                    <td>
                        @if($courierpermission['mode'] == 'Surface')
                        {{ $courierpermission['courier'] }} 
                        <img alt="logo" height= "10px" src="{{ asset('assets/images/icon/truck-solid.svg') }}">


                        <!-- <i class="fa fa-truck"></i> -->
                        @else
                        {{ $courierpermission['courier'] }} <i class="fa fa-plane"></i>
                        @endif
                    </td>
                    
                    <td>{{ $courierpermission['tat'] }}</td>
                    {{-- <td>{{ $courierpermission['courierschage'] }}</td>
                    <td>{{ $courierpermission['newcodchange'] }}</td> --}}
                    {{-- <td>{{$courierpermission['gstamt']}}</td> --}}
                    {{-- <td>{{ $courierpermission['newtotalamt'] }}</td>  --}}
                </tr>
            @endforeach
        </table>
    </div>
</div>
