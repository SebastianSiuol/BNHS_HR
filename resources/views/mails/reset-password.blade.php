<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td align="center" valign="top" style="padding: 20px;">
        <!-- Inner Container -->
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="background: #ffffff; padding: 20px; border: solid 1px black; border-radius: 10px;">
          <tr>
            <td colspan="2" align="center" style="padding-bottom: 20px;">
              <div style="display: flex; align-items: center; justify-content: center;">
                <img src="https://bnhs-hr.onrender.com/imgs/bhnhs_logo.png" width="100" height="80" alt="Batasan Hills National Highschool Logo" style="border-radius: 10px; margin-right: 10px;">
                <h1 style="margin: 0; font-size: 24px; color: #333;">
                  Batasan National Highschool
                </h1>
              </div>
            </td>
          </tr>

          <tr>
            <td colspan="2" align="center" style="padding-bottom: 15px;">
              <p style="margin: 0; font-size: 16px; font-weight: bold; color: #333;">Reset Password Request</p>
              <p style="margin: 5px 0; font-size: 14px; color: #555;">
                Please click the link below to continue to reset your password:
              </p>
            </td>
          </tr>
          <tr>
            <td align="center" style="padding: 10px; font-size: 14px; color: #333; font-weight: bold; background: #f8f8f8; border-radius: 5px;">
              {{ $data['reset_url'] }}
            </td>
          </tr>
          <tr>
            <td align="center" style="padding-bottom: 15px;">
              <p style="margin: 5px 0; font-size: 14px; color: #555;">
                Ignore this email if you did not request this password reset.
              </p>
            </td>
          </tr>
          <!-- Disclaimer Section -->
          <tr>
            <td colspan="2" align="center" style="padding-top: 20px;">
              <p style="margin: 0; font-size: 12px; color: #888;">
                <strong>Disclaimer:</strong> This email is part of a capstone project and should not be used for any illegal actions. <br />
                Any misuse of this information is strictly prohibited.
              </p>
            </td>
          </tr>
        </table>

        <!-- Footer Section -->
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="margin-top: 20px;">
          <tr>
            <td align="center" style="font-size: 12px; color: #888;">
              <p style="margin: 0;">&copy; 2024 - 2025 Batasan Hills National Highschool. All rights reserved.</p>
              <p style="margin: 5px 0;">This is an automated email, please do not reply.</p>
            </td>
          </tr>
        </table>

      </td>
    </tr>
  </table>
</body>



</html>