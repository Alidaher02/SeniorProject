<?php

namespace App\Services;
use App\Models\Alert;
use App\Models\SensorReading;
use App\Models\Shipment;
use App\Notifications\HumidityAlert;
use App\Notifications\LightAlert;
use App\Notifications\LowHumidityAlert;
use App\Notifications\LowTemperatureAlert;
use App\Notifications\TiltAlert;
use App\Notifications\ShipmentTemperatureAlert;

class ShipmentMonitoringService
{
    /**
     * Create a new class instance.
     */
    public function analyze(SensorReading $reading)
    {
        $this->checkHighTemperature($reading);

        $this->checkLowTemperature($reading);

        $this->checkHighHumidity($reading);

        $this->checkLowHumidity($reading);

        $this->checkTilt($reading);

        $this->checkLight($reading);

    }

  private function checkHighTemperature($reading)
{
    if(!$reading->shipment)
    {
        return;
    }

    if($reading->temperature > $reading->shipment->max_temperature)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment->id,
                'type' => 'temperature_high',
                'status' => 'active'
            ],
            [
                'message' => 'Temperature Exceeded limits',
                'severity' => 'high',
                'sensor_reading_id' => $reading->id
            ]
        );
        
        $reading->shipment->customer->notify(
            new ShipmentTemperatureAlert(
                $reading->shipment,
                $reading->temperature

            )
        );
    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'temperature_high')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}
    private function checkLowTemperature($reading)
{
    if(!$reading->shipment)
    {
        return;
    }


    if($reading->temperature < $reading->shipment->min_temperature)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment_id,
                'type' => 'temperature_low',
                'status' => 'active'
            ],
            [
                'severity' => 'high',
                'message' => 'Temperature Low',
                'sensor_reading_id' => $reading->id
            ]
        );

        $reading->shipment->customer->notify(
            new LowTemperatureAlert(
                $reading->shipment,
                $reading->temperature

            )
        );

    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'temperature_low')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}

private function checkHighHumidity($reading)
{
    if(!$reading->shipment)
    {
        return;
    }

    if($reading->humidity > $reading->shipment->max_humidity)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment_id,
                'type' => 'humidity_high',
                'status' => 'active'
            ],
            [
                'severity' => 'high',
                'message' => 'Humidity exceeded limit',
                'sensor_reading_id' => $reading->id
            ]
        );

        $reading->shipment->customer->notify(
            new HumidityAlert(
                $reading->shipment,
                $reading->humidity

            )
        );        
    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'humidity_high')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}
private function checkLowHumidity($reading)
{
    if(!$reading->shipment)
    {
        return;
    }

    if($reading->humidity < $reading->shipment->min_humidity)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment_id,
                'type' => 'humidity_low',
                'status' => 'active'
            ],
            [
                'severity' => 'high',
                'message' => 'Humidity Low',
                'sensor_reading_id' => $reading->id
            ]
        );

        $reading->shipment->customer->notify(
            new LowHumidityAlert(
                $reading->shipment,
                $reading->humidity

            )
        );
    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'humidity_low')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}

private function checkTilt($reading)
{
    if(!$reading->shipment)
    {
        return;
    }

    if($reading->tilt == 1)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment_id,
                'type' => 'tilt',
                'status' => 'active'
            ],
            [
                'severity' => 'high',
                'message' => 'Shipment movement detected',
                'sensor_reading_id' => $reading->id
            ]
        );

        $reading->shipment->customer->notify(
            new TiltAlert(
                $reading->shipment,
                $reading->tilt

            )
        );     
    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'tilt')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}

private function checkLight($reading)
{
    if(!$reading->shipment)
    {
        return;
    }

    if($reading->light < 500)
    {
        Alert::updateOrCreate(
            [
                'shipment_id' => $reading->shipment_id,
                'type' => 'light',
                'status' => 'active'
            ],
            [
                'severity' => 'high',
                'message' => 'Light Detected',
                'sensor_reading_id' => $reading->id
            ]
        );
    
            $reading->shipment->customer->notify(
            new LightAlert(
                $reading->shipment,
                $reading->light

            )
        );
    }
    else
    {
        $reading->shipment->alerts()
            ->where('type', 'light')
            ->where('status', 'active')
            ->update([
                'status' => 'resolved'
            ]);
    }
}
}
