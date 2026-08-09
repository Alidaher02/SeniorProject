<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipment Report #{{ $shipment->id }}</title>
    <style>
        /* Base Styles & Typography */
        @page {
            margin: 15mm 15mm 15mm 15mm;
            size: a4 portrait;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.4;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Helpers & Grid Containers */
        .w-full { width: 100%; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .text-uppercase { text-transform: uppercase; }
        .font-bold { font-weight: bold; }
        .text-muted { color: #64748b; }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header Section */
        .header-table {
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 15px;
        }
        .brand-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .brand-subtitle {
            font-size: 10px;
            color: #64748b;
            margin-top: 2px;
        }
        .report-badge {
            background-color: #f1f5f9;
            color: #334155;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
        }

        /* Status Pills */
        .status-pill {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            display: inline-block;
        }
        .status-delivered { background-color: #dcfce7; color: #166534; }
        .status-in-transit { background-color: #e0f2fe; color: #075985; }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-default { background-color: #f1f5f9; color: #475569; }

        /* Summary Cards Block */
        .cards-table {
            margin-bottom: 20px;
        }
        .card {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            vertical-align: top;
        }
        .card-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 6px;
        }
        .card-value {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
        }
        .card-subtext {
            font-size: 10px;
            color: #475569;
            margin-top: 3px;
        }

        /* Section Titles */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-left: 3px solid #2563eb;
            padding-left: 8px;
        }

        /* Data Tables */
        .data-table {
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }
        .data-table th {
            background-color: #f1f5f9;
            color: #475569;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #cbd5e1;
        }
        .data-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 10px;
        }
        .data-table tr:last-child td {
            border-bottom: none;
        }
        .data-table tr:nth-child(even) td {
            background-color: #fafafa;
        }

        /* Alert Badge Styling inside table */
        .alert-severity {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .severity-high, .severity-critical { background-color: #fee2e2; color: #991b1b; }
        .severity-medium { background-color: #fef3c7; color: #92400e; }
        .severity-low { background-color: #e0e7ff; color: #3730a3; }

        /* Footer */
        .footer {
            position: fixed;
            bottom: -10mm;
            left: 0;
            right: 0;
            height: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 5px;
            font-size: 8px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <!-- Footer Page Numbers (DomPDF Compatible) -->
    <script type="text/php">
        if (isset($pdf)) {
            $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
            $size = 8;
            $font = $fontMetrics->getFont("Helvetica");
            $width = $fontMetrics->getLineWidth($text, $font, $size);
            $x = $pdf->get_width() - $width - 42;
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size, array(0.58, 0.63, 0.72));
        }
    </script>

    <div class="footer">
        <table class="w-full">
            <tr>
                <td>Logistics & Cargo Management System • Confidential Report</td>
                <td class="text-right">Generated on {{ now()->format('Y-m-d H:i') }}</td>
            </tr>
        </table>
    </div>

    <!-- Header -->
    <table class="header-table w-full">
        <tr>
            <td style="vertical-align: middle;">
                <h1 class="brand-title">SHIPMENT REPORT</h1>
                <div class="brand-subtitle">Tracking & Logistics Manifest</div>
            </td>
            <td class="text-right" style="vertical-align: middle;">
                <div class="report-badge">
                    #{{ $shipment->tracking_number ?? $shipment->id }}
                </div>
                <div style="margin-top: 6px;">
                    @php
                        $statusClass = match(strtolower($shipment->status->value ?? '')) {
                            'delivered' => 'status-delivered',
                            'in transit', 'in_transit' => 'status-in-transit',
                            'pending' => 'status-pending',
                            default => 'status-default'
                        };
                    @endphp
                    <span class="status-pill {{ $statusClass }}">
                        {{ str_replace('_', ' ', $shipment->status->value ?? 'Unknown') }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <!-- Overview Cards Grid -->
    <table class="cards-table w-full" style="border-spacing: 6px; margin-left: -6px; margin-right: -6px;">
        <tr>
            <!-- Customer Info -->
            <td class="card" width="50%">
                <div class="card-label">Customer Details</div>
                <div class="card-value">{{ $shipment->customer->name ?? 'N/A' }}</div>
                <div class="card-subtext">{{ $shipment->customer->email ?? '' }}</div>
                <div class="card-subtext">{{ $shipment->customer->phone ?? '' }}</div>
            </td>

            <!-- Driver & Vehicle Info -->
            <td class="card" width="50%">
                <div class="card-label">Driver & Transport</div>
                <div class="card-value">{{ $shipment->driver->name ?? 'Unassigned' }}</div>
                <div class="card-subtext">Phone: {{ $shipment->driver->phone ?? 'N/A' }}</div>
                <div class="card-subtext">Vehicle: {{ $shipment->vehicle_plate ?? 'N/A' }}</div>
            </td>
        </tr>
    </table>

    <!-- Route & Dates Section -->
    <div class="section-title">Route & Timing Overview</div>
    <table class="data-table w-full">
        <thead>
            <tr>
                <th>Origin</th>
                <th>Destination</th>
                <th>Departure Date</th>
                <th>Est. Delivery</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $shipment->origin ?? 'N/A' }}</strong></td>
                <td><strong>{{ $shipment->destination ?? 'N/A' }}</strong></td>
                <td>{{ isset($shipment->departure_date) ? \Carbon\Carbon::parse($shipment->departure_date)->format('M d, Y H:i') : 'N/A' }}</td>
                <td>{{ isset($shipment->estimated_delivery) ? \Carbon\Carbon::parse($shipment->estimated_delivery)->format('M d, Y H:i') : 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Alerts Section (if any exist) -->
    @if($shipment->alerts && $shipment->alerts->count() > 0)
        <div class="section-title" style="border-left-color: #ef4444;">System Alerts & Incident Log</div>
        <table class="data-table w-full">
            <thead>
                <tr>
                    <th width="20%">Timestamp</th>
                    <th width="15%">Severity</th>
                    <th width="20%">Alert Type</th>
                    <th width="45%">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipment->alerts as $alert)
                    <tr>
                        <td>{{ isset($alert->created_at) ? \Carbon\Carbon::parse($alert->created_at)->format('Y-m-d H:i') : 'N/A' }}</td>
                        <td>
                            @php
                                $severity = strtolower($alert->severity ?? 'low');
                            @endphp
                            <span class="alert-severity severity-{{ $severity }}">
                                {{ $alert->severity ?? 'Info' }}
                            </span>
                        </td>
                        <td><strong>{{ $alert->type ?? 'General' }}</strong></td>
                        <td>{{ $alert->message ?? $alert->description ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Sensor Readings Section -->
    @if($shipment->sensorReadings && $shipment->sensorReadings->count() > 0)
        <div class="section-title">Telemetry & Sensor Logs</div>
        <table class="data-table w-full">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Temperature</th>
                    <th>Humidity</th>
                    <th>Status / Mode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipment->sensorReadings->take(10) as $reading)
                    <tr>
                        <td>{{ isset($reading->created_at) ? \Carbon\Carbon::parse($reading->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        <td>{{ isset($reading->temperature) ? $reading->temperature . ' °C' : 'N/A' }}</td>
                        <td>{{ isset($reading->humidity) ? $reading->humidity . ' %' : 'N/A' }}</td>
                        <td>{{ $reading->status ?? 'Normal' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($shipment->sensorReadings->count() > 10)
            <div style="font-size: 8px; color: #64748b; text-align: right; margin-top: -15px; margin-bottom: 15px;">
                * Showing 10 most recent sensor readings out of {{ $shipment->sensorReadings->count() }} total.
            </div>
        @endif
    @endif

    <!-- GPS Tracking History Section -->
    @if($shipment->gpsReadings && $shipment->gpsReadings->count() > 0)
        <div class="section-title">GPS Location Logs</div>
        <table class="data-table w-full">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Speed</th>
                    <th>Location / Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shipment->gpsReadings->take(8) as $gps)
                    <tr>
                        <td>{{ isset($gps->created_at) ? \Carbon\Carbon::parse($gps->created_at)->format('Y-m-d H:i:s') : 'N/A' }}</td>
                        <td>{{ $gps->latitude ?? 'N/A' }}</td>
                        <td>{{ $gps->longitude ?? 'N/A' }}</td>
                        <td>{{ isset($gps->speed) ? $gps->speed . ' km/h' : 'N/A' }}</td>
                        <td>{{ $gps->address ?? 'Coordinates Logged' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($shipment->gpsReadings->count() > 8)
            <div style="font-size: 8px; color: #64748b; text-align: right; margin-top: -15px;">
                * Showing 8 most recent GPS coordinates out of {{ $shipment->gpsReadings->count() }} total.
            </div>
        @endif
    @endif

</body>
</html>