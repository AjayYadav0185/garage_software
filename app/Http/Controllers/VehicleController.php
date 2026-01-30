<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\Mechanic;
use DataTables;

class VehicleController extends Controller
{
    // Show Blade view
    public function index()
    {
        return view('vehicles.index');
    }

    // AJAX DataTable
    public function ajax(Request $request)
    {
        $data = Vehicle::with(['customer', 'mechanic'])
            ->select([
                'id',
                'c_id',
                'mechanic_id',
                'number_plate',
                'carbrand',
                'carmodel',
                'fueltype',
                'transmission',
                'next_service_date'
            ])
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('customer_name', function ($row) {
                return $row->customer ? $row->customer->cus_name : 'N/A';
            })

            ->addColumn('mechanic_name', function ($row) {
                return $row->mechanic ? $row->mechanic->m_name : 'N/A';
            })

            // ⭐ Service Reminder Badge
            ->addColumn('service_status', function ($row) {

                if (!$row->next_service_date) {
                    return '<span class="badge badge-secondary">No Reminder</span>';
                }

                $today = date('Y-m-d');

                if ($row->next_service_date < $today) {
                    return '<span class="badge badge-danger">Overdue</span>';
                }

                if ($row->next_service_date == $today) {
                    return '<span class="badge badge-warning">Due Today</span>';
                }

                if ($row->next_service_date <= date('Y-m-d', strtotime('+7 days'))) {
                    return '<span class="badge badge-info">Due Soon</span>';
                }

                return '<span class="badge badge-success">Upcoming</span>';
            })

            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary edit-vehicle" data-id="' . $row->id . '">Edit</button>
                    <button class="btn btn-sm btn-danger delete-vehicle" data-id="' . $row->id . '">Delete</button>
                ';
            })

            ->rawColumns(['actions', 'service_status'])
            ->make(true);
    }

    // Get Car Models by Maker
    public function getModelsByMaker($makerId)
    {
        $models = CarModel::where('maker_id', $makerId)->get(['id', 'name']);
        return response()->json($models);
    }


    public function store(Request $request)
    {
        $request->validate([
            'number_plate'  => 'required|string|max:255|unique:all_vehicle,number_plate,NULL,id,g_id,' . auth_id(),
            'carbrand'      => 'required',
            'carmodel'      => 'required|string|max:255',
            'fueltype'      => 'required',
            'transmission'  => 'required',
            'client_id'     => 'required',
        ]);

        $vehicle = new Vehicle();

        $vehicle->g_id         = auth_id();
        $vehicle->c_id         = $request->client_id;
        $vehicle->v_id         = (Vehicle::max('v_id') ?? 0) + 1;
        $vehicle->mechanic_id  = $request->mechanic_id;

        $vehicle->number_plate = strtoupper($request->number_plate);
        $vehicle->registration = strtoupper($request->number_plate);

        $vehicle->carbrand     = CarMaker::find($request->carbrand)->name ?? null;
        $vehicle->carmodel     = $request->carmodel;
        $vehicle->fueltype     = $request->fueltype;
        $vehicle->transmission = $request->transmission;
        $vehicle->braking      = $request->vehicle_braking;

        $vehicle->chassis_no   = $request->chassis_no;
        $vehicle->engine_no    = $request->engine_no;

        // ===============================
        // OPTIONAL EXTENDED FIELDS
        // ===============================
        $vehicle->vehicle_emirate      = $request->vehicle_emirate;
        $vehicle->emirates      = $request->vehicle_emirate;
        $vehicle->number_plate_code    = $request->vehicle_number_plate_code;
        $vehicle->plate_code            = $request->vehicle_number_plate_code;
        $vehicle->uae_number_plate_color    = $request->vehicle_number_plate_code;
        $vehicle->number_plate_color   = $request->vehicle_number_plate_color;
        $vehicle->car_body_color       = $request->vehicle_car_body_color;
        $vehicle->manufacturing_year   = $request->vehicle_manfacturing_year;
        $vehicle->odo_meter_reading    = $request->vehicle_odometer;
        $vehicle->fuel_meter           = $request->vehicle_fuelmeter;

        $vehicle->last_service_date     = $request->last_service_date;
        $vehicle->service_interval_days = $request->service_interval_days;
        $vehicle->service_interval_km   = $request->service_interval_km;

        $vehicle->next_service_date     = $request->next_service_date
            ?: (
                $request->last_service_date && $request->service_interval_days
                ? date(
                    'Y-m-d',
                    strtotime($request->last_service_date . ' + ' . $request->service_interval_days . ' days')
                )
                : null
            );

        $vehicle->save();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle saved successfully'
        ]);
    }

    // ===============================
    // EDIT VEHICLE
    // ===============================
    public function edit($id)
    {
        $vehicle = Vehicle::with(['maker', 'model', 'customer', 'mechanic'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Vehicle updated successfully',
            'id'        => $vehicle->id,
            'c_id'      => $vehicle->c_id,

            // CUSTOMER
            'customer_name'    => optional($vehicle->customer)->cus_name,
            'customer_contact' => optional($vehicle->customer)->cus_mob,
            'customer_email'   => optional($vehicle->customer)->cus_email,
            'customer_gst'     => optional($vehicle->customer)->c_gst,
            'customer_address' => optional($vehicle->customer)->c_add,

            // VEHICLE
            'number_plate'     => $vehicle->number_plate,
            'fueltype'         => $vehicle->fueltype,
            'transmission'     => $vehicle->transmission,
            'mechanic_id'      => $vehicle->mechanic_id,
            'chassis_no'       => $vehicle->chassis_no,
            'engine_no'        => $vehicle->engine_no,

            'carbrand'         => optional($vehicle->maker)->id,
            'carmodel'         => $vehicle->carmodel,

            // EXTENDED
            'vehicle_emirate'            => $vehicle->vehicle_emirate,
            'emirates'                   => $vehicle->vehicle_emirate,
            'vehicle_number_plate_code'  => $vehicle->number_plate_code,
            'plate_code'                 => $vehicle->number_plate_code,
            'uae_number_plate_color'     => $vehicle->number_plate_code,
            'vehicle_number_plate_color' => $vehicle->number_plate_color,
            'vehicle_car_body_color'     => $vehicle->car_body_color,
            'vehicle_manfacturing_year'  => $vehicle->manufacturing_year,
            'vehicle_odometer'           => $vehicle->odo_meter_reading,
            'vehicle_braking'            => $vehicle->braking,
            'vehicle_fuelmeter'          => $vehicle->fuel_meter,

            // SERVICE
            'last_service_date'     => $vehicle->last_service_date,
            'service_interval_days' => $vehicle->service_interval_days,
            'service_interval_km'   => $vehicle->service_interval_km,
            'next_service_date'     => $vehicle->next_service_date,
        ]);
    }

    // ===============================
    // UPDATE VEHICLE
    // ===============================
    public function update(Request $request, $id)
    {


        $request->validate([
            'number_plate' => 'required|string|max:255|unique:all_vehicle,number_plate,' . $id,
            'carbrand'     => 'required',
            'carmodel'     => 'required|string|max:255',
            'fueltype'     => 'required',
            'transmission' => 'required',
        ]);

        $vehicle = Vehicle::findOrFail($id);

        $vehicle->c_id = strtoupper($request->client_id);
        $vehicle->number_plate = strtoupper($request->number_plate);
        $vehicle->registration = strtoupper($request->number_plate);
        $vehicle->carbrand     = CarMaker::find($request->carbrand)->name ?? null;
        $vehicle->carmodel     = $request->carmodel;
        $vehicle->fueltype     = $request->fueltype;
        $vehicle->transmission = $request->transmission;
        $vehicle->mechanic_id  = $request->mechanic_id;
        $vehicle->braking      = $request->vehicle_braking;

        $vehicle->chassis_no   = $request->chassis_no;
        $vehicle->engine_no    = $request->engine_no;

        // EXTENDED
        $vehicle->vehicle_emirate    = $request->vehicle_emirate;
        $vehicle->number_plate_code  = $request->vehicle_number_plate_code;
        $vehicle->number_plate_color = $request->vehicle_number_plate_color;
        $vehicle->car_body_color     = $request->vehicle_car_body_color;
        $vehicle->manufacturing_year = $request->vehicle_manfacturing_year;
        $vehicle->odo_meter_reading  = $request->vehicle_odometer;
        $vehicle->fuel_meter         = $request->vehicle_fuelmeter;

        // SERVICE
        $vehicle->last_service_date     = $request->last_service_date;
        $vehicle->service_interval_days = $request->service_interval_days;
        $vehicle->service_interval_km   = $request->service_interval_km;

        $vehicle->next_service_date = $request->next_service_date
            ?: (
                $request->last_service_date && $request->service_interval_days
                ? date(
                    'Y-m-d',
                    strtotime($request->last_service_date . ' + ' . $request->service_interval_days . ' days')
                )
                : null
            );

        $vehicle->save();

        return response()->json([
            'success' => true,
            'message' => 'Vehicle updated successfully'
        ]);
    }


    // Delete
    public function destroy($id)
    {
        Vehicle::findOrFail($id)->delete();
        return response()->json(['success' => 'Vehicle deleted successfully.']);
    }

    public function search(Request $request)
    {

        return Vehicle::where('registration', 'LIKE', "%{$request->q}%")
            ->orWhere('chassis_no', 'LIKE', "%{$request->q}%")
            ->limit(10)
            ->get();
    }
}
