<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ translate('Revenue Report') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>{{ translate('Revenue Report') }}</h2>
    <p><strong>{{ translate('Period') }}:</strong> {{ date("F Y", strtotime($revStart . "-01")) }} - {{ date("F Y", strtotime($revEnd . "-01")) }}</p>
    <table>
        <thead>
            <tr>
                <th>{{ translate('Month') }}</th>
                <th>{{ translate('Total Revenue') }} ({{currency_symbol()}})</th>
            </tr>
        </thead>
        <tbody>
            @foreach($revenue as $row)
            <tr>
                <td>{{ date("F Y", strtotime($row->month . "-01")) }}</td>
                <td>{{ number_format($row->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
