<?php

namespace App\Http\Controllers;

use App\Models\JobCard as InsuranceRo;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\InsuranceCompany;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;

class InsuranceRoController extends Controller
{
    /**
     * INDEX PAGE
     */

    public function index()
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();
        $brands = CarMaker::all();
        $models = CarModel::all();
        $inventory = Inventory::all();
        $service = Service::all();
        $packages = ServicePackage::all();
        $jobcard_increment_no = '';
        return view('insurance-ro.index', compact('vehicles', 'customers', 'brands', 'models', 'inventory', 'service', 'packages', 'jobcard_increment_no'));
    }


    /**
     * DATATABLE AJAX
     */
    public function ajax(Request $request)
    {
        $query = InsuranceRo::query()
            ->where('job_card_type', 'accident')
            ->with(['vehicle', 'customer', 'insuranceCompany'])
            ->orderByDesc('id');

        return DataTables::of($query)

            ->addColumn('vehicle', function ($row) {
                return $row->vehicle?->vehicle_name ?? '-';
            })

            ->addColumn('insurance', function ($row) {
                return $row->insuranceCompany?->insurence_company_name ?? '-';
            })

            ->addColumn('reg_no', function ($row) {
                return $row->vehicle?->registration ?? '-';
            })

            ->addColumn('chassis', function ($row) {
                return $row->vehicle?->chassis_no ?? '-';
            })

            ->addColumn('total_amount', function ($row) {
                return number_format($row->totalPrice, 2);
            })

            // In your DataTable / controller
            ->addColumn('split_amount', function ($row) {

                // If split billing is enabled
                if ($row->split_billing) {

                    // Percentage based
                    if ($row->liability_percentage > 0) {
                        $insurancePercentAmount = number_format($row->totalPrice * $row->liability_percentage / 100, 2);
                        $customerPercentAmount  = number_format($row->totalPrice - $insurancePercentAmount, 2);

                        return "In.Amount ({$row->liability_percentage}%): {$insurancePercentAmount} <br> Customer: {$customerPercentAmount}";
                    }
                    // Fixed amount based
                    else {
                        $insuranceAmount = number_format($row->liability_amount, 2);
                        $customerAmount  = number_format($row->totalPrice - $row->liability_amount, 2);

                        return "In.(Amount): {$insuranceAmount} <br> Customer: {$customerAmount}";
                    }
                } else {

                    $active = $row->split_billing == 1;

                    return '
                <button
                    class="btn btn-sm toggle-status ' . ($active ? 'btn-success' : 'btn-secondary') . '"
                    data-id="' . $row->id . '"
                    data-inc_id="' . $row->insurance_company_id . '"
                    data-vehicle_id="' . $row->v_id . '"
                    data-max_val="' . $row->totalPrice . '"
                    ' . ($active ? 'disabled' : '') . '>
                    ' . ($active ? 'Split Done' : 'Split Bill') . '
                </button>
            ';
                }
            })


            // ✅ BILL SPLIT BUTTON
            ->addColumn('bill_split', function ($row) {

                $active = $row->split_billing == 1;

                return '
                <button
                    class="btn btn-sm toggle-status ' . ($active ? 'btn-success' : 'btn-secondary') . '"
                    data-id="' . $row->id . '"
                    data-inc_id="' . $row->insurance_company_id . '"
                    data-vehicle_id="' . $row->v_id . '"
                    data-max_val="' . $row->totalPrice . '"
                    ' . ($active ? 'disabled' : '') . '>
                    ' . ($active ? 'Split Done' : 'Split Bill') . '
                </button>
            ';
            })

            // ✅ SEND APPROVAL (placeholder)
            ->addColumn('send_approval', function ($row) {
                return '<span class="badge bg-info">Pending</span>';
            })
            ->addColumn('status', function ($row) {

                $html = '<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">';

                // Paid / Due badge
                if ($row->status === 'P') {
                    $html .= '<span class="badge bg-danger text-dark" style="padding:8px 12px;">Due</span>';
                } else {
                    $html .= '<span class="badge bg-success" style="padding:8px 12px;">Paid</span>';
                }


                $html .= '</div>';

                return $html;
            })

            // ✅ SEND APPROVAL (placeholder)
            ->addColumn('send_approval', function ($row) {
                return '<span class="badge bg-info">Pending</span>';
            })
            ->addColumn('payment_mark', function ($row) {

                $html = '<div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">';

                // Only after work completed
                if ($row->work_status == 4) {

                    // 🔥 SINGLE DB CHECKS (important)
                    $customerPaid = PaymentHistory::where('jobcard_id', $row->id)
                        ->where('mark_in', 'customer')
                        ->exists();

                    $insurancePaid = PaymentHistory::where('jobcard_id', $row->id)
                        ->where('mark_in', 'insurance')
                        ->exists();

                    // ================= SPLIT BILLING =================
                    if ($row->split_billing == 1) {

                        // CUSTOMER PAYMENT
                        if (!$customerPaid) {
                            $html .= '
                <select class="form-select form-select-sm mark-payment"
                    style="width:180px;border-radius:8px;"
                    data-id="' . $row->id . '"
                    data-incid="' . $row->insurance_company_id . '"
                    data-type="customer">
                    <option value="">💳 Customer Payment</option>
                    <option value="cash">💵 Cash Paid</option>
                    <option value="card">💳 Card Paid</option>
                    <option value="bank transfer">🏦 Bank Transfer</option>
                </select>';
                        }

                        // INSURANCE PAYMENT
                        if (!$insurancePaid) {
                            $html .= '
                <select class="form-select form-select-sm mark-payment"
                    style="width:180px;border-radius:8px;"
                    data-id="' . $row->id . '"
                    data-incid="' . $row->insurance_company_id . '"
                    data-type="insurance">
                    <option value="">💳 Insurance Payment</option>
                    <option value="cash">💵 Cash Paid</option>
                    <option value="card">💳 Card Paid</option>
                    <option value="bank transfer">🏦 Bank Transfer</option>
                </select>';
                        }
                    }
                    // ================= NON-SPLIT BILLING =================
                    else {

                        if (!$insurancePaid) {
                            $html .= '
                <select class="form-select form-select-sm mark-payment"
                    style="width:180px;border-radius:8px;"
                    data-id="' . $row->id . '"
                    data-incid="' . $row->insurance_company_id . '"
                    data-type="insurance">
                    <option value="">💳 Insurance Payment</option>
                    <option value="cash">💵 Cash Paid</option>
                    <option value="card">💳 Card Paid</option>
                    <option value="bank transfer">🏦 Bank Transfer</option>
                </select>';
                        }
                    }

                    // ================= ALL PAID =================
                    if (
                        ($row->split_billing == 1 && $customerPaid && $insurancePaid) ||
                        ($row->split_billing != 1 && $insurancePaid)
                    ) {
                        $html .= '<span class="badge bg-success" style="padding:8px 12px;">Action Taken</span>';
                        $html .= '<a href="/payment-history" class="btn btn-sm btn-outline-success">History</a>';
                    }
                }

                $html .= '</div>';

                return $html;
            })





            // ✅ PAYMENT MARK
            // ->addColumn('payment_mark', function ($row) {
            //     return $row->payment_status == 1
            //         ? '<span class="badge bg-success">Paid</span>'
            //         : '<span class="badge bg-warning">Unpaid</span>';
            // })

            // ✅ STATUS
            // ->addColumn('status', function ($row) {
            //     return $row->work_status != 0
            //         ? '<span class="badge bg-secondary">Pending</span>'
            //         : '<span class="badge bg-success">Completed</span>';
            // })


            ->addColumn('actions', function ($row) {

                // Dynamically generate the WhatsApp link for each row
                $phone = $row->contact; // Customer's mobile number
                $name = $row->name; // Customer's name
                $user = auth()->user() ? auth()->user()->name : 'Admin'; // Logged-in user's name
                $carModel = $row->carmodel; // Car model
                $dataLink = route('jobcards.approve', ['id' => $row->id]); // Link to the job card detail page
                $gMob = auth()->user() ? auth()->user()->mobile : ''; // Garage mobile number
                $gAddress = auth()->user() ? auth()->user()->address : ''; // Garage address

                // Construct the message (internationally professional)
                $message = "Dear $name,\n\nI hope this message finds you well. This is $user from [Your Company Name].\n\n" .
                    "We would like to inform you that your $carModel is due for routine maintenance. Please review and approve the Job Card using the following link: \n" .
                    "$dataLink\n\n" .
                    "Once approved, our certified technicians will be ready to perform the required services at your convenience. We pride ourselves on delivering high-quality services and ensuring your satisfaction is our top priority.\n\n" .
                    "Best regards,\n" .
                    "$user\n" .
                    "Contact: $gMob\n" .
                    "Address: $gAddress\n\n" .
                    "";

                // Encode message to make it URL-safe
                $encodedMessage = urlencode($message);

                // WhatsApp link
                $whatsappLink = "https://wa.me/$phone?text=$encodedMessage";

                $btn = '';
                // $btn = '<a href="' . route('jobcards.previewPdf', ['id' => $row->id]) . '" class="btn btn-sm btn-info" target="_blank">Preview PDF</a> &nbsp;';



                if ($row->work_status !== 1) {
                    $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Estimate</a> &nbsp;';

                    $btn .=
                        '
                <button class="btn btn-sm btn-warning edit-ro" data-id="' . $row->id . '">Edit</button>
                <button class="btn btn-sm btn-danger delete-ro" data-id="' . $row->id . '">Delete</button>
            ';
                } else {
                    // $btn .= '<button onclick="window.location.href=\'' . $whatsappLink . '\'" class="btn btn-sm btn-success">Send via WhatsApp</button> &nbsp;';
                    $btn .= '<button class="btn btn-sm btn-success send-email" data-id="' . $row->id . '">Send Email</button> &nbsp;';
                    $btn .= '    <button class="btn btn-sm btn-warning edit-ro" data-id="' . $row->id . '">Edit</button>';
                }


                if ($row->status == 'C') {
                    $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Invoice</a> &nbsp;';
                }

                return $btn;
            })

            ->rawColumns([
                'split_amount',
                'bill_split',
                'send_approval',
                'payment_mark',
                'status',
                'actions'
            ])
            ->make(true);
    }


    /**
     * EDIT FETCH
     */
    public function edit($id)
    {
        $return = InsuranceRo::with(['vehicle', 'customer', 'insuranceCompany'])->findOrFail($id);

        return $return;
    }

    /**
     * UPDATE
     */

    /* ===============================
       STORE NEW RO
    =============================== */
    public function store(Request $request)
    {
        return $this->saveRo($request);
    }

    /* ===============================
       UPDATE EXISTING RO
    =============================== */
    public function update(Request $request, $id)
    {
        return $this->saveRo($request, $id);
    }

    /* ===============================
       COMMON SAVE LOGIC FOR STORE & UPDATE
    =============================== */
    private function saveRo(Request $request, $id = null)
    {
        if (isset($request->ro_id) && $request->ro_id != null) {
            $id = $request->ro_id;
        } 


        $request->validate([
            'vehicle_registration' => 'required',
            'vehicle_chassis_no'   => 'required',
            'insurance_company_name' => 'required',
        ]);

        // Decode JSON
        $services = $request->filled('services') ? json_decode($request->services, true) : [];
        $inventory = $request->filled('inventory') ? json_decode($request->inventory, true) : [];

        // Calculate totals
        $totalServiceAmount = collect($services)->sum('total');
        $totalInventoryAmount = collect($inventory)->sum('total');
        $totalPrice = $totalServiceAmount + $totalInventoryAmount;

        // Handle Insurance
        $insuranceId = $this->getOrCreateInsurance($request);

        // Handle Vehicle
        $vehicleId = $this->getOrCreateVehicle($request, $insuranceId);

        // Prepare RO data
        $data = [
            'v_id' => $vehicleId,
            'm_id' => $request->assigned_mechanic,
            'registration' => $request->vehicle_registration,
            'chassis_no' => $request->vehicle_chassis_no,
            'carbrand' => $request->vehicle_carbrand,
            'carmodel' => $request->vehicle_carmodel,
            'fueltype' => $request->vehicle_fueltype,
            'odometer' => $request->vehicle_odometer,
            'transmission' => $request->vehicle_transmission,
            'braking' => $request->vehicle_braking,
            'fuelmeter' => $request->vehicle_fuelmeter,
            'insurance_company_id' => $insuranceId,
            'insurance_company' => $request->insurance_company_name,
            'insurance_company_name' => $request->insurance_company_name,
            'insurance_tax_number' => $request->insurance_tax_number,
            'insurance_company_contact' => $request->insurance_company_contact,
            'insurance_email_address' => $request->insurance_email_address,
            'policy_no' => $request->policy_no,
            'claim_no' => $request->claim_no,
            'lpo_no' => $request->lpo_no,
            'driver_name' => $request->insurence_driver_name,
            'driver_mobile_number' => $request->insurence_driver_mobile_number,
            'voice_of_customer' => $request->voice_of_customer,
            'instruction_for_mechanic' => $request->instruction_for_mechanic,
            'remark' => $request->remark,
            'service_due_date' => $request->service_due_date,
            'delivery_due_date' => $request->delivery_due_date,
            'inventory' => !empty($inventory) ? json_encode($inventory) : null,
            'service' => !empty($services) ? json_encode($services) : null,
            'totalPrice' => $totalPrice,
            'dueamount' => $totalPrice,
            'status' => 'P',
            'work_status' => 1,
        ];


        DB::beginTransaction();

        try {
            if ($id) {
                // Update existing RO
                $ro = InsuranceRo::findOrFail($id);
                $ro->update($data);
            } else {
                // Create new RO
                $maxUId = InsuranceRo::max('uid');
                $newUId = $maxUId ? $maxUId + 1 : 1;
                $data['uid'] = $newUId;
                $data['job_card_type'] = 'Accident';
                $data['job_card_no'] = generateJobCardNumbers(auth_id())['job_card_no'];
                $data['invoice_no'] = generateJobCardNumbers(auth_id())['invoice_no'];
                // $data['job_card_no'] = 'RO-' . now()->format('Ymd') . '-' . rand(1000, 9999);
                // $data['invoice_no'] = 'INV-' . rand(1000, 9999);

                $ro = InsuranceRo::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $id ? 'Insurance RO updated successfully' : 'Insurance RO created successfully',
                'id' => $ro->id
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /* ===============================
   GET OR CREATE / UPDATE INSURANCE
=============================== */
    private function getOrCreateInsurance(Request $request)
    {
        $insuranceId = $request->insuranceId;

        if (empty($insuranceId)) {
            $insurance = InsuranceCompany::where('insurence_company_name', $request->insurance_company_name)
                ->orWhere('insurence_email_address', $request->insurance_email_address)
                ->first();

            if ($insurance) {
                // Update existing insurance details
                $insurance->update([
                    'insurence_company_name' => $request->insurance_company_name,
                    'insurence_tax_number' => $request->insurance_tax_number,
                    'insurence_company_number' => $request->insurance_company_contact,
                    'insurence_email_address' => $request->insurance_email_address,
                    'insurence_driver_name' => $request->insurence_driver_name,
                    'insurence_driver_mobile_number' => $request->insurence_driver_mobile_number,
                ]);
            } else {
                // Create new insurance
                $insurance = InsuranceCompany::create([
                    'g_id' => auth_id(),
                    'insurence_company_name' => $request->insurance_company_name,
                    'insurence_tax_number' => $request->insurance_tax_number,
                    'insurence_company_number' => $request->insurance_company_contact,
                    'insurence_email_address' => $request->insurance_email_address,
                    'insurence_driver_name' => $request->insurence_driver_name,
                    'insurence_driver_mobile_number' => $request->insurence_driver_mobile_number,
                ]);
            }

            $insuranceId = $insurance->id;
        }

        return $insuranceId;
    }

    /* ===============================
   GET OR CREATE / UPDATE VEHICLE
=============================== */
    private function getOrCreateVehicle(Request $request, $insuranceId)
    {
        $vehicleId = $request->vehicleId;


        if (empty($vehicleId)) {
            $vehicle = Vehicle::where('registration', $request->vehicle_registration)->first();

            if ($vehicle) {
                // Update existing vehicle
                $vehicle->update([
                    'c_id' => $insuranceId,
                    'registration' => $request->vehicle_registration,
                    'chassis_no' => $request->vehicle_chassis_no,
                    'engine_no' => $request->vehicle_engine_no,
                    'carbrand' => $request->vehicle_carbrand,
                    'carmodel' => $request->vehicle_carmodel,
                    'fueltype' => $request->vehicle_fueltype,
                    'transmission' => $request->vehicle_transmission,
                    'braking' => $request->vehicle_braking,
                    'odo_meter_reading' => $request->vehicle_odometer,
                    'fuel_meter' => $request->vehicle_fuelmeter,
                    'car_body_color' => $request->vehicle_car_body_color,
                    'vehicle_emirate' => $request->vehicle_emirate,
                    'manufacturing_year' => $request->vehicle_manufacturing_year,
                ]);
            } else {
                // Create new vehicle
                $maxVId = Vehicle::max('v_id');
                $newVId = $maxVId ? $maxVId + 1 : 1;

                $vehicle = Vehicle::create([
                    'g_id' => auth_id(),
                    'v_id' => $newVId,
                    'c_id' => $insuranceId,
                    'registration' => $request->vehicle_registration,
                    'chassis_no' => $request->vehicle_chassis_no,
                    'engine_no' => $request->vehicle_engine_no,
                    'carbrand' => $request->vehicle_carbrand,
                    'carmodel' => $request->vehicle_carmodel,
                    'fueltype' => $request->vehicle_fueltype,
                    'transmission' => $request->vehicle_transmission,
                    'braking' => $request->vehicle_braking,
                    'odo_meter_reading' => $request->vehicle_odometer,
                    'fuel_meter' => $request->vehicle_fuelmeter,
                    'car_body_color' => $request->vehicle_car_body_color,
                    'vehicle_emirate' => $request->vehicle_emirate,
                    'manufacturing_year' => $request->vehicle_manufacturing_year,
                ]);
            }

            $vehicleId = $vehicle->id;
        }

        return $vehicleId;
    }


    /**
     * DELETE
     */
    public function destroy($id)
    {
        InsuranceRo::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function search(Request $request)
    {
        return InsuranceCompany::where('insurence_company_name', 'LIKE', "%{$request->q}%")
            ->limit(10)
            ->get();
    }
    public function checkSplit(Request $request)
    {
        $job = InsuranceRo::findOrFail($request->id);


        if (true) {
            return response()->json([
                'status' => 'SHOW_POPUP',
                'data' => [
                    'cust_id' => $job->c_id,
                    'liability_percentage' => $job->liability_percentage,
                    'liability_amount' => $job->liability_amount,
                    'id' => $job->id,
                    'sb_uid' => $job->uid,
                    'inc_id' => $job->insurance_company_id,
                    'cust_name' => $job->name,
                    'cust_contact' => $job->contact,
                    'cust_whatsapp' => $job->contact,
                    'cust_email' => $job->email,
                    'cust_address' => $job->address,
                    'cust_tax' => $job->c_gst,
                ]
            ]);
        }

        return response()->json(['status' => 'TOGGLE_ONLY']);
    }

    public function toggleSplit(Request $request)
    {
        InsuranceRo::where('id', $request->id)
            ->update(['split_billing' => $request->state]);

        return response()->json(['success' => true]);
    }

    public function saveSplit(Request $request)
    {
        // 1️⃣ Validate request
        $request->validate([
            'id' => 'required|integer',
            'liability_percentage' => 'nullable|numeric|min:0|max:100',
            'liability_amount' => 'nullable|numeric|min:0',
            'cust_name' => 'required|string|max:255',
            'cust_contact' => 'required|string|max:20',
            'cust_email' => 'nullable|email|max:255',
            'cust_address' => 'nullable|string|max:500',
            'cust_tax' => 'nullable|string|max:50',
        ]);

        if (!$request->liability_percentage && !$request->liability_amount) {
            return response()->json([
                'success' => false,
                'message' => 'Either percentage or amount is required'
            ], 422);
        }

        // 2️⃣ Get Insurance RO (to read total price)
        $insuranceRo = InsuranceRo::findOrFail($request->id);

        // 👉 Change this field name if your total price column is different
        $totalPrice = $insuranceRo->totalPrice;

        // 3️⃣ Calculate liability amount
        if ($request->liability_percentage) {
            $liabilityPercentage = $request->liability_percentage;
            $liabilityAmount = ($totalPrice * $liabilityPercentage) / 100;
        } else {
            $liabilityPercentage = null;
            $liabilityAmount = $request->liability_amount;
        }

        // 4️⃣ Handle customer (your existing logic – unchanged)
        $customerId = $request->cust_id;

        if (empty($customerId)) {
            $existingCustomer = Customer::where('cus_mob', $request->cust_contact)
                ->orWhere('cus_email', $request->cust_email)
                ->first();

            if ($existingCustomer) {
                $customerId = $existingCustomer->c_id;
            } else {
                $maxCId = Customer::max('c_id');
                $newCId = $maxCId ? $maxCId + 1 : 1;

                $customer = Customer::create([
                    'g_id' => auth_id(),
                    'c_id' => $newCId,
                    'cus_name' => $request->cust_name,
                    'cus_mob' => $request->cust_contact,
                    'cus_email' => $request->cust_email,
                    'c_add' => $request->cust_address,
                    'c_gst' => $request->cust_tax,
                ]);

                $customerId = $customer->c_id;
            }
        }

        // 5️⃣ Update Insurance RO
        $insuranceRo->update([
            'split_billing' => 1,
            'liability_percentage' => $liabilityPercentage,
            'liability_amount' => round($liabilityAmount, 2),
            'c_id' => $customerId,
            'name' => $request->cust_name,
            'contact' => $request->cust_contact,
            'email' => $request->cust_email,
            'address' => $request->cust_address,
            'c_gst' => $request->cust_tax,
        ]);

        return response()->json([
            'success' => true,
            'liability_amount' => round($liabilityAmount, 2),
            'customer_id' => $customerId
        ]);
    }


    public function markPayment(Request $request)
    {
        $request->validate([
            'jobcard_id'   => 'required|integer',
            'payment_type' => 'required|in:insurance,customer',
            'payment_mode' => 'required|in:cash,card,bank transfer',
        ]);

        DB::transaction(function () use ($request) {

            $jobcard = InsuranceRo::lockForUpdate()->findOrFail($request->jobcard_id);

            if (PaymentHistory::where('jobcard_id', $jobcard->id)
                ->where('payment_type', $request->payment_type)
                ->exists()
            ) {
                abort(409, ucfirst($request->payment_type) . ' payment already marked');
            }

            $totalAmount     = $jobcard->dueamount;
            $insuranceAmount = $jobcard->liability_amount;


            $customerAmount  = max(0, $totalAmount - $insuranceAmount);


            if ($request->payment_type === 'insurance') {
                $paidAmount = $insuranceAmount;
                $newDue     = max(0, $totalAmount - $insuranceAmount);
            } else {
                $paidAmount = $customerAmount;
                $newDue     = max(0, $totalAmount - $customerAmount);
            }

            if ($jobcard->split_billing != 1) {
                $paidAmount = $jobcard->totalPrice;
                $newDue = 0;
            }

            $data = [
                'c_id'         => $jobcard->c_id ?? null,
                'jobcard_id'   => $jobcard->id,
                'g_id'         => $jobcard->g_id,
                'inc_id'       => $jobcard->insurance_company_id,
                'amount'       => $paidAmount,
                'mark_in'      => $request->payment_type,
                'payment_type' => $request->payment_mode,
                'status'       => 'C',
            ];


            PaymentHistory::create($data);

            $jobcard->update([
                'dueamount'      => $newDue,
                'payment_status' => $newDue == 0 ? 1 : 0,
                'status'         => $newDue == 0 ? 'C' : 'P',
            ]);
        });

        return response()->json(['success' => true]);
    }
}
