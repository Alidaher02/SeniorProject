```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shipment Analysis</title>
</head>

<body style="
    margin:0;
    padding:0;
    background:#f4f8f6;
    font-family:Arial, Helvetica, sans-serif;
    color:#0f172a;
">

    <!-- OUTER CONTAINER -->
    <table
        width="100%"
        cellpadding="0"
        cellspacing="0"
        border="0"
        style="background:#f4f8f6; padding:40px 16px;"
    >
        <tr>
            <td align="center">

                <!-- MAIN CARD -->
                <table
                    width="620"
                    cellpadding="0"
                    cellspacing="0"
                    border="0"
                    style="
                        width:100%;
                        max-width:620px;
                        background:#ffffff;
                        border:1px solid #dfe9e3;
                        border-radius:16px;
                        overflow:hidden;
                    "
                >

                    <!-- ========================= -->
                    <!-- HEADER -->
                    <!-- ========================= -->

                    <tr>
                        <td style="
                            padding:26px 34px;
                            border-bottom:1px solid #e5eee8;
                        ">

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                            >
                                <tr>

                                    <!-- LOGO -->
                                    <td>
                                        <table
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                        >
                                            <tr>

                                                <td style="
                                                    width:38px;
                                                    height:38px;
                                                    background:#ecfdf3;
                                                    border:1px solid #bbf7d0;
                                                    border-radius:10px;
                                                    text-align:center;
                                                    vertical-align:middle;
                                                    font-size:20px;
                                                    font-weight:700;
                                                    color:#16a34a;
                                                ">
                                                    ✓
                                                </td>

                                                <td style="
                                                    padding-left:11px;
                                                    font-size:19px;
                                                    font-weight:700;
                                                    color:#0f172a;
                                                ">
                                                    ShipTrack
                                                </td>

                                            </tr>
                                        </table>
                                    </td>

                                    <!-- STATUS -->
                                    <td align="right">
                                        <span style="
                                            display:inline-block;
                                            padding:7px 11px;
                                            background:#ecfdf3;
                                            border:1px solid #bbf7d0;
                                            border-radius:999px;
                                            color:#15803d;
                                            font-size:11px;
                                            font-weight:700;
                                            text-transform:uppercase;
                                            letter-spacing:0.5px;
                                        ">
                                            Delivered
                                        </span>
                                    </td>

                                </tr>
                            </table>

                        </td>
                    </tr>


                    <!-- ========================= -->
                    <!-- HERO -->
                    <!-- ========================= -->

                    <tr>
                        <td style="
                            padding:42px 34px 34px;
                        ">

                            <!-- GREEN STATUS -->
                            <table
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                            >
                                <tr>

                                    <td style="
                                        width:12px;
                                        height:12px;
                                        background:#22c55e;
                                        border-radius:50%;
                                        font-size:0;
                                    ">
                                        &nbsp;
                                    </td>

                                    <td style="
                                        padding-left:9px;
                                        color:#16a34a;
                                        font-size:12px;
                                        font-weight:700;
                                        text-transform:uppercase;
                                        letter-spacing:0.7px;
                                    ">
                                        Shipment successfully delivered
                                    </td>

                                </tr>
                            </table>


                            <!-- TITLE -->

                            <h1 style="
                                margin:18px 0 12px;
                                font-size:31px;
                                line-height:1.18;
                                font-weight:700;
                                letter-spacing:-0.5px;
                                color:#0f172a;
                            ">
                                Your shipment has arrived.
                            </h1>


                            <!-- DESCRIPTION -->

                            <p style="
                                margin:0;
                                max-width:500px;
                                color:#64748b;
                                font-size:14px;
                                line-height:1.7;
                            ">
                                The shipment has successfully reached its destination.
                                ShipTrack has completed the monitoring process and
                                generated the final AI analysis report.
                            </p>


                            <!-- ========================= -->
                            <!-- SHIPMENT SUMMARY -->
                            <!-- ========================= -->

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="
                                    margin-top:30px;
                                    background:#f8fbf9;
                                    border:1px solid #e1ebe5;
                                    border-radius:12px;
                                "
                            >
                                <tr>
                                    <td style="padding:22px;">

                                        <table
                                            width="100%"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                        >

                                            <!-- TRACKING -->
                                            <tr>

                                                <td style="
                                                    width:50%;
                                                    padding-right:12px;
                                                    vertical-align:top;
                                                ">

                                                    <div style="
                                                        font-size:10px;
                                                        font-weight:700;
                                                        color:#94a3b8;
                                                        text-transform:uppercase;
                                                        letter-spacing:0.7px;
                                                    ">
                                                        Tracking number
                                                    </div>

                                                    <div style="
                                                        margin-top:7px;
                                                        font-size:15px;
                                                        font-weight:700;
                                                        color:#0f172a;
                                                        word-break:break-all;
                                                    ">
                                                        {{ $shipment->{'tracking-number'} ?? 'N/A' }}
                                                    </div>

                                                </td>


                                                <!-- STATUS -->
                                                <td style="
                                                    width:50%;
                                                    padding-left:12px;
                                                    vertical-align:top;
                                                ">

                                                    <div style="
                                                        font-size:10px;
                                                        font-weight:700;
                                                        color:#94a3b8;
                                                        text-transform:uppercase;
                                                        letter-spacing:0.7px;
                                                    ">
                                                        Shipment status
                                                    </div>

                                                    <div style="
                                                        margin-top:7px;
                                                        font-size:15px;
                                                        font-weight:700;
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


                            <!-- ========================= -->
                            <!-- AI REPORT CARD -->
                            <!-- ========================= -->

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="margin-top:24px;"
                            >
                                <tr>

                                    <td style="
                                        padding:22px;
                                        background:#ffffff;
                                        border:1px solid #dfe9e3;
                                        border-radius:12px;
                                    ">

                                        <!-- CARD HEADER -->

                                        <table
                                            width="100%"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                        >
                                            <tr>

                                                <td>

                                                    <div style="
                                                        font-size:10px;
                                                        font-weight:700;
                                                        color:#16a34a;
                                                        text-transform:uppercase;
                                                        letter-spacing:0.7px;
                                                    ">
                                                        ShipTrack Intelligence
                                                    </div>

                                                    <div style="
                                                        margin-top:6px;
                                                        font-size:17px;
                                                        font-weight:700;
                                                        color:#0f172a;
                                                    ">
                                                        Final AI analysis
                                                    </div>

                                                </td>

                                                <td align="right">

                                                    <div style="
                                                        width:34px;
                                                        height:34px;
                                                        background:#ecfdf3;
                                                        border:1px solid #bbf7d0;
                                                        border-radius:9px;
                                                        text-align:center;
                                                        line-height:34px;
                                                        font-size:16px;
                                                        color:#16a34a;
                                                    ">
                                                        ✓
                                                    </div>

                                                </td>

                                            </tr>
                                        </table>


                                        <!-- DIVIDER -->

                                        <div style="
                                            height:1px;
                                            background:#e5eee8;
                                            margin:17px 0;
                                        ">
                                        </div>


                                        <!-- DESCRIPTION -->

                                        <p style="
                                            margin:0;
                                            color:#64748b;
                                            font-size:13px;
                                            line-height:1.7;
                                        ">
                                            Your complete shipment monitoring data and
                                            AI-generated analysis have been compiled
                                            into the attached PDF report.
                                        </p>


                                        <!-- REPORT INCLUDED -->

                                        <table
                                            width="100%"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                            style="margin-top:18px;"
                                        >
                                            <tr>

                                                <td style="
                                                    width:20px;
                                                    vertical-align:top;
                                                    color:#22c55e;
                                                    font-size:14px;
                                                    font-weight:700;
                                                ">
                                                    ✓
                                                </td>

                                                <td style="
                                                    padding-bottom:8px;
                                                    color:#475569;
                                                    font-size:12px;
                                                ">
                                                    Shipment monitoring results
                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="
                                                    width:20px;
                                                    vertical-align:top;
                                                    color:#22c55e;
                                                    font-size:14px;
                                                    font-weight:700;
                                                ">
                                                    ✓
                                                </td>

                                                <td style="
                                                    padding-bottom:8px;
                                                    color:#475569;
                                                    font-size:12px;
                                                ">
                                                    Risk and condition analysis
                                                </td>

                                            </tr>

                                            <tr>

                                                <td style="
                                                    width:20px;
                                                    vertical-align:top;
                                                    color:#22c55e;
                                                    font-size:14px;
                                                    font-weight:700;
                                                ">
                                                    ✓
                                                </td>

                                                <td style="
                                                    color:#475569;
                                                    font-size:12px;
                                                ">
                                                    AI-generated recommendations
                                                </td>

                                            </tr>

                                        </table>

                                    </td>

                                </tr>
                            </table>


                            <!-- ========================= -->
                            <!-- ATTACHMENT -->
                            <!-- ========================= -->

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="margin-top:18px;"
                            >
                                <tr>

                                    <td style="
                                        padding:18px 20px;
                                        background:#f0fdf4;
                                        border:1px solid #bbf7d0;
                                        border-radius:10px;
                                    ">

                                        <table
                                            width="100%"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                        >
                                            <tr>

                                                <td style="
                                                    width:42px;
                                                    vertical-align:middle;
                                                ">

                                                    <div style="
                                                        width:36px;
                                                        height:36px;
                                                        background:#ffffff;
                                                        border:1px solid #bbf7d0;
                                                        border-radius:8px;
                                                        text-align:center;
                                                        line-height:36px;
                                                        font-size:16px;
                                                        color:#16a34a;
                                                        font-weight:700;
                                                    ">
                                                        PDF
                                                    </div>

                                                </td>

                                                <td style="
                                                    padding-left:12px;
                                                    vertical-align:middle;
                                                ">

                                                    <div style="
                                                        font-size:13px;
                                                        font-weight:700;
                                                        color:#166534;
                                                    ">
                                                        Shipment analysis report
                                                    </div>

                                                    <div style="
                                                        margin-top:3px;
                                                        font-size:11px;
                                                        color:#65a30d;
                                                    ">
                                                        Attached to this email
                                                    </div>

                                                </td>

                                                <td align="right" style="
                                                    vertical-align:middle;
                                                    font-size:18px;
                                                    color:#16a34a;
                                                ">
                                                    →
                                                </td>

                                            </tr>
                                        </table>

                                    </td>

                                </tr>
                            </table>


                            <!-- ========================= -->
                            <!-- CTA -->
                            <!-- ========================= -->

                            <table
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="margin-top:28px;"
                            >
                                <tr>

                                    <td style="
                                        background:#16a34a;
                                        border-radius:9px;
                                    ">

                                        <a
                                            href="#"
                                            style="
                                                display:inline-block;
                                                padding:13px 22px;
                                                color:#ffffff;
                                                text-decoration:none;
                                                font-size:13px;
                                                font-weight:700;
                                            "
                                        >
                                            View Shipment
                                        </a>

                                    </td>

                                </tr>
                            </table>

                        </td>
                    </tr>


                    <!-- ========================= -->
                    <!-- FOOTER -->
                    <!-- ========================= -->

                    <tr>
                        <td style="
                            padding:24px 34px;
                            background:#f8fbf9;
                            border-top:1px solid #e5eee8;
                        ">

                            <table
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                            >
                                <tr>

                                    <td>

                                        <div style="
                                            font-size:12px;
                                            font-weight:700;
                                            color:#475569;
                                        ">
                                            ShipTrack
                                        </div>

                                        <div style="
                                            margin-top:5px;
                                            font-size:10px;
                                            line-height:1.6;
                                            color:#94a3b8;
                                        ">
                                            Shipment monitoring & intelligence
                                        </div>

                                    </td>

                                    <td align="right">

                                        <div style="
                                            font-size:10px;
                                            line-height:1.6;
                                            color:#94a3b8;
                                        ">
                                            Tracking
                                        </div>

                                        <div style="
                                            margin-top:2px;
                                            font-size:10px;
                                            font-weight:600;
                                            color:#64748b;
                                        ">
                                            {{ $shipment->{'tracking-number'} ?? $shipment->id }}
                                        </div>

                                    </td>

                                </tr>
                            </table>


                            <div style="
                                height:1px;
                                background:#e2e8f0;
                                margin:18px 0;
                            ">
                            </div>


                            <div style="
                                font-size:10px;
                                line-height:1.6;
                                color:#94a3b8;
                            ">
                                This email was automatically generated by ShipTrack.
                                The attached report contains the complete shipment
                                monitoring and AI analysis results.
                            </div>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>

</html>
```
