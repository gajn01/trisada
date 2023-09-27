<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\LtoVehicleRegistration;
use App\Models\VehicleMaintenance;

class AvailabilityHelper
{
    //get array of dates between two dates.
    static function getDatesBetween($startDate, $endDate)
    {
        $dates = array();
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate)->addDay(); // Include end date
        while ($start->lte($end)) {
            $dates[] = $start->toDateString();
            $start->addDay();
        }
        return $dates;
    }
    #region Vehicle check availability
    //get array of vehicle coding dates
    public static function getCodingDates($vehicleId, $startDate, $endDate)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $datesArray = AvailabilityHelper::getDatesBetween($startDate, $endDate);
        $codingDays = [];
        foreach ($datesArray as $date) {
            if (date('w', strtotime($date)) == $vehicle->coding_day) {
                $codingDays[] = $date;
            }
        }
        return $codingDays;
    }
    // get available vehicles.
    public static function getAvailableVehicles($startDate, $endDate)
    {
        return Vehicle::whereDoesntHave('reservations', function ($q) use ($startDate, $endDate) {
            // Check if with ticket
            return $q->where(function ($q) use ($startDate) {
                return $q->where('pickup_date', '<=', $startDate)
                    ->where('return_date', '>=', $startDate);
            })->orWhere(function ($q) use ($endDate) {
                return $q->where('pickup_date', '<=', $endDate)
                    ->where('return_date', '>=', $endDate);
            })
                ->where('status', 1);
        })->whereHas('lto_vehicle_registrations', function ($q) use ($startDate, $endDate) {
                // Check if registration not expired
                return $q->whereDate('validity_date', '>=', $startDate)
                ->whereDate('validity_date', '>=', $endDate);
            })->whereDoesntHave('vehicle_maintenances', function ($q) use ($startDate, $endDate) {
                // For maintenance
                return $q->whereDate('start_date', '<=', $startDate)
                    ->whereDate('start_date', '<=', $endDate)
                    ->whereNull('end_date');
            })->get();
    }
    // check if selected vehicle is available
    public static function vehicleAvailable($vehicleId, $startDate, $endDate)
    {
        return Vehicle::whereDoesntHave('reservations', function ($q) use ($startDate, $endDate) {
            // Check if with ticket
            return $q->where(function ($q) use ($startDate) {
                return $q->where('pickup_date', '<=', $startDate)
                    ->where('return_date', '>=', $startDate);
            })->orWhere(function ($q) use ($endDate) {
                return $q->where('pickup_date', '<=', $endDate)
                    ->where('return_date', '>=', $endDate);
            })
                ->where('status', 1);
        })
            ->whereHas('lto_vehicle_registrations', function ($q) use ($startDate, $endDate) {
                // Check if registration not expired
                return $q->whereDate('validity_date', '>=', $startDate)
                    ->whereDate('validity_date', '>=', $endDate);
            })
            ->whereDoesntHave('vehicle_maintenances', function ($q) use ($startDate, $endDate) {
                // For maintenance
                return $q->whereDate('start_date', '<=', $startDate)
                    ->whereDate('start_date', '<=', $endDate)
                    ->whereNull('end_date');
            })
            ->where('vehicleId', $vehicleId)
            ->exists();
    }
    public static function checkIfBooked($vehicleId, $date)
    {
        return Reservation::whereDate('pickup_date', '<=', $date)
            ->whereDate('return_date', '>=', $date)
            ->where('status', 1)
            ->where('vehicle_id', $vehicleId)
            ->exists();
    }
    public static function checkIfExpired($vehicleId, $date)
    {
        return LtoVehicleRegistration::whereDate('validity_date', '>=', $date)
            ->where('vehicle_id', $vehicleId)
            ->doesntExist();
    }
    public static function checkIfMaintenance($vehicleId, $date)
    {
        return VehicleMaintenance::whereDate('start_date', $date)
            ->whereNull('end_date')
            ->where('vehicle_id', $vehicleId)
            ->exists();
    }
    public static function checkIfCoding($vehicleId, $date)
    {
        return Vehicle::where('coding_day', date('w', strtotime($date)))
            ->where('id', $vehicleId)->exists();
    }
    public static function vehicleStatus($vehicleId, $date)
    {
        if (AvailabilityHelper::checkIfBooked($vehicleId, $date))
            return 'Booked';
        if (AvailabilityHelper::checkIfExpired($vehicleId, $date))
            return 'Expired';
        if (AvailabilityHelper::checkIfMaintenance($vehicleId, $date))
            return 'Maintenance';
        if (AvailabilityHelper::checkIfCoding($vehicleId, $date))
            return 'Coding';
        return 'Available';
    }
    public static function vehicleStatusHTML($vehicleId, $date)
    {
        switch (AvailabilityHelper::vehicleStatus($vehicleId, $date)) {
            case 'Booked':
                return '<span class="text-primary">Booked</span>';
                break;
            case 'Available':
                return '<span class="text-success">Available</span>';
                break;
            case 'Expired':
                return '<span class="text-danger">Reg. Expired</span>';
                break;
            case 'Coding':
                return '<span class="text-warning">Coding</span>';
                break;
            case 'Maintenance':
                return '<span class="text-secondary">Maintenance</span>';
                break;
        }
        return 'Undefined';
    }
    #endregion
    #region Driver Check Availability
    public static function getAvailableDrivers($startDate, $endDate)
    {
        return Driver::whereNull('department_id')
            ->whereDoesntHave('reservations', function ($q) use ($startDate, $endDate) {
                // Check if with ticket
                return $q->where(function ($q) use ($startDate) {
                    return $q->where('pickup_date', '<=', $startDate)
                        ->where('return_date', '>=', $startDate);
                })->orWhere(function ($q) use ($endDate) {
                    return $q->where('pickup_date', '<=', $endDate)
                        ->where('return_date', '>=', $endDate);
                })
                    ->where('status', 1);
            })->get();
    }
    // check if selected vehicle is available
    public static function driverAvailable($driverId, $startDate, $endDate)
    {
        return Driver::whereDoesntHave('reservations', function ($q) use ($startDate, $endDate) {
            // Check if with ticket
            return $q->where(function ($q) use ($startDate) {
                return $q->where('pickup_date', '<=', $startDate)
                    ->where('return_date', '>=', $startDate);
            })->orWhere(function ($q) use ($endDate) {
                return $q->where('pickup_date', '<=', $endDate)
                    ->where('return_date', '>=', $endDate);
            })->where('status', 1);
        })->where('driver_id', $driverId)
            ->exists();
    }
    public static function checkIfBookedDriver($driverId, $date)
    {
        return Reservation::whereDate('pickup_date', '<=', $date)
            ->whereDate('return_date', '>=', $date)
            ->where('status', 1)
            ->where('driver_id', $driverId)
            ->exists();
    }
    public static function driverStatus($driverId, $date)
    {
        if (AvailabilityHelper::checkIfBookedDriver($driverId, $date))
            return 'Unavailable';
        // if(AvailabilityHelper::checkIfMaintenance($driverId,$date)) return 'Absent';
        return 'Available';
    }
    public static function DriverStatusHTML($driverId, $date)
    {
        switch (AvailabilityHelper::driverStatus($driverId, $date)) {
            case 'Unavailable':
                return '<span class="text-primary">Unavailable</span>';
                break;
            case 'Available':
                return '<span class="text-success">Available</span>';
                break;
            case 'Absent':
                return '<span class="text-danger">Absent</span>';
                break;
        }
        return 'Undefined';
    }
    #endregion
}