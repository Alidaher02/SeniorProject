```html
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ShipTrack — Shipment Analysis</title>

    <style>
        @page {
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f8fafc;
            color: #0f172a;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .page {
            padding: 38px 45px;
        }

        /* =========================
           HEADER
        ========================= */

        .topbar {
            background: #0f172a;
            padding: 24px 26px;
            border-radius: 12px;
            color: white;
        }

        .topbar-table {
            width: 100%;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: -0.3px;
        }

        .brand-sub {
            margin-top: 5px;
            font-size: 8px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right {
            text-align: right;
        }

        .header-label {
            font-size: 7px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .tracking {
            margin-top: 5px;
            font-size: 11px;
            font-weight: bold;
            color: white;
        }

        .status {
            display: inline-block;
            margin-top: 8px;
            padding: 4px 9px;
            border-radius: 20px;
            background: #14532d;
            color: #bbf7d0;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        /* =========================
           INTRO
        ========================= */

        .intro {
            margin-top: 28px;
        }

        .eyebrow {
            font-size: 8px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.3px;
            font-weight: bold;
        }

        .title {
            margin-top: 5px;
            font-size: 23px;
            font-weight: bold;
            letter-spacing: -0.5px;
        }

        .intro-text {
            margin-top: 7px;
            color: #64748b;
            line-height: 1.6;
        }

        /* =========================
           RISK CARD
        ========================= */

        .risk-card {
            margin-top: 22px;
            padding: 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        .risk-table {
            width: 100%;
        }

        .risk-score {
            font-size: 43px;
            line-height: 1;
            font-weight: bold;
            color: #0f172a;
        }

        .risk-percent {
            font-size: 18px;
        }

        .risk-level {
            margin-top: 7px;
            font-size: 8px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .risk-description {
            padding-left: 35px;
            color: #64748b;
            line-height: 1.7;
        }

        .risk-bar {
            margin-top: 18px;
            width: 100%;
            height: 5px;
            background: #e2e8f0;
            border-radius: 5px;
        }

        .risk-fill {
            height: 5px;
            width: {{ min($analysis->risk_percentage ?? 0, 100) }}%;
            background: #0f172a;
            border-radius: 5px;
        }

        /* =========================
           SECTION
        ========================= */

        .section {
            margin-top: 25px;
        }

        .section-heading {
            margin-bottom: 10px;
        }

        .section-number {
            font-size: 8px;
            color: #94a3b8;
            font-weight: bold;
        }

        .section-title {
            margin-top: 3px;
            font-size: 13px;
            font-weight: bold;
        }

        /* =========================
           METRICS
        ========================= */

        .metrics {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px 0;
            margin-left: -8px;
        }

        .metric {
            padding: 17px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .metric-value {
            font-size: 22px;
            font-weight: bold;
        }

        .metric-label {
            margin-top: 5px;
            font-size: 7px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .critical {
            color: #dc2626;
        }

        .warning {
            color: #d97706;
        }

        /* =========================
           AI SUMMARY
        ========================= */

        .summary-card {
            padding: 19px 21px;
            background: #f1f5f9;
            border-radius: 10px;
            color: #475569;
            line-height: 1.75;
        }

        /* =========================
           SHIPMENT OVERVIEW
        ========================= */

        .overview {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 19px 21px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-cell {
            width: 50%;
            padding: 11px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .right {
            padding-left: 35px;
        }

        .info-label {
            font-size: 7px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .info-value {
            margin-top: 5px;
            font-size: 10px;
            font-weight: bold;
            color: #0f172a;
        }

        /* =========================
           ROUTE
        ========================= */

        .route {
            margin-top: 17px;
            padding: 17px 20px;
            background: #0f172a;
            border-radius: 10px;
            color: white;
        }

        .route-table {
            width: 100%;
        }

        .route-label {
            font-size: 7px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .route-place {
            margin-top: 5px;
            font-size: 10px;
            font-weight: bold;
        }

        .route-arrow {
            text-align: center;
            font-size: 17px;
            color: #64748b;
        }

        /* =========================
           ISSUES
        ========================= */

        .issue {
            margin-bottom: 9px;
            padding: 15px 17px;
            background: white;
            border: 1px solid #fecaca;
            border-left: 4px solid #dc2626;
            border-radius: 8px;
        }

        .issue-label {
            font-size: 7px;
            font-weight: bold;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .issue-text {
            margin-top: 6px;
            color: #475569;
            line-height: 1.6;
        }

        /* =========================
           WARNINGS
        ========================= */

        .warning-box {
            margin-bottom: 9px;
            padding: 15px 17px;
            background: white;
            border: 1px solid #fde68a;
            border-left: 4px solid #d97706;
            border-radius: 8px;
        }

        .warning-label {
            font-size: 7px;
            font-weight: bold;
            color: #d97706;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .warning-text {
            margin-top: 6px;
            color: #475569;
            line-height: 1.6;
        }

        /* =========================
           RECOMMENDATIONS
        ========================= */

        .recommendation {
            margin-bottom: 8px;
            padding: 14px 16px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .recommendation-table {
            width: 100%;
        }

        .number {
            width: 25px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            border-radius: 50%;
            background: #0f172a;
            color: white;
            font-size: 8px;
            font-weight: bold;
        }

        .recommendation-text {
            padding-left: 11px;
            color: #475569;
            line-height: 1.6;
        }

        /* =========================
           GENERATED
        ========================= */

        .generated {
            margin-top: 27px;
            padding: 15px 0;
            border-top: 1px solid #e2e8f0;
        }

        .generated-table {
            width: 100%;
        }

        .generated-label {
            font-size: 7px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .generated-value {
            margin-top: 4px;
            font-size: 9px;
            color: #475569;
        }

        .generated-right {
            text-align: right;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            margin-top: 5px;
            padding-top: 13px;
            border-top: 1px solid #e2e8f0;
            color: #94a3b8;
            font-size: 7px;
            line-height: 1.6;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="page">

    <!-- HEADER -->

    <div class="topbar">

        <table class="topbar-table">
            <tr>

                <td>

                    <div class="brand">
                        ShipTrack
                    </div>

                    <div class="brand-sub">
                        Cold Chain Intelligence
                    </div>

                </td>

                <td class="header-right">

                    <div class="header-label">
                        Tracking Number
                    </div>

                    <div class="tracking">
                        {{ $shipment->{'tracking-number'} ?? $shipment->tracking_number ?? 'N/A' }}
                    </div>

                    <div class="status">
                        ● Delivered
                    </div>

                </td>

            </tr>
        </table>

    </div>


    <!-- INTRO -->

    <div class="intro">

        <div class="eyebrow">
            Shipment Intelligence Report
        </div>

        <div class="title">
            Shipment Analysis
        </div>

        <div class="intro-text">
            Automated assessment of environmental conditions,
            sensor events, alerts and shipment monitoring history.
        </div>

    </div>


    <!-- RISK -->

    <div class="risk-card">

        <table class="risk-table">

            <tr>

                <td style="width:35%;">

                    <div class="risk-score">
                        {{ $analysis->risk_percentage ?? 0 }}<span class="risk-percent">%</span>
                    </div>

                    <div class="risk-level">
                        {{ strtoupper($analysis->risk_level ?? 'Unknown') }} Risk
                    </div>

                </td>

                <td style="width:65%;">

                    <div class="risk-description">

                        Overall shipment risk calculated from the
                        complete monitoring history, including
                        temperature, humidity, sensor events,
                        alerts and available location data.

                    </div>

                </td>

            </tr>

        </table>

        <div class="risk-bar">
            <div class="risk-fill"></div>
        </div>

    </div>


    <!-- METRICS -->

    <div class="section">

        <div class="section-heading">

            <div class="section-number">
                01
            </div>

            <div class="section-title">
                Analysis Overview
            </div>

        </div>

        <table class="metrics">

            <tr>

                <td style="width:33.33%;">

                    <div class="metric">

                        <div class="metric-value">
                            {{ $analysis->risk_percentage ?? 0 }}%
                        </div>

                        <div class="metric-label">
                            Risk Score
                        </div>

                    </div>

                </td>

                <td style="width:33.33%;">

                    <div class="metric">

                        <div class="metric-value critical">
                            {{ $analysis->critical_count ?? 0 }}
                        </div>

                        <div class="metric-label">
                            Critical Issues
                        </div>

                    </div>

                </td>

                <td style="width:33.33%;">

                    <div class="metric">

                        <div class="metric-value warning">
                            {{ $analysis->warning_count ?? 0 }}
                        </div>

                        <div class="metric-label">
                            Warnings
                        </div>

                    </div>

                </td>

            </tr>

        </table>

    </div>


    <!-- AI SUMMARY -->

    <div class="section">

        <div class="section-heading">

            <div class="section-number">
                02
            </div>

            <div class="section-title">
                AI Assessment
            </div>

        </div>

        <div class="summary-card">

            {{ $analysis->summary ?? 'No analysis summary available.' }}

        </div>

    </div>


    <!-- SHIPMENT -->

    <div class="section">

        <div class="section-heading">

            <div class="section-number">
                03
            </div>

            <div class="section-title">
                Shipment Overview
            </div>

        </div>

        <div class="overview">

            <table class="info-table">

                <tr>

                    <td class="info-cell">

                        <div class="info-label">
                            Shipment ID
                        </div>

                        <div class="info-value">
                            #{{ $shipment->id }}
                        </div>

                    </td>

                    <td class="info-cell right">

                        <div class="info-label">
                            Product
                        </div>

                        <div class="info-value">
                            {{ $shipment->product_name ?? 'N/A' }}
                        </div>

                    </td>

                </tr>

                <tr>

                    <td class="info-cell">

                        <div class="info-label">
                            Status
                        </div>

                        <div class="info-value">
                            Delivered
                        </div>

                    </td>

                    <td class="info-cell right">

                        <div class="info-label">
                            Tracking Number
                        </div>

                        <div class="info-value">
                            {{ $shipment->tracking_number ?? $shipment->{'tracking-number'} ?? 'N/A' }}
                        </div>

                    </td>

                </tr>

            </table>

            <div class="route">

                <table class="route-table">

                    <tr>

                        <td style="width:42%;">

                            <div class="route-label">
                                Origin
                            </div>

                            <div class="route-place">
                                {{ $shipment->origin ?? 'N/A' }}
                            </div>

                        </td>

                        <td style="width:16%;" class="route-arrow">
                            →
                        </td>

                        <td style="width:42%;">

                            <div class="route-label">
                                Destination
                            </div>

                            <div class="route-place">
                                {{ $shipment->destination ?? 'N/A' }}
                            </div>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>


    <!-- CRITICAL ISSUES -->

    @if(!empty($analysis->critical))

        <div class="section">

            <div class="section-heading">

                <div class="section-number">
                    04
                </div>

                <div class="section-title">
                    Critical Issues
                </div>

            </div>

            @foreach($analysis->critical as $critical)

                <div class="issue">

                    <div class="issue-label">
                        Critical Issue
                    </div>

                    <div class="issue-text">
                        {{ $critical['issue'] ?? $critical['message'] ?? $critical['description'] ?? $critical }}
                    </div>

                </div>

            @endforeach

        </div>

    @endif


    <!-- WARNINGS -->

    @if(!empty($analysis->warnings))

        <div class="section">

            <div class="section-heading">

                <div class="section-number">
                    05
                </div>

                <div class="section-title">
                    Warnings
                </div>

            </div>

            @foreach($analysis->warnings as $warning)

                <div class="warning-box">

                    <div class="warning-label">
                        Warning
                    </div>

                    <div class="warning-text">
                        {{ $warning['issue'] ?? $warning['message'] ?? $warning['description'] ?? $warning }}
                    </div>

                </div>

            @endforeach

        </div>

    @endif


    <!-- RECOMMENDATIONS -->

    @if(!empty($analysis->recommendations))

        <div class="section">

            <div class="section-heading">

                <div class="section-number">
                    06
                </div>

                <div class="section-title">
                    Recommendations
                </div>

            </div>

            @foreach($analysis->recommendations as $index => $recommendation)

                <div class="recommendation">

                    <table class="recommendation-table">

                        <tr>

                            <td style="width:25px; vertical-align:top;">

                                <div class="number">
                                    {{ $index + 1 }}
                                </div>

                            </td>

                            <td class="recommendation-text">

                                {{ $recommendation['text'] ?? $recommendation['message'] ?? $recommendation }}

                            </td>

                        </tr>

                    </table>

                </div>

            @endforeach

        </div>

    @endif


    <!-- GENERATED -->

    <div class="generated">

        <table class="generated-table">

            <tr>

                <td>

                    <div class="generated-label">
                        Analysis Generated
                    </div>

                    <div class="generated-value">

                        {{ $analysis->analyzed_at
                            ? $analysis->analyzed_at->format('d M Y, h:i A')
                            : 'N/A'
                        }}

                    </div>

                </td>

                <td class="generated-right">

                    <div class="generated-label">
                        Report Type
                    </div>

                    <div class="generated-value">
                        Cold Chain AI Analysis
                    </div>

                </td>

            </tr>

        </table>

    </div>


    <!-- FOOTER -->

    <div class="footer">

        ShipTrack Cold Chain Intelligence
        <br>

        Automated shipment monitoring and risk analysis ·
        {{ $shipment->tracking_number ?? $shipment->id }}

    </div>

</div>

</body>
</html>
```
