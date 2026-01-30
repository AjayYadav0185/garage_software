<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ translate('Credit Invoice') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            page-break-inside: avoid;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left-indent {
            text-align: left;
            padding-left: 5px;
        }

        .bold {
            font-weight: bold;
        }

        .section-title {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        .footer {
            text-align: center;
            font-size: 10px;
        }

        img {
            max-width: 50px;
        }
    </style>
</head>

<body>
    @php
        function nf($val)
        {
            return number_format($val ?? 0, 2);
        }
    @endphp
    <div style="page-break-inside: avoid;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 25%; text-align: left;">
                    <img src="logo.png" alt="Logo" style="height: 60px;">
                </td>
                <td
                    style="width: 50%; text-align: center; font-weight: bold; font-size: 20px; border-right: none !important;">
                    <div style="margin-left: 150px; padding-top: 20px;">
                       {{ translate(' Credit Invoice') }}
                    </div>
                </td>
                <td style="width: 25%; font-size: 20px; border-left: none !important;"></td>
            </tr>
        </table>


        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td rowspan="2" style="width: 60%; vertical-align: top; border-bottom: 1px solid #ffffff; ">
                    <strong>{{ translate('RAPPIDX GLOBAL BUSINESS SOLUTIONS PRIVATE LIMITED') }}</strong><br>
                   {{ translate(' Block D-8 Ground Floor, 42 POCKET 8, Sector 23B Dwarka, Delhi, South West Delhi, New Delhi - 110077') }}
                </td>
                <td style="text-align: left; white-space: nowrap;">
                   {{ translate('CN Against Invoice No:') }} {{ $data->credit_id }}
                </td>
            </tr>
            <tr>
                <td style="text-align: left; white-space: nowrap;">
                    {{ translate('CN Against Invoice Date :') }}
                    {{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}
                </td>

            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <span style="display: inline-block; width: 100px;">{{ translate('STATE CODE:') }}</span>{{ translate(' 07') }}<br>
                    <span style="display: inline-block; width: 100px;">{{ translate('TAXIN/UIN:') }}</span> {{ translate('07AAKCR5031M1Z3') }}<br>
                    <span style="display: inline-block; width: 100px;">{{ translate('PAN') }}:</span> {{ translate('ABC') }}<br>
                    <span style="display: inline-block; width: 100px;">{{ translate('CIN') }}:</span> {{ translate('123456') }}
                </td>
                <td style="vertical-align: top;">
                    <span style="display: inline-block; width: 100px;">{{ translate('CN No :') }}</span>
                    {{ $data->credit_id }}<br>
                    <div style="height: 1px; background-color: #000; margin: 4px 0;"></div>
                    <span style="display: inline-block; width: 100px;">{{ translate('CN Issued Date :') }}</span>
                    {{ \Carbon\Carbon::parse($data->issued_date)->format('d-m-Y') }}
                </td>
            </tr>
        </table>



        <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
            <tr>
                <td colspan="2" class="section-title" style="font-weight: bold; padding-bottom: 5px;">{{translate('Consignee Details') }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="left">
                    <span style="display: inline-block; width: 120px;">{{ translate('Consignee Name:') }}</span>
                    {{ $data->Company_Name }}<br>
                    <span style="display: inline-block; width: 120px;">{{ translate('Billing Address:') }}</span>
                    {{ !empty($data->Com_Address) ? $data->Com_Address : $data->Reg_Address }}<br>
                    <span style="display: inline-block; width: 120px;">{{ translate('PAN') }}:</span> {{ $data->Pan }}<br>
                    <span style="display: inline-block; width: 120px;">{{ translate('TAXIN/UIN') }}:</span> {{ $data->user_gst ?? null }}
                </td>
            </tr>
        </table>




        <table>
            <tr class="section-title">
                <th class="center" style="width: 5%;">{{ translate('S No') }}</th>
                <th class="center">{{ translate('Description of Services') }}</th>
                <th class="center" style="width: 12%;">{{ translate('HSN/SAC') }}</th>
                <th class="center" style="width: 10%;">{{ translate('Qty') }}</th>
                <th class="center" style="width: 10%;">{{ translate('Rate') }}</th>
                <th class="center" style="width: 10%;">{{ translate('Unit') }}</th>
                <th class="center" style="width: 15%;">{{ translate('Amount') }}</th>
            </tr>
            <tr>
                <td class="center">1</td>
                <td class="center">{{$data->service ?? null}}</td>
                <td class="center">{{ $data->hsn_sac ?? null }}</td>
                <td class="center">{{ $data->quantity ?? null }}</td>
                <td class="center">{{ nf($data->rate ?? null) }}</td>
                <td class="center"></td>
                <td class="right">{{ nf($data->amount ?? null) }}</td>
            </tr>

            <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>{{ translate('SGST') }}</strong></td>
                <td class="right">{{ number_format($data->SGST ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>{{ translate('CGST') }}</strong></td>
                <td class="right">{{ number_format($data->CGST ?? 0, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>{{ translate('IGST') }}</strong></td>
                <td class="right">{{ number_format($data->IGST ?? 0, 2)}}</td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>{{ translate('Total Amount') }}</strong></td>
                <td class="right">{{ number_format($data->amount ?? 0, 2) }}</td>
            </tr>
            {{-- <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>Paid</strong></td>
                {{ number_format($data->Paid ?? 0, 2) }}
                <td class="right"></td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td class="left-indent"><strong>Due Amount</strong></td>
                {{ number_format(($data->total ?? 0) - ($data->Paid ?? 0), 2) }}
                <td class="right"><strong></strong></td>
            </tr> --}}
        </table>


        <table>
            <tr>
                <td class="left"><strong>{{ translate('Amount (in words)') }}</strong>: {{currency()}} {{ $totalInWords }}</td>
                <td style="text-align: right;">{{ translate('E. & O.E') }}</td>
            </tr>
        </table>




        <table>
            <tr>
                <th class="center" rowspan="2">{{ translate('HSN/SAC') }}</th>
                <th class="center" rowspan="2">{{ translate('Taxable Value') }}</th>
                <th class="center" colspan="2">{{ translate('TAX') }}</th>
                <th class="center" rowspan="2">{{ translate('Total Tax') }}</th>
            </tr>
            <tr>
                <th class="center">{{ translate('Rate') }}</th>
                <th class="center">{{ translate('Amount') }}</th>
            </tr>
            <tr>
                <td class="center">{{ $data->hsn_sac ?? 0}}</td>
                <td class="center">{{ nf($data->amount ?? 0.0) }}</td>
                <td class="center">{{ nf($data->rate ?? 0.0)  }}%</td>
                <td class="center">{{ nf($data->rate ?? 0.0) }}</td>
                <td class="center">{{ nf($data->rate ?? 0.0) }}</td>
            </tr>
            <tr>
                <td class="right"><b>{{ translate('Total') }}</b></td>
                <td class="center"><b>{{ nf($data->amount) }}</b></td>
                <td></td>
                <td class="center"><b>{{ nf($data->amounts ?? 0.0) }}</b></td>
                <td class="center"><b>{{ nf($data->amount) }}</b></td>
            </tr>
        </table>


        <table>
            <tr>
                <td class="left"><strong>{{ translate('Tax Amount (in words)') }}</strong>: {{currency()}} {{ $amountsInWords }}</td>
            </tr>
        </table>




        <table style="border: 1px solid #000;">
            <tr>
                <td colspan="2" class="section-title">{{ translate('Remittance to be made to the following accounts:') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="left">
                    <span style="display: inline-block; width: 120px;">{{ translate('Beneficiary Name:') }}</span> {{ translate('RAPPIDX GLOBAL BUSINESS
                    SOLUTIONS PRIVATE LIMITED') }}<br>

                    @if(!empty($data->Bankname))
                        <span style="display: inline-block; width: 120px;">{{ translate('Bank:') }}</span> {{ $data->Bankname }}<br>
                    @endif

                    @if(!empty($data->Bankaccount))
                        <span style="display: inline-block; width: 120px;">{{ translate('Account Number:') }}</span>
                        {{ $data->Bankaccount }}<br>
                    @endif

                    @if(!empty($data->IFSC))
                        <span style="display: inline-block; width: 120px;">{{ translate('IFSC Code:') }}</span> {{ $data->IFSC }}<br><br>
                    @endif

                    {{ translate('Terms:
                    Please make all cheques/DD payable to RAPPIDX GLOBAL BUSINESS SOLUTIONS PRIVATE LIMITED') }}<br>
                    {{-- Interest @ 18% p.a. will be charged if payment is not made within the stipulated time.<br> --}}
                    {{ translate('Subject to "Delhi" Jurisdiction only.') }}
                </td>
            </tr>

            <tr>
                <td colspan="2" style="text-align: right; padding-top: 30px; border: #000 2px solid">
                    {{ translate('for RAPPIDX GLOBAL BUSINESS SOLUTIONS PRIVATE LIMITED') }}<br><br>
                   {{ translate(' Authorised Signatory') }}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="footer" style="text-align: left;">
                    {{ translate('This is a computer generated document and does not require any stamp or signature') }}<br>
                    {{ translate('Registered Address') }}
                </td>
            </tr>

        </table>

    </div>

</body>

</html>
