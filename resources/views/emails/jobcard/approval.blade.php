<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ translate('Job Card Approval Request') }}</title>
</head>
<body style="margin:0; padding:20px; font-family: Arial, sans-serif; line-height:1.6; background-color:#f4f4f4;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table width="600" cellpadding="20" cellspacing="0" bgcolor="#ffffff" style="border-collapse:collapse;">
          <tr>
            <td>
              <p>{{ translate('Dear') }} {{ $jobcard->name }},</p>

              <p>
                {{ translate('We hope this message finds you well. This is') }} <strong>{{ translate('MeriGarage') }}</strong>, {{ translate('reaching out to inform you about the pending job card for your ') }}
                <strong>{{ $jobcard->carbrand }} {{ $jobcard->carmodel }}</strong> {{ translate('with registration number') }}: <strong>{{ $jobcard->registration }}</strong>.
              </p>

              <p>
               {{ translate('We kindly request your review and approval for the service. Please take an action below') }}:
              </p>

              <!-- Buttons -->
              <table cellspacing="0" cellpadding="0" style="margin:20px 0;">
                <tr>
                  <td>
                    <!-- Approve Button for Outlook -->
                    <!--[if mso]>
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                      href="{{ route('jobcards.approve', ['id' => $jobcard->id]) }}"
                      style="height:40px;v-text-anchor:middle;width:120px;" arcsize="10%" strokecolor="#28a745" fillcolor="#28a745">
                      <w:anchorlock/>
                      <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">Approve</center>
                    </v:roundrect>
                    <![endif]-->

                    <!-- Fallback for Gmail/Other clients -->
                    <!--[if !mso]><!-- -->
                    <a href="{{ route('jobcards.approve', ['id' => $jobcard->id]) }}"
                       style="display:inline-block; background-color:#28a745; color:#ffffff; padding:12px 25px; font-size:16px; font-weight:bold; text-decoration:none; border-radius:4px;">
                       {{ translate('Approve') }}
                    </a>
                    <!--<![endif]-->
                  </td>

                  <td style="width:10px;">&nbsp;</td>

                  <td>
                    <!-- Reject Button for Outlook -->
                    <!--[if mso]>
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                      href="{{ route('jobcards.reject', ['id' => $jobcard->id]) }}"
                      style="height:40px;v-text-anchor:middle;width:120px;" arcsize="10%" strokecolor="#dc3545" fillcolor="#dc3545">
                      <w:anchorlock/>
                      <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">Reject</center>
                    </v:roundrect>
                    <![endif]-->

                    <!-- Fallback for Gmail/Other clients -->
                    <!--[if !mso]> -->
                    <a href="{{ route('jobcards.reject', ['id' => $jobcard->id]) }}"
                       style="display:inline-block; background-color:#dc3545; color:#ffffff; padding:12px 25px; font-size:16px; font-weight:bold; text-decoration:none; border-radius:4px;">
                       {{ translate('Reject') }}
                    </a>
                    <!--<![endif]-->
                  </td>

                  <td style="width:10px;">&nbsp;</td>

                  <td>
                    <!-- Preview Button for Outlook -->
                    <!--[if mso]>
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                      href="{{ route('jobcards.previewPdf', ['id' => $jobcard->id]) }}"
                      style="height:40px;v-text-anchor:middle;width:120px;" arcsize="10%" strokecolor="#007bff" fillcolor="#007bff">
                      <w:anchorlock/>
                      <center style="color:#ffffff;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;">Preview</center>
                    </v:roundrect>
                    <![endif]-->

                    <!-- Fallback for Gmail/Other clients -->
                    <!--[if !mso]><!-- -->
                    <a href="{{ route('jobcards.previewPdf', ['id' => $jobcard->id]) }}"
                       style="display:inline-block; background-color:#007bff; color:#ffffff; padding:12px 25px; font-size:16px; font-weight:bold; text-decoration:none; border-radius:4px;">
                       Preview
                    </a>
                    <!--<![endif]-->
                  </td>
                </tr>
              </table>

              <p>
                {{ translate('Our team is dedicated to providing the best service, and your timely action ensures a smooth and efficient process.') }}
              </p>

              <p>
               {{ translate('Thank you for choosing') }} <strong>{{ translate('MeriGarage') }}</strong>.
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
