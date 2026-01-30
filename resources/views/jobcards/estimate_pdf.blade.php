<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ translate('Job Card') }} {{ $jobcard->job_card_no }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
            position: relative;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.05);
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
            width: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .content {
            position: relative;
            z-index: 1;
            /* content is above watermark */
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header img {
            max-height: 70px;
            margin-bottom: 5px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #222;
            font-weight: normal;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: transparent;
            font-weight: normal;
        }

        .job-table th,
        .job-table td {
            text-align: center;
        }

        /* Footer */
        .footer {
            text-align: center;
            font-size: 11px;
            color: #777;
            margin-top: 30px;
        }
    </style>
</head>

<body>
            <!-- Watermark -->
        <div class="watermark">
            @php
                // Check the job card's work status and display the appropriate watermark text
                switch ($jobcard->work_status) {
                    case 5:
                        echo 'Rejected';
                        break;

                    case 2:
                        echo 'Approved';
                        break;

                    case 4:
                        echo 'Completed';
                        break;

                    default:
                        echo 'Draft'; // Default case, in case the work status is not matched
                        break;
                }
            @endphp
        </div>


    <div class="content">

        <!-- Header -->
        <div class="header">
            <img src="https://www.merigarage.com/software/img/logo/logo.png" alt="MeriGarage Logo">
            <h1>{{ translate('Job Card') }}</h1>
            <p>{{ translate('Job Card No') }}: <strong>{{ $jobcard->job_card_no }}</strong></p>
        </div>

        <!-- Customer Info -->
        <table>
            <tr>
                <th>{{ translate('Customer Name') }}</th>
                <td>{{ $jobcard->name }}</td>
            </tr>
            <tr>
                <th>{{ translate('Contact') }}</th>
                <td>{{ $jobcard->contact }}</td>
            </tr>
            <tr>
                <th>{{ translate('Email') }}</th>
                <td>{{ $jobcard->email }}</td>
            </tr>
            <tr>
                <th>{{ translate('Address') }}</th>
                <td>{{ $jobcard->address }}</td>
            </tr>
        </table>

        <!-- Vehicle Info -->
        <table>
            <tr>
                <th>{{ translate('Vehicle') }}</th>
                <td>{{ $jobcard->carbrand }} {{ $jobcard->carmodel }}</td>
            </tr>
            <tr>
                <th>{{ translate('Registration No') }}</th>
                <td>{{ $jobcard->registration }}</td>
            </tr>
            <tr>
                <th>{{ translate('Fuel Type') }}</th>
                <td>{{ $jobcard->fueltype ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>{{ translate('Odometer') }}</th>
                <td>{{ $jobcard->odometer ?? 'N/A' }} km</td>
            </tr>
            <tr>
                <th>{{ translate('Chassis No') }}</th>
                <td>{{ $jobcard->chassis_no ?? 'N/A' }}</td>
            </tr>
        </table>

        <!-- Service Details -->
        <table class="job-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('Service / Part') }}</th>
                    <th>{{ translate('Qty') }}</th>
                    <th>{{ translate('Rate') }}</th>
                    <th>{{ translate('Amount') }}</th>
                </tr>
            </thead>
            <tbody>
                @if($jobcard->service)
                @foreach(json_decode($jobcard->service) as $index => $service)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service->service_name ?? '-' }}</td>
                    <td>{{ $service->quantity ?? '-' }}</td>
                    <td>{{currency_symbol() .  $service->mrp ?? '0' }}</td>
                    <td>{{currency_symbol() .  $service->total ?? '0' }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" style="text-align: center;">{{ translate('No services added.') }}</td>
                </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align:right;">{{ translate('Total Amount') }}</th>
                    <th>{{currency_symbol() .  $jobcard->totalPrice }}</th>
                </tr>
            </tfoot>
        </table>

        <!-- Payment History -->
        <h3>{{ translate('Payment History') }}</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ translate('Payment Date') }}</th>
                    <th>{{ translate('Amount') }}</th>
                    <th>{{ translate('Status') }}</th>
                    <th>{{ translate('Payment Method') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobcard->payment as $payment)
                @php
                $payment = (object)$payment;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d-m-Y') }}</td>
                    <td>{{currency_symbol() .  $payment->amount }}</td>
                    <td>{{ $payment->status == 'C' ? 'Completed' : 'Pending' }}</td>
                    <td>{{ $payment->payment_type }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
           {{ translate('MeriGarage, Gurgaon | Mobile: 8802929885 | Email: alert@merigarage.com') }}
        </div>

    </div>

</body>

</html>
