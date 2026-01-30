<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manifest Report</title>
  <style>
    body {
      text-align: center;
    }
    .container {
      margin: 0 ;
      max-width: 800px; /* Adjust as needed */
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }
    /* Hide horizontal scrollbar in Firefox */
    @-moz-document url-prefix() {
      .container {
        overflow-x: hidden;
      }
    }
    /* Responsive adjustments */
    @media screen and (max-width: 768px) {
      .container {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="container my-5">
    
      
        <h2 style="text-align: left; padding: 0; margin:0;">Manifest Report</h2>
        <h4 style="text-align: right; padding:0; margin:0;">Date: {{ date('d-m-Y') }}</h4>
        <h3 style="text-align: left;">Courier Name - {{$data[0]->courier_name}}</h3>
      
      
    

    <div class="table-scroll">
      <table>
        <tr>
          <th>Sr No.</th>
          <th>Order Id</th>
          <th>AWB</th>
          <th>Weight</th>
          <th>Product</th>
          <th>Mode</th>
          <th>Value</th>
          
          
        </tr>
        @php $counter = 1; @endphp
        @foreach($data as $row)
        <tr>
          <td>{{ $counter }}</td>
          <td>{{$row->orderno}}</td>
          <td>{{$row->Awb_Number}}</td>
          <td>{{$row->ChargeableWeight}}</td>
          <td>{{$row->Item_Name}}</td>
          <td>{{$row->Order_Type}}</td>
          <td>{{$row->Invoice_Value}}</td>
          
        </tr>
        @php $counter++; @endphp
        @endforeach
      </table>
    </div>

    &nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp; &nbsp;&nbsp;
    &nbsp;&nbsp; &nbsp;&nbsp;
    &nbsp;&nbsp; &nbsp;&nbsp;

    <h1>To be filled by picker</h1>

    <div class="table-scroll">
      <table>
        <tr>
          <th>Picker Name</th>
          <th>Pickup Date</th>
          <th>Pickup Time</th>
          <th>No. of Packets Picked</th>
          <th>Picker Contact Number</th>
          <th>Signature</th>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;</td>
          <td>&nbsp;&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
</body>
</html>
