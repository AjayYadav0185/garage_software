<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ ($jobcard->status == 'P') ? translateConcat('ESTIMATE') : translateConcat('INVOICE') }} {{ $jobcard->job_card_no }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --gray-50: #f8f9fa;
            --gray-100: #f1f3f4;
            --gray-200: #e8eaed;
            --gray-400: #bdc1c6;
            --gray-600: #80868b;
            --gray-900: #202124;
            --border-radius: 8px;
            --box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: 'Google Sans', 'Roboto', sans-serif;
            font-size: 12px;
            color: var(--gray-900);
            background: var(--gray-50);
            margin: 0;
            padding: 20px;
            position: relative;
        }

        .watermark {
            position: fixed;
            /* stays in center even when scrolling / for PDF */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            /* semi-transparent */
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            pointer-events: none;
            /* allow clicks through it */
            z-index: 9999;
            /* on top of everything */
        }

        .container {
            max-width: 1100px;
            margin: auto;
            position: relative;
            z-index: 1;
            /* above watermark */
        }

        .card {
            background: #fff;
            /* border-radius: var(--border-radius); */
            box-shadow: var(--box-shadow);
            padding: 20px;
            /* margin-bottom: 20px; */
            margin-bottom: 0px;
            border: 0px solid black;
            /* added border */
            position: relative;
            z-index: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 0px;
            /* margin-bottom: 20px; */
        }

        .header img {
            max-height: 60px;
            object-fit: contain;
        }

        .header-info {
            text-align: right;
        }

        .header-info h1 {
            margin: 0;
            font-size: 28px;
            color: var(--gray-900);
        }

        .header-info div {
            font-size: 14px;
            color: var(--gray-600);
        }

        h6 {
            font-size: 14px;
            color: var(--gray-600);
            margin-bottom: 10px;
            margin-top: 0px !important;
        }

        .info-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .info-grid .section {
            flex: 1;
            min-width: 200px;
        }

        .info-grid .section div {
            display: flex;
            margin-bottom: 5px;
        }

        .info-grid .section div strong {
            width: 120px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f2f2f2;
            font-weight: 600;
        }

        table td.text-right {
            text-align: right;
        }

        .totals {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            flex-wrap: wrap;
        }

        .totals .box {
            border: 1px solid #ccc;
            padding: 10px;
            min-width: 317px !important;
        }

        .footer {
            text-align: center;
            font-size: 11px;
            /* color: var(--gray-600); */
            margin-top: 40px;
        }


        @media print {

            .totals {
                display: grid !important;
                grid-template-columns: 1fr 1fr 1fr;
                /* 3 equal columns */
                gap: 10px;
                align-items: stretch;
            }

            .totals .box {
                width: 90% !important;
                min-width: 0 !important;
                page-break-inside: avoid;
                font-size: 11px;
            }

            /* Prevent breaking across pages */
            .card {
                page-break-inside: avoid;
                box-shadow: var(--box-shadow);
            }

        }
    </style>
</head>

<body>

    @php
    // Decode parts & services JSON safely
    $parts = json_decode($jobcard->inventory ?? '[]', true) ?: [];
    $services = json_decode($jobcard->service ?? '[]', true) ?: [];

    // Calculate totals
    $jobcard->parts_total = array_sum(array_map(fn($p) => $p['total'] ?? 0, $parts));
    $jobcard->services_total = array_sum(array_map(fn($s) => $s['total'] ?? 0, $services));
    $jobcard->grand_total = $jobcard->parts_total + $jobcard->services_total;
    @endphp

    {{-- Watermark --}}
    <div class="watermark">
        @switch($jobcard->work_status)

        @case(5)
        {{ translateConcat('REJECTED') }}
        @break

        @case(2)
        {{ translateConcat('APPROVED') }}
        @break

        @case(4)
        @switch($jobcard->status)

        @case('C')
        {{ translateConcat('PAID') }}
        @break

        @case('P')
        {{ translateConcat('UNPAID') }}
        @break

        @default
        {{ translateConcat('DRAFT') }}

        @endswitch
        @break

        @default
        {{ translateConcat('DRAFT') }}

        @endswitch
    </div>

    <div class="container">
        {{-- Header --}}
        <div class="card header">
            <div>
                <img src="{{ asset((self()->img ?: 'logo2.png')) }}" alt="Logo">
            </div>
            <div class="header-info">
                <h1>{{ ($jobcard->status == 'P') ? translateConcat('ESTIMATE') : translateConcat('INVOICE') }}</h1>

                @if(($jobcard->status == 'P'))
                <div><strong>{{ translateConcat('Job Card No') }}:</strong> {{ $jobcard->job_card_no }}</div>
                @else
                <div><strong>{{ translateConcat('Invoice No') }}:</strong> {{ $jobcard->invoice_no }}</div>
                @endif

                <div>{{ \Carbon\Carbon::parse($jobcard->created_at)->format('d M Y H:i') }}</div>
                <div style="margin-top:5px; font-weight:bold; color: black;">
                    {{ translateConcat(ucfirst($jobcard->job_card_type ?? 'N/A')) }}
                </div>
            </div>
        </div>

        {{-- Customer & Vehicle Info --}}
        <div class="card info-grid">
            {{-- Customer Details (Only if NOT Accident) --}}
            @if(strtolower($jobcard->job_card_type ?? '') !== 'accident')
            <div class="section">
                <h6>{{ translateConcat('Bill To') }}</h6>

                @php
                $customerFields = [
                'name' => 'Name',
                'email' => 'Email',
                'contact' => 'Phone',
                'address' => 'Address',
                'c_gst' => 'GST',
                ];
                @endphp

                @foreach($customerFields as $field => $label)
                @if(!empty($jobcard->$field))
                <div>
                    <strong>{{ translateConcat($label) }}:</strong>
                    {{ $jobcard->$field }}
                </div>
                @endif
                @endforeach
            </div>
            @endif
            {{-- Vehicle Details --}}
            <div class="section">
                <h6>{{ translateConcat('Vehicle Details') }}</h6>
                @php
                $vehicleFields = [
                'registration' => 'Registration',
                'carbrand' => 'Brand',
                'carmodel' => 'Model',
                'engine_no' => 'Engine No',
                'chassis_no' => 'Chassis No',
                'odometer' => 'Odometer',
                'fueltype' => 'Fuel',
                'transmission' => 'Transmission',
                'braking' => 'Braking',
                'fuelmeter' => 'Fuel Meter',
                ];
                @endphp
                @foreach($vehicleFields as $field => $label)
                @if(!empty($jobcard->$field))
                <div>
                    <strong>{{ translateConcat($label) }}:</strong>
                    @if($field == 'odometer') {{ $jobcard->$field }} km
                    @elseif($field == 'fuelmeter') {{ $jobcard->$field }}%
                    @elseif($field == 'carbrand') {{ $jobcard->$field }} / {{ $jobcard->carmodel ?? '' }}
                    @else {{ $jobcard->$field }}
                    @endif
                </div>
                @endif
                @endforeach
            </div>
            {{-- Insurance Details (Bill To - Only Accident Job Card) --}}
            @if(strtolower($jobcard->job_card_type ?? '') === 'accident')
            <div class="section">
                <h6>{{ translateConcat('Bill To') }}</h6>

                @php
                $insuranceFields = [
                'insurence_company_name' => 'Insurance Company',
                'insurence_code' => 'Insurance Code',
                'insurence_tax_number' => 'TAX No',
                'insurence_company_number' => 'Contact',
                'insurence_email_address' => 'Email',
                'insure_address' => 'Address',
                ];
                @endphp

                @foreach($insuranceFields as $field => $label)

                @if(!empty($jobcard->insurance_company[$field]))
                <div>
                    <strong>{{ translateConcat($label) }}:</strong>
                    {{ $jobcard->insurance_company[$field] }}
                </div>
                @endif
                @endforeach
            </div>
            @endif
            {{-- Vehicle Images --}}
            @if(!empty($jobcard->img1) || !empty($jobcard->img2))
            <div class="section">
                <h6>{{ translateConcat('Vehicle Images') }}</h6>
                @foreach(['img1'=>'Interior', 'img2'=>'Exterior'] as $imgField=>$label)
                @if(!empty($jobcard->$imgField))
                <strong>{{ $label }}:</strong><br>
                @foreach(explode(',', $jobcard->$imgField) as $img)
                @if(!empty($img))
                <img src="{{ trim($img) }}" style="width:80px;height:60px;object-fit:cover;margin:2px;">
                @endif
                @endforeach
                @endif
                @endforeach
            </div>
            @endif
        </div>

        {{-- Parts Table --}}
        @if(!empty($parts))
        <div class="card">
            <h6>{{ translateConcat('Parts') }}</h6>
            <table>
                <thead>
                    <tr>
                        <th>{{ translateConcat('Item') }}</th>
                        <th>{{ translateConcat('Part No.') }}</th>
                        <th>{{ translateConcat('HSN Code') }}</th>
                        <th>{{ translateConcat('Qty') }}</th>
                        <th>{{ translateConcat('Base Price') }}</th>
                        <th>{{ translateConcat('Discount') }}</th>
                        <th>{{ translateConcat('TAX') }}</th>
                        <th>{{ translateConcat('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parts as $part)
                    @php
                    $qty = $part['qty'] ?? 1;
                    $mrp = $part['mrp'] ?? 0;

                    $cgst = $part['cgst'] ?? 0;
                    $sgst = $part['sgst'] ?? 0;
                    $taxPercent = $cgst + $sgst;

                    // Unit price (base price before tax)
                    $unitPrice = $taxPercent > 0
                    ? $mrp / (1 + ($taxPercent / 100))
                    : $mrp;

                    $unitPrice = round($unitPrice, 2);
                    @endphp
                    <tr>
                        <td>{{ $part['name'] ?? $part['partname'] ?? '-' }}</td>
                        <td>{{ $part['partNo'] ?? $part['part_number'] ?? '-' }}</td>
                        <td>{{ $part['hsn'] ?? $part['parthsncode'] ?? '-' }}</td>
                        <td>{{ $part['qty'] ?? $part['partqty'] ?? '-' }}</td>
                        <td>{{ currency_symbol() . number_format($unitPrice, 2) }}</td>
                        <td>
                            @if(!empty($part['finalDiscount'])) {{currency_symbol() .  $part['finalDiscount'] }}
                            @elseif(!empty($part['discount'])) {{ $part['discount'] }}%
                            @else - @endif
                        </td>
                        <td>{{ 'VAT: '.($part['cgst'] ?? 0).'%' }}</td>

                        <td>{{currency_symbol() .  $part['total'] ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        {{-- Services Table --}}
        @if(!empty($services))
        <div class="card">
            <h6>{{ translateConcat('Services') }}</h6>
            <table>
                <thead>
                    <tr>
                        <th>{{ translateConcat('Service') }}</th>
                        <th>{{ translateConcat('HSN Code') }}</th>
                        <th>{{ translateConcat('Price') }}</th>
                        <th>{{ translateConcat('Discount') }}</th>
                        <th>{{ translateConcat('TAX') }}</th>
                        <th>{{ translateConcat('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service['service_name'] ?? $service['name'] ?? '-' }}</td>
                        <td>{{ $service['hsn'] ?? $service['hsn_code'] ?? '-' }}</td>
                        <td>
                            {{ currency_symbol() . ($service['mrp'] ?? $service['price'] ?? 0) }}
                        </td>

                        <td>
                            @if(!empty($service['finalDiscount'])) {{currency_symbol() .  $service['finalDiscount'] }}
                            @elseif(!empty($service['discount'])) {{ $service['discount'] }}%
                            @else - @endif
                        </td>

                        <td>{{ 'VAT: '.($service['cgst'] ?? 0).'%' }}</td>
                        <!-- @if(!empty($service['igst'])) IGST: {{ $service['igst'] }}%
                            @else CGST: {{ $service['cgst'] ?? 0 }}% / SGST: {{ $service['sgst'] ?? 0 }}%
                            @endif -->
                        <td>{{currency_symbol() .  $service['total'] ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        {{-- Mechanic Instruction & Amount Summary --}}
        <div class="card totals">
            <div class="box">
                <h6>{{ translateConcat('Remarks') }}</h6>
                <p>{{ $jobcard->remark ?? 'No remarks' }}</p>
            </div>
            <div class="box">
                <h6>{{ translateConcat('Instruction of Mechanic') }}</h6>
                <p>{{ $jobcard->instruction_for_mechanic ?? 'No remarks' }}</p>
            </div>
            <div class="box">
                <h6>{{ translateConcat('Amount Summary') }}</h6>
                <table>
                    @if($jobcard->parts_total > 0)
                    <tr>
                        <td>{{ translateConcat('Parts Total') }}</td>
                        <td class="text-right">{{currency_symbol() .  $jobcard->parts_total }}</td>
                    </tr>
                    @endif
                    @if($jobcard->services_total > 0)
                    <tr>
                        <td>{{ translateConcat('Services Total') }}</td>
                        <td class="text-right">{{currency_symbol() .  $jobcard->services_total }}</td>
                    </tr>
                    @endif
                    <tr style="border-top:1px solid #ccc; font-weight:bold;">
                        <td>{{ translateConcat('Grand Total') }}</td>
                        <td class="text-right">{{currency_symbol() .  $jobcard->grand_total }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Terms & Conditions --}}
        <div class="card">
            <h6>{{ translateConcat('Terms & Conditions') }}</h6>
            <p>1. {{ ('A Supplementary Estimate Will Be Submitted, If any additional Damage/Parts Required After Dismantling.') }}</p>
            <p>2. {{ ('Delivery subject to availability of parts.') }}</p>
            <p>3. {{ ('Quote Validity is One Month.') }}</p>
            <p>4. {{ ('Parts price are subject to change without prior notice prices prevailing at the time of actual delivery shall be charged.') }}</p>
            <p>5. {{ ('The garage will not accept any responsibility if any problem occurs in the vehicle or in the chassis of the vehicle during the repair.') }}</p>
        </div>

        {{-- Signatures --}}
        <div class="card" style="display:flex; justify-content:space-between; gap:20px;">
            <div style="width:45%; text-align:center;">
                <p style="margin-bottom:80px; border-bottom:1px solid #000;"></p>
                <p>{{ translateConcat('Customer Signature') }}</p>
            </div>
            <div style="width:45%; text-align:center;">
                <p style="margin-bottom:80px; border-bottom:1px solid #000;"></p>
                <p>{{ translateConcat('Authorized Signature') }}</p>
            </div>
        </div>

        <div class="footer">
            {{ translate('MeriGarage, Gurgaon | Mobile: 8802929885 | Email: alert@merigarage.com') }}
        </div>
    </div>
</body>

</html>