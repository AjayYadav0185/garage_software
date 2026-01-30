@extends('user.dashboard.layout.master')

@section('user-contant')

@php

$parts = json_decode($jobcard->inventory ?? '[]', true) ?: [];
$services = json_decode($jobcard->service ?? '[]', true) ?: [];

$partsTotal = array_sum(array_map(fn($p) => $p['total'] ?? 0, $parts));
$servicesTotal = array_sum(array_map(fn($s) => $s['total'] ?? 0, $services));
$grandTotal = $partsTotal + $servicesTotal;
@endphp

<style>
    .container-fluid {
        padding: 100px 20px 14px 100px;
    }

    .fk-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0, 0, 0, .07);
        margin-bottom: 20px
    }

    .fk-card-header {
        padding: 14px 20px;
        font-weight: 600;
        font-size: 16px
    }

    .fk-card-body {
        padding: 20px
    }


    .fk-card-body img {
        max-height: 100px;
        object-fit: contain;
    }

    .fk-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px
    }

    .fk-table th,
    .fk-table td {
        border: 1px solid #e5e7eb;
        padding: 8px;
        text-align: center
    }

    .fk-table th {
        background: #f3f4f6;
        font-size: 12px;
        text-transform: uppercase
    }

    .vehicle-img {
        width: 90px;
        height: 65px;
        object-fit: cover;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin: 2px
    }
</style>

@if(!empty($jobcard))


<div class="main-content supreme-container">
    <div>

        {{-- HEADER --}}
        <div class="fk-card">
            <div class="fk-card-header">
                {{ ($jobcard->status == 'P') ? translateConcat('ESTIMATE') : translateConcat('INVOICE') }}
            </div>

            <div class="fk-card-body row align-items-center">

                <div class="col-md-3 text-center">
                    <img src="{{ asset((self()->img ?: 'logo2.png')) }}" alt="Logo">
                </div>

                <div class="col-md-4">
                </div>
                <div class="col-md-4" hidden>
                    <h5>{{ $garage->g_name ?? 'MeriGarage' }}</h5>
                    <p>{{ $garage->g_address ?? '' }}</p>
                    <p>{{ $garage->g_mob ?? '' }} | {{ $garage->email ?? '' }}</p>
                </div>

                <div class="col-md-5 text-right">
                    <h3>{{ translateConcat('Job Card') }}</h3>
                    <p><strong>{{ translateConcat('Job Card No') }}:</strong> {{ $jobcard->job_card_no }}</p>
                    @if(($jobcard->status == 'C'))
                    <p><strong>{{ translateConcat('Invoice No') }}:</strong> {{ $jobcard->invoice_no }}</p>
                    @endif

                    <p><strong>{{ translateConcat('Type') }}:</strong> {{ ucfirst($jobcard->job_card_type) }}</p>
                    <p>{{ \Carbon\Carbon::parse($jobcard->created_at)->format('d M Y H:i') }}</p>
                </div>

            </div>
        </div>

        {{-- CUSTOMER / INSURANCE + VEHICLE --}}
        <div class="row">

            <div class="col-md-6">
                <div class="fk-card">
                    <div class="fk-card-header">{{ translateConcat('Bill To') }}</div>
                    <div class="fk-card-body">

                        @if(strtolower($jobcard->job_card_type) !== 'accident')
                        <p><strong>{{ translateConcat('Name') }}:</strong> {{ $jobcard->name ?? '' }}</p>
                        <p><strong>{{ translateConcat('Phone') }}:</strong> {{ $jobcard->contact ?? '' }}</p>
                        <p><strong>{{ translateConcat('Email') }}:</strong> {{ $jobcard->email ?? '' }}</p>
                        <p><strong>{{ translateConcat('Address') }}:</strong> {{ $jobcard->address ?? '' }}</p>
                        <p><strong>{{ translateConcat('TAX') }}:</strong> {{ $jobcard->c_gst ?? '' }}</p>
                        @else

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


                        @if(!empty($jobcard->insuranceCompany[$field]))
                        <p><strong>{{ translateConcat($label) }}:</strong> {{ $jobcard->insuranceCompany[$field] ?? '' }}</p>
                        @endif
                        @endforeach

                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="fk-card">
                    <div class="fk-card-header">{{ translateConcat('Vehicle Details') }}</div>
                    <div class="fk-card-body">
                        <p><strong>{{ translateConcat('Registration') }}:</strong> {{ $jobcard->registration }}</p>
                        <p><strong>{{ translateConcat('Vehicle') }}:</strong> {{ $jobcard->carbrand }} / {{ $jobcard->carmodel }}</p>
                        <p><strong>{{ translateConcat('Fuel') }}:</strong> {{ $jobcard->fueltype }}</p>
                        <p><strong>{{ translateConcat('Odometer') }}:</strong> {{ $jobcard->odometer }} km</p>
                        <p><strong>{{ translateConcat('Transmission') }}:</strong> {{ $jobcard->transmission }}</p>

                        {{-- VEHICLE IMAGES --}}
                        @foreach(['img1','img2'] as $imgField)
                        @if(!empty($jobcard->$imgField))
                        @foreach(explode(',', $jobcard->$imgField) as $img)
                        <img src="{{ trim($img) }}" class="vehicle-img">
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        {{-- PARTS TABLE --}}
        @if($parts)
        <div class="fk-card">
            <div class="fk-card-header">{{ translateConcat('Parts') }}</div>
            <div class="fk-card-body table-responsive">
                <table class="fk-table">
                    <thead>
                        <tr>
                            <th>{{ translateConcat('Item') }}</th>
                            <th>{{ translateConcat('Part No') }}</th>
                            <th>{{ translateConcat('HSN') }}</th>
                            <th>{{ translateConcat('Qty') }}</th>
                            <th>{{ translateConcat('Base Price') }}</th>
                            <th>{{ translateConcat('Discount') }}</th>
                            <th>{{ translateConcat('TAX') }}</th>
                            <th>{{ translateConcat('Total') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($parts as $p)
                        @php
                        $qty = $p['qty'] ?? 1;
                        $mrp = $p['mrp'] ?? 0;

                        $cgst = $p['cgst'] ?? 0;
                        $sgst = $p['sgst'] ?? 0;
                        $taxPercent = $cgst + $sgst;

                        // Unit price (base price before tax)
                        $unitPrice = $taxPercent > 0
                        ? $mrp / (1 + ($taxPercent / 100))
                        : $mrp;

                        $unitPrice = round($unitPrice, 2);
                        @endphp

                        <tr>
                            <td>{{ $p['name'] ?? $p['partname'] }}</td>
                            <td>{{ $p['partNo'] ?? '' }}</td>
                            <td>{{ $p['hsn'] ?? '' }}</td>
                            <td>{{ $qty }}</td>
                            {{-- Unit Price --}}
                            <td>{{ currency_symbol() . number_format($unitPrice, 2) }}</td>
                            <td>{{ $p['discount'] ?? '-' }}</td>

                            <td>
                                VAT {{ $cgst }}%</td>
                            <td>{{ currency_symbol() . number_format($p['total'] ?? 0, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
        @endif

        {{-- SERVICES TABLE --}}
        @if($services)
        <div class="fk-card">
            <div class="fk-card-header">{{ translateConcat('Services') }}</div>
            <div class="fk-card-body table-responsive">
                <table class="fk-table">
                    <thead>
                        <tr>
                            <th>{{ translateConcat('Service') }}</th>
                            <th>{{ translateConcat('HSN') }}</th>
                            <th>{{ translateConcat('Base Price') }}</th>
                            <th>{{ translateConcat('Discount') }}</th>
                            <th>{{ translateConcat('TAX') }}</th>
                            <th>{{ translateConcat('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $s)
                        <tr>
                            <td>{{ $s['service_name'] ?? $s['name'] ?? '-' }}</td>
                            <td>{{ $s['hsn'] ?? '' }}</td>
                            <td>
                                {{ currency_symbol() . ($s['mrp'] ?? $s['price'] ?? 0) }}
                            </td>

                            <td>{{ $s['discount'] ?? '-' }}</td>
                            <td>{{ 'VAT: '.($s['cgst'] ?? 0).'%' }}</td>
                            <td>{{currency_symbol() .  $s['total'] ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- SUMMARY SECTION -->
        <div class="fk-card">


            <div class="fk-card-body text-right">
                <p>{{ translateConcat('Parts Total') }}: {{currency_symbol() .  $partsTotal }}</p>
                <p>{{ translateConcat('Services Total') }}: {{currency_symbol() .  $servicesTotal }}</p>
                <h5>{{ translateConcat('Grand Total') }}: {{currency_symbol() .  $grandTotal }}</h5>
            </div>
            <div class="fk-card-body d-flex flex-wrap justify-content-between">
                <!-- Back Button -->
                <a href="{{ route('jobcards.index') }}" class="btn btn-outline-primary mb-2">
                    {{ translate(' ← Back to Job Cards') }}
                </a>

                <!-- Action Buttons (Grouped) -->
                <div class="d-flex flex-wrap">
                    <!-- Download PDF Button -->
                    <a href="{{ route('jobcards.previewPdf', $jobcard->id) }}" class="btn btn-sm btn-info mb-2 mr-2"
                        title="Download as PDF">
                        <i class="fa fa-file-pdf-o mr-2"></i> {{ translate('Download PDF') }}
                    </a>

                    <!-- Download Thermal Print Button -->
                    <a href="{{ route('jobcard.print', $jobcard->id) }}" class="btn btn-sm btn-warning mb-2 mr-2"
                        title="Download Thermal Print">
                        <i class="fa fa-print mr-2"></i> {{ translate(' Thermal Print') }}
                    </a>
                </div>


            </div>

        </div>

        <!-- Add FontAwesome for Icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>


    </div>
</div>

@else
<div class="fk-card text-center">
    <div class="fk-card-header">{{ translateConcat('No Data Found') }}</div>
</div>
@endif

@endsection