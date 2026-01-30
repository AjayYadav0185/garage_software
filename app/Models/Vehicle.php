<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends BaseModel
{
    protected $table = 'all_vehicle';
    protected $primaryKey = 'id';

    protected $fillable = [
        'g_id',
        'c_id',
        'v_id',
        'mechanic_id',

        'messageid',

        'number_plate',
        'number_plate_code',
        'number_plate_color',
        'plate_code',
        'uae_number_plate_color',

        'name',
        'contact',

        'driver_name',
        'driver_mobile_number',

        'registration',

        'carbrand',
        'carmodel',
        'fueltype',
        'transmission',
        'braking',
        'car_body_color',

        'chassis_no',
        'engine_no',

        'vehicle_emirate',
        'emirates',

        'manufacturing_year',
        'body_vechilce_year_date',
        'vechilce_year_date',

        'odo_meter_reading',
        'fuel_meter',

        // 🔧 Service reminder fields
        'last_service_date',
        'service_interval_days',
        'service_interval_km',
        'next_service_date',

        'status',
    ];

    protected $casts = [
        'last_service_date' => 'date',
        'next_service_date' => 'date',
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $timestamps = true;

    /* -------------------------
     |   RELATIONSHIPS
     --------------------------*/

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class, 'mechanic_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'c_id', 'c_id');
    }

    // Car Model relation via name
    public function model()
    {
        return $this->belongsTo(CarModel::class, 'carmodel', 'name');
    }

    // Car Maker relation via name
    public function maker()
    {
        return $this->belongsTo(CarMaker::class, 'carbrand', 'name');
    }
}
