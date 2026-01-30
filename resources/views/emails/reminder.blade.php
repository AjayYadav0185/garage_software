<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reminder Notification</title>
</head>
<body style="margin:0; padding:20px; font-family: Arial, sans-serif; line-height:1.6; background-color:#f4f4f4;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" cellpadding="20" cellspacing="0" bgcolor="#ffffff" style="border-collapse:collapse;">
          <tr>
            <td>
              <p>{{ translate('Dear') }} {{ $reminder->name }},</p>

              <p>
               {{ translate('We hope this message finds you well. This is') }} <strong>{{ translate('MeriGarage') }}</strong> {{ translate('to remind you about your upcoming') }}
                <strong>{{ ucfirst($reminder->reminder_type) }} {{ translate('Reminder') }}</strong>.
              </p>

              @if($reminder->service_date)
              <p>
                {{ translate('The scheduled date for this reminder is') }}: <strong>{{ \Carbon\Carbon::parse($reminder->service_date)->format('d M, Y') }}</strong>.
              </p>
              @endif

              <p>
               {{ translate('Thank you for choosing ') }}<strong>{{ translate('MeriGarage') }}</strong>.{{ translate(' We look forward to assisting you and ensuring your vehicle remains in top condition.') }}
              </p>

              <p>
                {{ translate('Best regards') }},<br>
                <strong>{{ translate('MeriGarage') }}</strong><br>
               {{ translate('Mobile: 8802929885') }}<br>
                {{ translate('Address: Gurgaon') }}
              </p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
