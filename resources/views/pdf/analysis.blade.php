<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShipTrack - Shipment Analysis</title>

    <style>
        @page {
            size: A4;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #ffffff;
            color: #1f2937;
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 18mm;
            position: relative;
        }

        .page-break {
            page-break-before: always;
        }

        table {
            border-collapse: collapse;
        }

        /* HEADER */

        .header {
            width: 100%;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
        }

        .brand span {
            color: #168a58;
        }

        .brand-sub {
            margin-top: 3px;
            color: #9ca3af;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header-right {
            text-align: right;
        }

        .report-title {
            font-size: 12px;
            font-weight: bold;
            color: #374151;
        }

        .report-meta {
            margin-top: 4px;
            color: #9ca3af;
            font-size: 8px;
        }

        /* HERO */

        .hero {
            margin-top: 20px;
            padding: 18px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
        }

        .hero-label,
        .label,
        .section-description,
        .metric-label,
        .route-label,
        .item-label,
        .footer-text {
            color: #9ca3af;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .hero-status {
            margin-top: 7px;
            font-size: 17px;
            font-weight: bold;
            color: #111827;
        }

        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 6px;
            border-radius: 50%;
            background: #168a58;
        }

        .hero-description {
            margin-top: 7px;
            color: #6b7280;
            font-size: 8.5px;
            line-height: 1.6;
        }

        .risk {
            text-align: right;
        }

        .risk-number {
            font-size: 23px;
            font-weight: bold;
            color: #111827;
        }

        .risk-level {
            margin-top: 2px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* SUMMARY */

        .summary {
            width: 100%;
            margin-top: 16px;
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
        }

        .summary td {
            width: 25%;
            padding: 11px 10px;
            vertical-align: top;
            border-right: 1px solid #e5e7eb;
        }

        .summary td:last-child {
            border-right: 0;
        }

        .value {
            margin-top: 4px;
            color: #111827;
            font-size: 9px;
            font-weight: bold;
            line-height: 1.4;
        }

        /* SECTIONS */

        .section {
            margin-top: 22px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            color: #111827;
        }

        .section-description {
            margin-top: 3px;
            text-transform: none;
            letter-spacing: 0;
        }

        .section-rule {
            margin-top: 7px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* METRICS */

        .metrics {
            width: 100%;
            margin-top: 13px;
        }

        .metric {
            width: 25%;
            padding-right: 12px;
            vertical-align: top;
        }

        .metric-value {
            margin-top: 5px;
            font-size: 15px;
            font-weight: bold;
            color: #111827;
        }

        /* AI */

        .ai-box {
            margin-top: 12px;
            padding: 13px 15px;
            background: #f5faf7;
            border-left: 3px solid #168a58;
        }

        .ai-label {
            color: #168a58;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .ai-text {
            margin-top: 7px;
            color: #4b5563;
            font-size: 8.5px;
            line-height: 1.7;
        }

        /* ROUTE */

        .route {
            width: 100%;
            margin-top: 13px;
        }

        .route td {
            vertical-align: middle;
        }

        .route-side {
            width: 45%;
        }

        .route-arrow {
            width: 10%;
            text-align: center;
            color: #9ca3af;
            font-size: 16px;
        }

        .route-place {
            margin-top: 4px;
            color: #111827;
            font-size: 10px;
            font-weight: bold;
        }

        /* ISSUES */

        .item {
            margin-top: 9px;
            padding: 9px 11px;
            border-left: 2px solid #dc2626;
            background: #fffafa;
        }

        .item.warning {
            border-left-color: #d97706;
            background: #fffbf5;
        }

        .item-label {
            color: #dc2626;
            font-weight: bold;
        }

        .item.warning .item-label {
            color: #d97706;
        }

        .item-text {
            margin-top: 4px;
            color: #4b5563;
            font-size: 8.5px;
            line-height: 1.6;
        }

        .clear {
            margin-top: 10px;
            color: #168a58;
            font-size: 8.5px;
            font-weight: bold;
        }

        /* RECOMMENDATIONS */

        .recommendation {
            width: 100%;
            margin-top: 8px;
        }

        .recommendation-number {
            width: 20px;
            color: #168a58;
            font-size: 9px;
            font-weight: bold;
            vertical-align: top;
        }

        .recommendation-text {
            color: #4b5563;
            font-size: 8.5px;
            line-height: 1.6;
            vertical-align: top;
        }

        /* FOOTER */

        .footer {
            position: absolute;
            left: 18mm;
            right: 18mm;
            bottom: 10mm;
            padding-top: 7px;
            border-top: 1px solid #e5e7eb;
        }

        .footer-brand {
            color: #111827;
            font-size: 8px;
            font-weight: bold;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>

<body>

@php
    /*
     * Load the actual sensor relationship here.
     * This prevents the PDF from showing N/A just because the
     * Mailable did not eager-load sensorReadings.
     */
    $sensorReadings = $shipment->sensorReadings()->get();

    $trackingNumber = $shipment->{'tracking-number'} ?? $shipment->tracking_number ?? 'N/A';
    $shipmentId = $shipment->id ?? 'N/A';
    $product = $shipment->product_name ?? $shipment->product ?? 'N/A';
    $status = $shipment->status ?? 'Delivered';
    $origin = $shipment->origin ?? 'N/A';
    $destination = $shipment->destination ?? 'N/A';

    $riskPercentage = $analysis->risk_percentage ?? 0;
    $riskLevel = $analysis->risk_level ?? 'Unknown';
    $summary = $analysis->summary ?? 'No AI assessment was generated.';

    $criticalIssues = $analysis->critical ?? [];
    $warnings = $analysis->warnings ?? [];
    $recommendations = $analysis->recommendations ?? [];

    if (is_string($criticalIssues)) {
        $criticalIssues = [$criticalIssues];
    }

    if (is_string($warnings)) {
        $warnings = [$warnings];
    }

    if (is_string($recommendations)) {
        $recommendations = [$recommendations];
    }

    /*
     * These are calculated from the real sensor readings.
     * There are no average_temperature / average_humidity
     * columns needed in the shipments table.
     */
    $temperatureAverage = $sensorReadings->isNotEmpty()
        ? number_format((float) $sensorReadings->avg('temperature'), 2) . '°C'
        : 'N/A';

    $humidityAverage = $sensorReadings->isNotEmpty()
        ? number_format((float) $sensorReadings->avg('humidity'), 2) . '%'
        : 'N/A';

    /*
     * Distance and stops are not stored fields in the report data
     * currently available here, so do not pretend they exist.
     * We show the real sensor-reading count instead.
     */
    $readingCount = $sensorReadings->count();

    $riskLevelLower = strtolower($riskLevel);

    $riskColor = match (true) {
        $riskLevelLower === 'high' => '#dc2626',
        $riskLevelLower === 'medium' => '#d97706',
        default => '#168a58',
    };

    $generatedAt = now()->format('d M Y, h:i A');
@endphp

<!-- PAGE 1 -->

<div class="page">

    <table class="header">
        <tr>
            <td width="50%" valign="top">
                <div class="brand">Ship<span>Track</span>.</div>
                <div class="brand-sub">Cold Chain Intelligence</div>
            </td>

            <td width="50%" class="header-right" valign="top">
                <div class="report-title">Shipment Analysis Report</div>
                <div class="report-meta">Generated {{ $generatedAt }}</div>
            </td>
        </tr>
    </table>

    <table width="100%" class="hero">
        <tr>
            <td width="65%" valign="top">
                <div class="hero-label">Shipment Status</div>

                <div class="hero-status">
                    <span class="status-dot"></span>{{ ucfirst($status) }}
                </div>

                <div class="hero-description">
                    Shipment monitoring report based on the recorded sensor data
                    and automated AI analysis.
                </div>
            </td>

            <td width="35%" class="risk" valign="top">
                <div class="hero-label">Risk Score</div>
                <div class="risk-number">{{ $riskPercentage }}%</div>
                <div class="risk-level" style="color: {{ $riskColor }};">
                    {{ strtoupper($riskLevel) }} RISK
                </div>
            </td>
        </tr>
    </table>

    <table class="summary">
        <tr>
            <td>
                <div class="label">Tracking Number</div>
                <div class="value">{{ $trackingNumber }}</div>
            </td>

            <td>
                <div class="label">Shipment ID</div>
                <div class="value">#{{ $shipmentId }}</div>
            </td>

            <td>
                <div class="label">Product</div>
                <div class="value">{{ $product }}</div>
            </td>

            <td>
                <div class="label">Status</div>
                <div class="value">{{ ucfirst($status) }}</div>
            </td>
        </tr>
    </table>

    <!-- MONITORING -->

    <div class="section">
        <div class="section-title">Monitoring Overview</div>
        <div class="section-description">
            Average environmental readings recorded during transit.
        </div>
        <div class="section-rule"></div>
    </div>

    <table class="metrics">
        <tr>
            <td class="metric">
                <div class="metric-label">Avg. Temperature</div>
                <div class="metric-value">{{ $temperatureAverage }}</div>
            </td>

            <td class="metric">
                <div class="metric-label">Avg. Humidity</div>
                <div class="metric-value">{{ $humidityAverage }}</div>
            </td>

            <td class="metric">
                <div class="metric-label">Sensor Readings</div>
                <div class="metric-value">{{ $readingCount }}</div>
            </td>

            <td class="metric">
                <div class="metric-label">Monitoring</div>
                <div class="metric-value">Complete</div>
            </td>
        </tr>
    </table>

    <!-- AI -->

    <div class="section">
        <div class="section-title">AI Assessment</div>
        <div class="section-description">
            Automated interpretation of the shipment monitoring data.
        </div>
        <div class="section-rule"></div>
    </div>

    <div class="ai-box">
        <div class="ai-label">ShipTrack Intelligence</div>

        <div class="ai-text">
            {{ $summary }}
        </div>
    </div>

    <!-- ROUTE -->

    <div class="section">
        <div class="section-title">Route</div>
        <div class="section-description">Shipment origin and destination.</div>
        <div class="section-rule"></div>
    </div>

    <table class="route">
        <tr>
            <td class="route-side">
                <div class="route-label">Origin</div>
                <div class="route-place">{{ $origin }}</div>
            </td>

            <td class="route-arrow">→</td>

            <td class="route-side">
                <div class="route-label">Destination</div>
                <div class="route-place">{{ $destination }}</div>
            </td>
        </tr>
    </table>

    <div class="footer">
        <table width="100%">
            <tr>
                <td width="50%">
                    <div class="footer-brand">ShipTrack.</div>
                    <div class="footer-text">
                        Cold Chain Intelligence · Smarter Shipping · Safer Delivery
                    </div>
                </td>

                <td width="50%" class="footer-right">
                    <div class="footer-text">
                        Shipment #{{ $shipmentId }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

</div>

<!-- PAGE 2 -->

<div class="page page-break">

    <table class="header">
        <tr>
            <td width="50%" valign="top">
                <div class="brand">Ship<span>Track</span>.</div>
                <div class="brand-sub">Cold Chain Intelligence</div>
            </td>

            <td width="50%" class="header-right" valign="top">
                <div class="report-title">Detailed Findings</div>
                <div class="report-meta">Shipment #{{ $shipmentId }}</div>
            </td>
        </tr>
    </table>

    <!-- CRITICAL ISSUES -->

    <div class="section" style="margin-top:20px;">
        <div class="section-title">Critical Issues</div>
        <div class="section-description">
            Conditions requiring attention based on the monitoring analysis.
        </div>
        <div class="section-rule"></div>
    </div>

    @if(count($criticalIssues) > 0)

        @foreach($criticalIssues as $issue)

            <div class="item">
                <div class="item-label">Critical Issue</div>

                <div class="item-text">
                    @if(is_array($issue))
                        {{ $issue['issue'] ?? $issue['message'] ?? $issue['description'] ?? $issue['text'] ?? json_encode($issue) }}
                    @else
                        {{ $issue }}
                    @endif
                </div>
            </div>

        @endforeach

    @else

        <div class="clear">
            No critical issues were reported by the analysis.
        </div>

    @endif

    <!-- WARNINGS -->

    <div class="section">
        <div class="section-title">Warnings</div>
        <div class="section-description">
            Events that may require additional inspection or review.
        </div>
        <div class="section-rule"></div>
    </div>

    @if(count($warnings) > 0)

        @foreach($warnings as $warning)

            <div class="item warning">
                <div class="item-label">Warning</div>

                <div class="item-text">
                    @if(is_array($warning))
                        {{ $warning['issue'] ?? $warning['message'] ?? $warning['description'] ?? $warning['text'] ?? json_encode($warning) }}
                    @else
                        {{ $warning }}
                    @endif
                </div>
            </div>

        @endforeach

    @else

        <div class="clear">
            No additional warnings were reported.
        </div>

    @endif

    <!-- RECOMMENDATIONS -->

    <div class="section">
        <div class="section-title">Recommendations</div>
        <div class="section-description">
            Suggested actions based on the shipment analysis.
        </div>
        <div class="section-rule"></div>
    </div>

    @if(count($recommendations) > 0)

        @foreach($recommendations as $index => $recommendation)

            <table class="recommendation">
                <tr>
                    <td class="recommendation-number">
                        {{ $index + 1 }}.
                    </td>

                    <td class="recommendation-text">
                        @if(is_array($recommendation))
                            {{ $recommendation['text'] ?? $recommendation['message'] ?? $recommendation['description'] ?? $recommendation['issue'] ?? json_encode($recommendation) }}
                        @else
                            {{ $recommendation }}
                        @endif
                    </td>
                </tr>
            </table>

        @endforeach

    @else

        <div class="clear">
            No additional recommendations were generated.
        </div>

    @endif

    <!-- FINAL STATUS -->

    <div class="section" style="margin-top:30px;">
        <div class="section-title">Final Report Status</div>
        <div class="section-rule"></div>
    </div>

    <div style="margin-top:12px;">
        <div style="font-size:12px; font-weight:bold; color:#168a58;">
            {{ ucfirst($status) }} · Analysis completed
        </div>

        <div style="margin-top:6px; color:#6b7280; font-size:8.5px; line-height:1.6;">
            This report combines the available shipment monitoring information
            with automated AI analysis to highlight environmental risks,
            warnings and recommended actions.
        </div>
    </div>

    <div class="footer">
        <table width="100%">
            <tr>
                <td width="50%">
                    <div class="footer-brand">ShipTrack.</div>
                    <div class="footer-text">
                        Cold Chain Intelligence · Smarter Shipping · Safer Delivery
                    </div>
                </td>

                <td width="50%" class="footer-right">
                    <div class="footer-text">
                        Generated {{ $generatedAt }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>
