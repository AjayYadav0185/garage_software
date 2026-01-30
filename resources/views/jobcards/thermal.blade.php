<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ translate('Thermal Invoice') }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            width: 80mm;
            margin: 0 auto;
            padding: 5px 5px;
        }

        h2 {
            text-align: center;
            margin: 0 0 5px 0;
        }

        h3 {
            border-top: 1px dashed #000;
            border-bottom: 1px solid #000;
            text-align: center;
            margin: 10px 0 5px 0;
            padding: 5px 0;
        }

        .header,
        .footer {
            border-top: 1px dashed #000;
            padding: 5px 0;
            text-align: center;
        }

        .footer {
            border-bottom: 1px dashed #000;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 2px 0;
        }

        .label {
            text-align: left;
            width: 45%;
        }

        .value {
            text-align: right;
            width: 55%;
        }

        table.items {
            width: 100%;
            margin-top: 5px;
            border-collapse: collapse;
        }

        table.items th,
        table.items td {
            padding: 2px 0;
        }

        .text-right {
            text-align: right;
        }

        .marktotal {
            border-top: 1px dashed #000;
            border-bottom: 1px solid #000;
            font-weight: bold;
        }

        .total-row {
            border: 1px solid #000;
            padding: 5px;
            margin: 10px 0;
        }
    </style>
</head>

<body>

    {{-- PHP helper for number to words --}}
    @php
    function numberToWords($number) {
    $formatter = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
    return ucfirst($formatter->format($number));
    }
    @endphp

    <div class="header">
        <h2>{{ $data['shop_name'] ?? 'N/A' }}</h2>
        <div class="row"><span>{{ translate('Address') }}:</span><span>{{ $data['shop_address'] ?? 'N/A' }}</span></div>
        <div class="row"><span>{{ translate('Phone') }}:</span><span>{{ $data['shop_contact'] ?? 'N/A' }}</span></div>
        <div class="row"><span>{{ translate('Email') }}:</span><span>{{ $data['shop_email'] ?? 'N/A' }}</span></div>
        <div class="row"><span>{{ translate('TAX') }}:</span><span>{{ $data['shop_gst'] ?? 'N/A' }}</span></div>
    </div>

    <h3>{{ translate('Invoice') }}</h3>
    <table class="info-table">
        <tr>
            <td class="label">{{ translate('Invoice No') }}:</td>
            <td class="value">{{ $data['invoice_no'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">{{ translate('Created') }}:</td>
            <td class="value">{{ !empty($data['created_at']) ? \Carbon\Carbon::parse($data['created_at'])->format('Y-m-d H:i:s') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">{{ translate('Vehicle No') }}:</td>
            <td class="value">{{ $data['vehicle']['registration'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">{{ trans('Brand/Model') }}:</td>
            <td class="value">{{ ($data['vehicle']['brand'] ?? 'N/A') . '/' . ($data['vehicle']['model'] ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="label">{{ translate('Odometer') }}:</td>
            <td class="value">{{ $data['vehicle']['odometer'] ?? 'N/A' }} km</td>
        </tr>
    </table>

    <h3>{{ translate('Bill To') }}</h3>
    <table class="info-table">
        <tr>
            <td class="label">{{ translate('Customer') }}:</td>
            <td class="value">{{ $data['customer']['name'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">{{ translate('Contact') }}:</td>
            <td class="value">{{ $data['customer']['contact'] ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">{{ translate('Address') }}:</td>
            <td class="value">{{ $data['customer']['address'] ?? 'N/A' }}</td>
        </tr>
    </table>


    <h3>Parts / Inventory</h3>
    <table class="items">
        <thead>
            <tr>
                <th>#</th>
                <th>Part</th>
                <th>Qty</th>
                <th class="text-right">MRP</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['inventory'] as $i => $item)
            <tr>
                <td style="text-align:center">{{ $i+1 }}</td>
                <td>{{ $item['name'] ?? 'N/A' }}</td>
                <td style="text-align:center">{{ $item['qty'] ?? 1 }}</td>
                <td style="text-align:right">{{ number_format($item['mrp'] ?? 0, 2) }}</td>
                <td style="text-align:right">{{ number_format($item['finalDiscount'] ?? 0, 2) }}</td>
                <td style="text-align:right">{{ number_format($item['total'] ?? ($item['mrp'] ?? 0), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Services</h3>
    <table class="items">
        <thead>
            <tr>
                <th>#</th>
                <th>Service</th>
                <th class="text-right">MRP</th>
                <th class="text-right">Discount</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['services'] as $i => $service)
            <tr>
                <td style="text-align:center">{{ $i+1 }}</td>
                <td>{{ $service['service_name'] ?? 'N/A' }}</td>
                <td style="text-align:right">{{ number_format($service['mrp'] ?? 0, 2) }}</td>
                <td style="text-align:right">{{ number_format($service['finalDiscount'] ?? 0, 2) }}</td>
                <td style="text-align:right">{{ number_format($service['total'] ?? ($service['mrp'] ?? 0), 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <h3>{{ translate('Order Summary') }}</h3>
    <div class="total-row">
        <table class="info-table">
            <tr>
                <td class="label">{{ translate('Subtotal') }}:</td>
                <td class="value">{{ number_format($data['subtotal'] ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">{{ translate('Tax') }}:</td>
                <td class="value">{{ number_format($data['tax'] ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td class="label">{{ trans('Discount') }}:</td>
                <td class="value">{{ number_format($data['discount'] ?? 0, 2) }}</td>
            </tr>
            <tr class="marktotal">
                <td><strong>{{ translate('Total') }}:</strong></td>
                <td class="value"><strong>{{ number_format($data['total'] ?? 0, 2) }}</strong></td>
            </tr>
            <tr>
                <td class="label"><strong>{{ translate('Amount in Words') }}:</strong></td>
                <td class="value"><strong>{{ numberToWords($data['total'] ?? 0) }} only</strong></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        {{ translate('* Thank you for your business *') }}
    </div>

</body>

</html>