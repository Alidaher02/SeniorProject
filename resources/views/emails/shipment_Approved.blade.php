<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shipment Approved</title>
</head>

<body style="margin:0; padding:0; background:#f8fafc; font-family:Inter, Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc; padding:40px 0;">
<tr>
<td align="center">

    <table width="600" cellpadding="0" cellspacing="0"
        style="background:white; border-radius:16px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.08);">

        <!-- Header -->
        <tr>
            <td style="padding:30px; text-align:center; background:white;">

                <div style="
                    width:60px;
                    height:60px;
                    margin:auto;
                    border-radius:16px;
                    background:#2563eb;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">

                    <span style="
                        color:white;
                        font-size:28px;
                        font-weight:bold;
                    ">
                        ❄
                    </span>

                </div>


                <h1 style="
                    margin:15px 0 5px;
                    color:#1e3a8a;
                    font-size:24px;
                ">
                    Cold Chain
                </h1>

                <p style="
                    margin:0;
                    color:#64748b;
                    font-size:14px;
                ">
                    Smart Shipment Tracking System
                </p>

            </td>
        </tr>


        <!-- Blue line -->
        <tr>
            <td style="
                height:5px;
                background:#2563eb;
            ">
            </td>
        </tr>


        <!-- Content -->
        <tr>
            <td style="padding:35px;">


                <h2 style="
                    color:#2563eb;
                    margin-top:0;
                ">
                    Shipment Approved ✅
                </h2>


                <p style="color:#334155;font-size:15px;">
                    Hello {{ $user->name }},
                </p>


                <p style="
                    color:#475569;
                    line-height:1.6;
                ">
                    Your shipment has been approved successfully.
                    You can now monitor its status and temperature tracking.
                </p>



                <!-- Shipment Card -->

                <table width="100%" cellpadding="0" cellspacing="0"
                    style="
                    margin-top:25px;
                    background:#eff6ff;
                    border-radius:12px;
                    padding:20px;
                    ">

                    <tr>
                        <td style="padding:8px;color:#64748b;">
                            Product
                        </td>
                        <td style="padding:8px;color:#0f172a;font-weight:600;">
                            {{ $shipment->product_name }}
                        </td>
                    </tr>


                    <tr>
                        <td style="padding:8px;color:#64748b;">
                            Tracking Number
                        </td>
                        <td style="padding:8px;color:#0f172a;font-weight:600;">
                            {{ $shipment->tracking_number }}
                        </td>
                    </tr>


                    <tr>
                        <td style="padding:8px;color:#64748b;">
                            Origin
                        </td>
                        <td style="padding:8px;color:#0f172a;font-weight:600;">
                            {{ $shipment->origin }}
                        </td>
                    </tr>


                    <tr>
                        <td style="padding:8px;color:#64748b;">
                            Destination
                        </td>
                        <td style="padding:8px;color:#0f172a;font-weight:600;">
                            {{ $shipment->destination }}
                        </td>
                    </tr>


                    <tr>
                        <td style="padding:8px;color:#64748b;">
                            Status
                        </td>
                        <td style="padding:8px;color:#2563eb;font-weight:700;">
                            {{ $shipment->status->value }}
                        </td>
                    </tr>

                </table>



                <!-- Button -->

                <div style="text-align:center;margin-top:30px;">

                    <a href="/shipments/{{ $shipment->id }}"
                    style="
                    background:#2563eb;
                    color:white;
                    padding:14px 30px;
                    border-radius:10px;
                    text-decoration:none;
                    font-weight:600;
                    display:inline-block;
                    ">
                        View Shipment
                    </a>

                </div>



            </td>
        </tr>



        <!-- Footer -->

        <tr>
            <td style="
                padding:20px;
                text-align:center;
                background:#f8fafc;
                color:#64748b;
                font-size:12px;
            ">

                © {{ date('Y') }} Cold Chain Tracking System  
                <br>
                Keeping your shipments safe and monitored.

            </td>
        </tr>


    </table>


</td>
</tr>
</table>


</body>
</html>