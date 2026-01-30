<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shipping Label</title>
  <style>
    body { 
      text-align: center; 
      font-family: sans-serif; 
      font-size: 12px; 
    }
    .container { margin: 0 auto; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 8px; }
    th, td { border: 1px solid black; padding: 6px; text-align: center; }
    th { background-color: #f2f2f2; }
    p { margin: 2px 0; }
  </style>
</head>
<body>
  <div class="container">

  @foreach($query as $data)

    <table>
      <tr>
        <td>
          @if ($settings->userlogo == 1 || $settings->channel_logo == 1)
            @if (Auth::user()->brand_logo)
              <img src="{{ public_path('storage/'.Auth::user()->brand_logo) }}" alt="Logo" width="150">
            @else
              <img src="{{ public_path('assets/icon/logo.png') }}" alt="Logo" width="150">
            @endif
          @else
            <img src="{{ public_path('assets/icon/logo.png') }}" alt="Logo" width="150">
          @endif
        </td>
        <td>
          <p><strong>Customer Name :</strong> {{ $data->Name ?? '' }}</p>
          <p><strong>Address :</strong> {{ $data->Address ?? '' }} , {{ $data->State ?? '' }}</p>
          <p><strong>Pincode :</strong> {{ $data->Pincode ?? '' }}</p>
          @if ($settings->user_hidemobile != 1)
            <p><strong>Mobile :</strong> {{ $data->Mobile ?? '' }}</p>
          @endif
        </td>
        <td>
          @if ($settings->payment_status == 0)
            <p style="font-weight:bold;">
              {{ $data->Order_Type ?? '' }}
              @if(strtolower($data->Order_Type) == 'cod')
                : {{currency_symbol() .  $data->Invoice_Value ?? '' }}
              @endif
            </p>
          @endif
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td style="font-weight:bold;">AWB - {{ $data->Awb_Number ?? '' }}</td>
        <td>
          <img src="data:image/png;base64,{{ generateBarCode($data->Awb_Number) ?? '-' }}" width="220" height="80">
        </td>
        <td>
          {{ getCourierNameById($data->courier_id) ?? '' }} <br>
       
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td>Order ID: {{ $data->orderno ?? '' }}</td>
        <td>Date: {{ date('d-m-Y', strtotime($data->Rec_Time_Date)) }}</td>
      </tr>
    </table>

    <table>
      <tr>
        @if ($settings->hide_product != 1) <th>Product</th> @endif
        @if ($settings->hide_qty != 1) <th>Quantity</th> @endif
        @if ($settings->hide_value != 1) <th>Value</th> @endif
      </tr>
      <tr>
        @if ($settings->hide_product != 1) <td>{{ $data->Item_Name ?? '' }}</td> @endif
        @if ($settings->hide_qty != 1) <td>{{ $data->Quantity ?? '' }}</td> @endif
        @if ($settings->hide_value != 1) <td>{{ $data->Invoice_Value ?? '' }}</td> @endif
      </tr>
    </table>

    <table>
      <tr>
        @if ($settings->hide_weight != 1)
          <td>Weight (kg): {{ $data->ChargeableWeight ?? '' }}</td>
        @endif
        @if ($settings->hide_dimension != 1)
          <td>Dimension (cm): {{ $data->Height ?? '' }} × {{ $data->Width ?? '' }} × {{ $data->Length ?? '' }}</td>
        @endif
      </tr>
    </table>

    <table>
      @if ($settings->pickup_name != 1)
      <tr>
        <td colspan="2" style="text-align:left;">Seller Name : {{ $data->seller ?? '-' }}</td>
      </tr>
      @endif

      <tr>
        <td colspan="2" style="text-align:left;">
          Pickup Details :<br>
          @if ($settings->pickup_address != 1)
            Address: {{ $data->seller_address ?? '-' }} <br>
            Pincode: {{ $data->seller_pin ?? '-' }} <br>
          @endif
          @if ($settings->pickup_mobile != 1)
            Contact: {{ $data->seller_mobile ?? '-' }} <br>
          @endif
          @if ($settings->gst != 1)
            GST: {{ $data->Gstin ?? '-' }}
          @endif
        </td>
      </tr>

      <tr>
        <td colspan="2" style="text-align:left;">
          If Undelivered Please Return To:<br>
          @if ($settings->rto_address != 1)
            Address: {{ $data->seller_return_address ?? '-' }} <br>
            Pincode: {{ $data->seller_return_pin ?? '-' }} <br>
          @endif
          @if ($settings->rto_mobile != 1)
            Contact: {{ $data->seller_mobile ?? '-' }}
          @endif
        </td>
      </tr>

      @if ($settings->support_email_phone == 1)
      <tr>
        <td colspan="2" style="text-align:left;">
          For any query please contact:<br>
          Email: {{ Auth::user()->support_email ?? '-' }}<br>
          Phone: {{ Auth::user()->support_phone ?? '-' }}
        </td>
      </tr>
      @endif

      <tr>
        <td colspan="2" style="text-align:right;">Powered By Rappidx</td>
      </tr>
    </table>
    {{-- <div style="page-break-after: always;"></div> --}}
  @endforeach
  </div>
</body>
</html>
