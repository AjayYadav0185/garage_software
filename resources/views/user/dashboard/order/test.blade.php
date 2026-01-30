@foreach($query as $data)

<h2>Test Label</h2>

  <div class="table-scroll">
    <table>
      
      <tr>
     
        <td>
          @if ($settings->userlogo == 1 || $settings->channel_logo == 1)
          @if (Auth::user()->brand_logo != Null)
          <img src="{{asset('public/storage/')}}/{{Auth::user()->brand_logo}}" alt="" width="200">
          @else
          <img src="{{asset('assets/new_logo.jpg')}}" alt="Logo" width="200">
          @endif
          @else
          <img src="{{asset('assets/new_logo.jpg')}}" alt="Logo" width="200">
          @endif
      </td>
        
        <td>
          <p> <span>Customer Name :</span>&ensp; {{$data->Name??''}}</p>
                               <p> <span>Address :</span>&ensp; {{$data->Address ?? ''}} , {{$data->State ??''}}</p>
                               
                               <p> <span>Pin Code :</span>&ensp; {{$data->Pincode ?? ''}}</p>
                               @if ($settings->user_hidemobile == 1)
                               
                               @else
                               <p> <span>Mobile :</span>&ensp; {{$data->Mobile ?? ''}}</p>
                               @endif
                               
          </td>

          <td>

            @if ($settings->payment_status == 0)
            <p style="border: 0px; font-weight:bold; text-transform:capitalize; width:100%;"> <span></span>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
             
              {{$data->Order_Type ?? ''}}
              <br>
              &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
              Sort Code: Abcd  </p> 
            @if($data->Order_Type == 'COD' || $data->Order_Type == 'cod')
            <p style="border: 0px; font-weight:bold; text-transform:capitalize; width:100%;"> <span></span>&ensp; {{$data->Invoice_Value ?? ''}}</p>
            @endif
            @endif

          
            
          </td>
       
      </tr>

      <tr>
        <td colspan="2" >            
          <table>
            <tr>
              <td style="border:none; font-weight:bold;">AWB - {{$data->Awb_Number ?? ''}}</td>
            </tr>
            <tr>
              
              <td style="border:none;"><p style="font-weight:800;text-align:center; "><img alt="image" src="data:image/png;base64,{{generateBarCode($data->Awb_Number) ?? '-'}}" width="250px" height="100px" />
                            </p></td>
            </tr>
          </table></td>
        <td colspan="2">  {{getCourierNameById($data->courier_id) ?? ''}}</td>
      </tr>
      <tr>
        <td colspan="2">Order ID: {{$data->orderno ?? ''}}</td>
        <td colspan="2">Date: {{ date('d-m-Y', strtotime($data->Rec_Time_Date))}}</td>
      </tr>
      </table>
      
        <table >
            <tr>
              @if ($settings->hide_product == 1)
                @else
                <th>Product</th>
              @endif
              @if ($settings->hide_qty == 1)
                @else
                <th>Quantity</th>
              @endif
              @if ($settings->hide_value == 1)
              @else
              <th>Value</th>
            @endif
              
            </tr>
            <tr>

              @if ($settings->hide_product == 1)
              @else
              <td>
                {{$data->Item_Name ?? ''}}
                </td>
            @endif
              
            @if ($settings->hide_qty == 1)
            @else
            <td>
              {{$data->Quantity ?? ''}}
             </td>
          @endif
               
          @if ($settings->hide_value == 1)
            @else
            <td>
              {{$data->Invoice_Value ?? ''}}
              </td>
          @endif
              
            </tr>
            </table>
            <table>
      <tr>

        @if($settings->hide_weight == 1)
        @else
        <td colspan="2">Weight (kg): {{$data->ChargeableWeight ?? ''}}</td>
        @endif

        @if ($settings->hide_dimension == 1)
          
        @else
        <td colspan="2"> <p class=" ">Dimension (cm): {{$data->Height ?? ''}}*{{$data->Width ?? ''}}*{{$data->Length ?? ''}}</p></td>
        @endif
       
      </tr>
      </table>
      <table>
       <tr>

        @if ($settings->pickup_name == 1)
          
        @else
        <td colspan="3" style="text-align: left;">Seller Name : {{$data->seller ?? '-'}}
        @endif
      
        </td>
        </tr>
        <tr>
        <td colspan="3" style="text-align: left;">
          Pickup Details :
          @if ($settings->pickup_address == 1)
            
          @else
          <p>Address :</span>&ensp; {{$data->seller_address ?? '-'}}</p>
          <p>Pincode :</span>&ensp; {{$data->seller_pin ?? '-'}}</p>
          @endif
         
          @if ($settings->pickup_mobile == 1)
            
          @else
          <p>Contact Number :</span>&ensp; {{$data->seller_mobile ?? '-'}}</p>
          @endif
         
          @if ($settings->gst == 1)
          @else
          <p>GST :</span>&ensp; {{$data->Gstin ?? '-'}}</p>
          @endif
        </td>
        </tr>
      <tr>
        <td colspan="3" style="text-align: left;">
               If Undelivered Please Return To<br>
               @if ($settings->rto_address == 1)
                 @else
                 <p>Address :</span>&ensp; {{$data->seller_return_address ?? '-'}}</p>
                 <p>Pincode :</span>&ensp; {{$data->seller_return_pin ?? '-'}}</p>
               @endif
        
               @if ($settings->rto_mobile ==1)
                 @else
                 <p>Contact Number :</span>&ensp; {{$data->seller_mobile ?? '-'}}</p></td>
               @endif
             
      </tr>

      @if ($settings->support_email_phone == 1)
      <tr>
        <td colspan="3" style="text-align: left;">
            For any query please contact:<br>
              <p>Email :</span>&ensp; {{Auth::user()->support_email ?? '-'}}</p>
              <p>Contact Number :</span>&ensp; {{Auth::user()->support_phone ?? '-'}}</p></td>
      </tr>
      @endif

      <tr>
        <td colspan="3" style="text-align: right;">Powered By Rappidx</td>
      </tr>
      </table>
      
    
  </div>
  @endforeach