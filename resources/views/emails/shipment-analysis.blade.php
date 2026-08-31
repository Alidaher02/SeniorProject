<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Delivered</title>
</head>

<body style="margin:0; padding:0; background:#f8fafc; font-family:Arial, Helvetica, sans-serif; color:#0f172a;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f8fafc; padding:40px 16px;">
    <tr>
        <td align="center">

            <table width="560" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:560px; width:100%; background:#ffffff; border:1px solid #e2e8f0; border-radius:12px;">

                {{-- HEADER --}}
                <tr>
                    <td style="padding:28px 32px; border-bottom:1px solid #e2e8f0;">

                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-size:18px; font-weight:700; color:#0f172a;">
                                    ShipTrack
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                {{-- CONTENT --}}
                <tr>
                    <td style="padding:40px 32px;">

                        {{-- STATUS --}}
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="
                                    width:10px;
                                    height:10px;
                                    background:#22c55e;
                                    border-radius:50%;
                                    font-size:0;
                                ">
                                    &nbsp;
                                </td>

                                <td style="
                                    padding-left:9px;
                                    font-size:12px;
                                    font-weight:600;
                                    color:#16a34a;
                                    text-transform:uppercase;
                                    letter-spacing:0.5px;
                                ">
                                    Shipment delivered
                                </td>
                            </tr>
                        </table>

                        {{-- TITLE --}}
                        <h1 style="
                            margin:18px 0 10px;
                            font-size:28px;
                            line-height:1.2;
                            font-weight:700;
                            color:#0f172a;
                        ">
                            Your shipment has arrived.
                        </h1>

                        <p style="
                            margin:0;
                            color:#64748b;
                            font-size:14px;
                            line-height:1.7;
                        ">
                            Your shipment has successfully reached its destination.
                            We've completed the monitoring process and generated the
                            final AI analysis report.
                        </p>

                        {{-- SHIPMENT INFO --}}
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="margin-top:30px;">

                            <tr>
                                <td style="
                                    padding:18px 0;
                                    border-top:1px solid #e2e8f0;
                                    border-bottom:1px solid #e2e8f0;
                                ">

                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>

                                            <td>
                                                <div style="
                                                    font-size:11px;
                                                    color:#94a3b8;
                                                    text-transform:uppercase;
                                                    letter-spacing:0.6px;
                                                ">
                                                    Tracking number
                                                </div>

                                                <div style="
                                                    margin-top:6px;
                                                    font-size:15px;
                                                    font-weight:600;
                                                    color:#0f172a;
                                                ">
                                                    {{ $shipment->{'tracking-number'} ?? 'N/A' }}
                                                </div>
                                            </td>

                                            <td align="right">
                                                <div style="
                                                    font-size:11px;
                                                    color:#94a3b8;
                                                    text-transform:uppercase;
                                                    letter-spacing:0.6px;
                                                ">
                                                    Status
                                                </div>

                                                <div style="
                                                    margin-top:6px;
                                                    font-size:14px;
                                                    font-weight:600;
                                                    color:#16a34a;
                                                ">
                                                    Delivered
                                                </div>
                                            </td>

                                        </tr>
                                    </table>

                                </td>
                            </tr>

                        </table>

                        {{-- REPORT --}}
                        <table width="100%" cellpadding="0" cellspacing="0" border="0"
                               style="margin-top:28px;">

                            <tr>
                                <td style="
                                    padding:20px;
                                    background:#f8fafc;
                                    border:1px solid #e2e8f0;
                                    border-radius:10px;
                                ">

                                    <div style="
                                        font-size:14px;
                                        font-weight:600;
                                        color:#0f172a;
                                    ">
                                        Final AI analysis
                                    </div>

                                    <div style="
                                        margin-top:6px;
                                        font-size:13px;
                                        line-height:1.6;
                                        color:#64748b;
                                    ">
                                        Your complete shipment monitoring report is
                                        attached to this email as a PDF.
                                    </div>

                                </td>
                            </tr>

                        </table>

                        {{-- CTA --}}
                        <table cellpadding="0" cellspacing="0" border="0" style="margin-top:28px;">
                            <tr>
                                <td style="
                                    background:#0f172a;
                                    border-radius:8px;
                                ">
                                    <a href="#"
                                       style="
                                           display:inline-block;
                                           padding:12px 20px;
                                           color:#ffffff;
                                           text-decoration:none;
                                           font-size:13px;
                                           font-weight:600;
                                       ">
                                        View Shipment
                                    </a>
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="
                        padding:22px 32px;
                        background:#f8fafc;
                        border-top:1px solid #e2e8f0;
                    ">

                        <div style="
                            font-size:11px;
                            line-height:1.6;
                            color:#94a3b8;
                        ">
                            This email was automatically generated by ShipTrack.
                            <br>
                            Tracking: {{ $shipment->{'tracking-number'} ?? $shipment->id }}
                        </div>

                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>