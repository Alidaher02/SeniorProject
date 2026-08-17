<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to ShipTrack</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family:'Inter', ui-sans-serif, system-ui, -apple-system, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding: 40px 0;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border:1px solid #e5e7eb; border-radius:12px; overflow:hidden;">

          <!-- Header / Navbar -->
          <tr>
            <td style="background-color:#ffffff; padding: 24px 32px; border-bottom:1px solid #e5e7eb;">
              <table role="presentation" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="width:34px; height:34px; border-radius:8px; background-color:#2563eb; text-align:center; vertical-align:middle;">
                    <span style="font-size:16px; color:#ffffff; line-height:34px;">&#128230;</span>
                  </td>
                  <td style="padding-left:10px;">
                    <span style="color:#111827; font-size:18px; font-weight:700;">ShipTrack</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Hero -->
          <tr>
            <td style="padding: 40px 32px 16px 32px;">
              <p style="margin:0 0 8px 0; color:#2563eb; font-size:13px; font-weight:600; text-transform:uppercase; letter-spacing:1px;">Cold Chain Monitoring</p>
              <h1 style="margin:0 0 16px 0; color:#111827; font-size:26px; font-weight:700; line-height:1.3;">Welcome aboard, {{ $user->name }} 👋</h1>
              <p style="margin:0; color:#4b5563; font-size:15px; line-height:1.7;">
                Your ShipTrack account is live. From here on, every shipment you move gets real-time temperature, humidity, tilt, and light monitoring — with alerts the moment something drifts out of range.
              </p>
            </td>
          </tr>

          <!-- Feature cards -->
          <tr>
            <td style="padding: 24px 32px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px 20px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="width:36px; vertical-align:top;">
                          <div style="width:32px; height:32px; border-radius:8px; background-color:#2563eb; text-align:center; line-height:32px; font-size:15px;">📡</div>
                        </td>
                        <td style="padding-left:14px;">
                          <p style="margin:0 0 4px 0; color:#111827; font-size:14px; font-weight:600;">Live IoT Tracking</p>
                          <p style="margin:0; color:#6b7280; font-size:13px; line-height:1.6;">ESP32 sensors stream temperature, humidity, tilt and light data straight to your dashboard.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr><td style="height:12px;"></td></tr>
                <tr>
                  <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px 20px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="width:36px; vertical-align:top;">
                          <div style="width:32px; height:32px; border-radius:8px; background-color:#2563eb; text-align:center; line-height:32px; font-size:15px;">⚠️</div>
                        </td>
                        <td style="padding-left:14px;">
                          <p style="margin:0 0 4px 0; color:#111827; font-size:14px; font-weight:600;">Instant Threshold Alerts</p>
                          <p style="margin:0; color:#6b7280; font-size:13px; line-height:1.6;">Get notified the second a shipment breaches a safe range — no guesswork, no spoiled cargo.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr><td style="height:12px;"></td></tr>
                <tr>
                  <td style="background-color:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:18px 20px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="width:36px; vertical-align:top;">
                          <div style="width:32px; height:32px; border-radius:8px; background-color:#2563eb; text-align:center; line-height:32px; font-size:15px;">🤖</div>
                        </td>
                        <td style="padding-left:14px;">
                          <p style="margin:0 0 4px 0; color:#111827; font-size:14px; font-weight:600;">Ask the AI Assistant</p>
                          <p style="margin:0; color:#6b7280; font-size:13px; line-height:1.6;">Chat about any shipment without repeating tracking numbers, and get AI-generated PDF reports on demand.</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- CTA button -->
          <tr>
            <td align="center" style="padding: 12px 32px 40px 32px;">
              <table role="presentation" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="border-radius:8px; background-color:#2563eb;">
                    <a  style="display:inline-block; padding:14px 32px; color:#ffffff; font-size:15px; font-weight:600; text-decoration:none;">Go to Dashboard</a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding: 20px 32px; border-top:1px solid #e5e7eb;">
              <p style="margin:0 0 6px 0; color:#9ca3af; font-size:12px; line-height:1.6;">
                You're receiving this because you created an account on ShipTrack. If this wasn't you, please contact support immediately.
              </p>
              <p style="margin:0; color:#9ca3af; font-size:12px;">© {{ date('Y') }} ShipTrack. All rights reserved.</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>