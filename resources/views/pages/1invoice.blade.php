{{--
<style>

  table, td, th {
    border: 1px solid #ddd;
    text-align: left;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    padding: 15px;
  }

  .invoice {
    width: 700px;
    border: 1px solid #000000;
    margin: auto;
    padding: 10px;
  }
  .invoice-table p {
    padding: 0;
  }
  .invoice .invoice-logo {
    width: 100%;
  }
  .invoice .invoice-logo img {
    width: 100px;
  }
  .invoice .invoice-sec-1 {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;

  }
  .invoice .invoice-sec-1 .invoice-sec-1-ref {
    width: 50%;
  }
  .invoice .invoice-sec-1 .invoice-sec-1-date {
    width: 50%;
  }
  .invoice .invoice-sec-1 .invoice-sec-1-date p {
    position: relative;
    top: -107px;
    text-align: right;
  }
  .invoice .invoice-sec-1 .to-invoice {
    margin-top: 85px;
    padding-left: 42px;
  }
  .invoice-table {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;

  }
  .invoice-table .invoice-table-container {
    width: 100%;
    margin: auto;
  }
  .invoice-table .invoice-table-container .invoice-table-data {
    display: flex;
    flex-direction: row;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-sl {
    text-align: center;
    width: 20%;
    border: .5px solid #000000;
    border-left: 1px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-sl-h {
    border-left: 1px solid #000000!important;
    border-top: 1px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-desc-h {
    border-top: 1px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-desc {
    text-align: start;
    width: 60%;
    border: .5px solid #000000;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-amount-h {
    border-top: 1px solid #000000 !important;
    border-right: 1px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-data .invoice-table-amount {
    text-align: start;
    width: 20%;
    border: .5px solid #000000;
    border-right: 1px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-footer {
    border: 1px solid #000000;
    display: flex;
    flex-direction: row;
    border-top: .5px solid #000000 !important;
  }
  .invoice-table .invoice-table-container .invoice-table-footer .invoice-total {
    text-align: start;
    width: 100%;
  }

  .invoice-table .invoice-table-container .invoice-table-footer .invoice-total-amount {
    text-align: start;
    width: 50%;
  }
  .invoice .invoice-banner {
    margin: 5px;
    width: 100%;
  }
  .invoice .invoice-banner .banner-d {
    width: 200px;
    border: 2px solid #000000;
    border-radius: 5px;
    margin: auto;
    padding: 5px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .invoice .invoice-banner .banner-d p {
    font-weight: bold;
    margin: 0px;
  }
  .invoice .invoice-declaration {
    text-align: center;
  }
  .invoice .invoice-greeting {
    margin-top: 70px;
  }
  .invoice .invoice-greeting p {
    margin: 3px;
  }


    </style>

<h4 style="text-align: center;">Tax Invoice</h4>

<div class="invoice">

    <div class="invoice-sec-1">

        <div class="invoice-table">
            <div class="invoice-table-container">

              <div class="invoice-table-data">
                <div class="invoice-table-desc invoice-table-desc-h">
                  <strong> <p> {{$data->company_name}}</p></strong>
                  <p>{{$data->company_address}}</p>
                  <p>GSTIN/UIN : {{$data->company_gst}}</p>
                  <p>State : {{$data->company_state}}</p>
                  <p>Code : {{$data->company_state_code}}</p>
                </div>
                <div class="invoice-table-amount invoice-table-amount-h">
                    <p>Invoice No.</p>
                  <strong><p>{{$data->invoice_no}}</p></strong>

                  <div class="invoice-table-footer">
                    <div class="invoice-total">
                      <p>Delivery Note</p>
                      <br>
                    </div>

                  </div>

                  <div class="invoice-table-footer">
                    <div class="invoice-total">
                      <p>Reference No. & Date.</p>
                      <strong>{{$data->refferance_number}}  dt. {{$data->refferance_date}}</strong>
                    </div>

                  </div>



                </div>

                <div class="invoice-table-amount invoice-table-amount-h">
                    <p>Dated</p>
                    <p>{{ \Carbon\Carbon::parse($data->invoice_date)->format('d-m-Y') }}</p>

                  <div class="invoice-table-footer">
                    <div class="invoice-total">
                      <p>Mode/Terms of Payment : {{$data->terms_of_payment}}</p>
                    </div>
                  </div>

                  <div class="invoice-table-footer" style="border-bottom-style: none;">
                    <div class="invoice-total">
                      <p>Other References : {{$data->other_reffernace}}</p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="invoice-table-data">
                <div class="invoice-table-desc invoice-table-desc-h ">
                    <p> Buyer (Bill to)</p>
                  <strong> <p> {{$data->user_comapany}}</p></strong>
                  <p>GSTIN/UIN : {{$data->user_gst}}
                    <br>
                    State Name : {{$data->user_state}}, Code : {{$data->user_state_code}}</p>
                </div>
                <div class="invoice-table-amount invoice-table-amount-h">
                    <p> Buyer's Order No. {{$data->order_no}}</p>

                    <div class="invoice-table-footer">
                        <div class="invoice-total">
                          <p>Dispatch Doc No. {{$data->dispatch_doc_no}}</p>
                        </div>
                      </div>

                      <div class="invoice-table-footer" style="border-bottom-style: none;">
                        <div class="invoice-total">
                          <p>Dispatched through , {{$data->dispatch_through}}</p>
                        </div>
                      </div>
                </div>

                <div class="invoice-table-amount invoice-table-amount-h">
                    <p>Dated : {{ \Carbon\Carbon::parse($data->order_date)->format('d-m-Y') }}</p>

                    <div class="invoice-table-footer">
                        <div class="invoice-total">
                          <p>Delivery Note Date. {{$data->delivery_note_date}}</p>
                        </div>
                      </div>

                      <div class="invoice-table-footer">
                        <div class="invoice-total">
                          <p>Destination : {{$data->destination;}}</p>
                        </div>
                      </div>

                </div>

              </div>

            </div>
          </div>

    </div>

    <div class="invoice-table">
      <div class="invoice-table-container">
        <div class="invoice-table-data">
          <div class="invoice-table-sl invoice-table-sl-h" >
            <strong> <p>SR No.</p></strong>
          </div>
          <div class="invoice-table-desc invoice-table-desc-h">
            <strong><p>Description of Services</p></strong>
          </div>
          <div class="invoice-table-amount invoice-table-amount-h">
            <strong><p>HSN/SAC</p></strong>
          </div>
          <div class="invoice-table-amount invoice-table-amount-h">
            <strong><p>Quantity</p></strong>
          </div>
          <div class="invoice-table-amount invoice-table-amount-h">
            <strong><p>Rate</p></strong>
          </div>
          <div class="invoice-table-amount invoice-table-amount-h">
            <strong><p>Per</p></strong>
          </div>
          <div class="invoice-table-amount invoice-table-amount-h">
            <strong><p>Amount</p></strong>
          </div>
        </div>
        <div class="invoice-table-data" style="height: 300px;">
          <div class="invoice-table-sl">
            <p>1</p>
          </div>
          <div class="invoice-table-desc">
            <p>{{$data->service}}</p>
          </div>
          <div class="invoice-table-amount">
            <p>{{$data->hsn_sac}}</p>
          </div>
          <div class="invoice-table-amount">
            <p>{{$data->quantity}}</p>
          </div>
          <div class="invoice-table-amount">
            <p>{{$data->rates}}</p>
          </div>
          <div class="invoice-table-amount">
            <p>{{$data->per}}</p>
          </div>
          <div class="invoice-table-amount">
            <p>{{$data->amount}}</p>
            <P>{{$data->amounts}}</P>

          </div>
        </div>
        <div class="invoice-table-footer">
          <div class="invoice-total" style="text-align: center">
            <p>Total</p>
          </div>
          <div class="invoice-total-amount" style="text-align: end;">
            <p> {{currency_symbol()}} {{$data->amounts}}</p>
          </div>

        </div>


        <table>
            <tr>
              <th rowspan="2">HSN/SAC</th>
              <th rowspan="2">Taxable Value</th>
              <th>IGST</th>
              <th rowspan="2">Total Tax Amount</th>
            </tr>
            <tr>

                <td>
                    <table style="border: none;">
                        <th>Rate</th>
                        <th>Amount</th>
                    </table>
                </td>

            </tr>

            <tr>

              <td>{{$data->hsn_sac}}</td>
              <td>{{$data->amount}}</td>

              <td>
                <table>
                    <th>{{$data->rate}}</th>
                    <th>{{$data->amounts}}</th>
                </table>
              </td>

                <td>{{$data->amounts}}</td>
              </tr>

              <tr>
                <td>Total</td>
                <td>{{$data->amount}}</td>
                <td style="text-align: end;">{{$data->amounts}}</td>
                <td>{{$data->amounts}}</td>
              </tr>

          </table>

      </div>
    </div>
    <div class="invoice-declaration" style="display: flex;">
      <p style="width:50%;">Declaration
        We declare that this invoice shows the actual price of the
       goods described and that all particulars are true and
       correct.</p>
       <p style="width:50%; border:1px solid #000; border-bottom-style: none;"> for {{$data->company_name}}</p>
    </div>

  </div>


  --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tax Invoice</title>
    <style>
        body {
            width: 0% !important;
            padding: 0% !important;
            height: 900px !important;

            font-family: Arial, sans-serif;
        }

        .invoice-container {
            width: 700px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 10px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            font-size: 24px;
            text-transform: uppercase;
        }

        .company-details,
        .buyer-details {
            width: 48%;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 20px;
        }

        .company-details {
            float: left;
        }

        .buyer-details {
            float: right;
        }

        .invoice-meta {
            clear: both;
            width: 100%;
            border: 1px solid #ddd;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-meta td,
        .invoice-meta th {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
            font-size: 12px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        .items-table th {
            background-color: #f0f0f0;
        }

        .amounts-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .amounts-table td {
            padding: 5px;
            font-size: 12px;
        }

        .declaration {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .signatory {
            text-align: right;
            font-size: 12px;
        }

        .page-footer {
            font-size: 10px;
            text-align: center;
            margin-top: 20px;
        }

        table,
        td,
        th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h4>{{ translate('Tax Invoice') }}</h4>
    </div>
    <div class="invoice-container">


        <div class="company-details">
            <strong>{{ translate('RAPPIDX GLOBAL BUSINESS SOLUTIONS PRIVATE LIMITED') }}</strong><br>
            {{ translate('Block D-8 Ground Floor, Flat No-42, Pocket-8,') }}<br>
            {{ translate('Sector23B Dwarka, Delhi, South West Delhi') }}<br>
            {{ translate('TAXIN/UN: 07AAKCR5031M1Z3') }}<br>
            {{ translate('State Name: Delhi, Code : 07') }}
        </div>

        <div class="buyer-details">
            <strong>{{ translate('Buyer (Bill to)') }}:</strong><br>
            {{ $data->user_comapany }}<br>
           {{ translate('TAXIN/UIN:') }} {{ $data->user_gst }}<br>
            {{ translate('State Name:') }} {{ $data->user_state }}, Code: {{ $data->user_state_code }}
        </div>

        <table class="invoice-meta">
            <tr>
                <th>{{ translate('Invoice No') }}.</th>
                <td>{{ $data->invoice_no }}</td>
                <th>{{ translate('Dated') }}</th>
                <td>{{ \Carbon\Carbon::parse($data->invoice_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>{{ translate('Reference No. & Date') }}</th>
                <td>{{ $data->refferance_number }} dt.
                    {{ \Carbon\Carbon::parse($data->refferance_date)->format('d-m-Y') }}</td>
                <th>{{ translate('Other References') }}</th>
                <td>{{ $data->other_reffernace }}</td>
            </tr>
            <tr>
                <th>{{ translate('Dispatch Doc No.') }}</th>
                <td>{{ $data->dispatch_doc_no }}</td>
                <th>{{ translate('Delivery Note Date') }}</th>
                <td>{{ $data->delivery_note_date }}</td>
            </tr>
            <tr>
                <th>{{ translate('Dispatched Through') }}</th>
                <td>{{ $data->dispatch_through }}</td>
                <th>{{ translate('Destination') }}</th>
                <td>{{ $data->destination }}</td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>{{ translate('Sl. No') }}</th>
                    <th>{{ translate('Description of Services') }}</th>
                    <th>{{ translate('HSN/SAC') }}</th>
                    <th>{{ translate('Quantity') }}</th>
                    <th>{{ translate('Rate per') }}</th>
                    <th>{{ translate('Amount') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="height: 300px !important;">{{ translate('1') }}</td>
                    <td>{{ translate('Shipping Charges IGST ROUND OFF') }}</td>
                    <td>{{ $data->hsn_sac }}</td>
                    <td>{{ $data->quantity }}</td>
                    <td>{{currency_symbol()}} {{ $data->amount }}</td>
                    <td>{{currency_symbol()}} {{ $data->amount }}</td>
                </tr>
            </tbody>
        </table>


        <p>{{ translate('Amount Chargeable (in words)') }}:</strong> </p>


        <table>
            <tr style="font-size: 10px;">
                <th rowspan="2">{{ translate('HSN/SAC') }}</th>
                <th rowspan="2">{{ translate('Taxable Value') }}</th>
                <th>{{ translate('IGST') }}</th>
                <th rowspan="2">{{ translate('Total Tax Amount') }}</th>
            </tr>
            <tr style="font-size: 10px;">

                <td>
                    <table style="border: none;">
                        <td>{{ translate('Rate') }}</td>
                        <td>{{ translate('Amount') }}</td>
                    </table>
                </td>

            </tr>

            <tr style="font-size: 10px;">

                <td>{{ $data->hsn_sac }}</td>
                <td>{{ $data->amount }}</td>

                <td>
                    <table>
                        <td>{{ $data->rate }}</td>
                        <td>{{ $data->amounts }}</td>
                    </table>
                </td>

                <td>{{ $data->amounts }}</td>
            </tr>

            <tr style="font-size: 10px;">
                <td>{{ translate('Total') }}</td>
                <td>{{ $data->amount }}</td>
                <td style="text-align: end;">{{ $data->amounts }}</td>
                <td>{{ $data->amounts }}</td>
            </tr>

        </table>

        <p>{{ translate('Tax Amount (in words)') }}:</strong> </p>

        <div class="declaration">
            <strong>{{ translate('Declaration') }}:</strong><br>
            {{ translate('We declare that this invoice shows the actual price of the goods described and that all particulars are true
            and correct.') }}
        </div>

        <div class="signatory">
            <strong style="text-align: right;">{{ translate('For RAPPIDX GLOBAL BUSINESS SOLUTIONS PRIVATE LIMITED') }}</strong><br>
            <br><br>
           {{ translate(' Authorised Signatory') }}
        </div>

        <div class="page-footer">
            {{ translate('This is a Computer Generated Invoice') }}
        </div>
    </div>
</body>

</html> --}}
