<?php

namespace App\Http\Controllers;

use DataTables;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\JobCard;
use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\User;
use App\Mail\JobCardApprovalMail;   // ✅ Add this
use App\Models\Inventory;
use App\Models\ServicePackage;
use App\Models\CarMaker;
use App\Models\CarModel;
use App\Models\Service;
use Illuminate\Support\Facades\Mail; // (optional but recommended)
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Adminer\switch_lang;
use function Adminer\target_blank;

class JobCardController extends Controller
{


    public function reject($id)
    {
        $jobcard = JobCard::findOrFail($id);

        // Check if the job card is already rejected (work_status == 2)
        if ($jobcard->work_status != 1) {
            // If already rejected, redirect to the Thank You page with a message
            return redirect()->route('thankyou.page')
                ->with('message', 'You have already take action.')
                ->with('action_type', 'action taken');
        }

        // Update the job card's status to 'rejected' (work_status = 2)
        $jobcard->work_status = 5;
        $jobcard->save();

        // Redirect to the job card preview PDF page with a success message
        return redirect()->route('jobcards.previewPdf', ['id' => $jobcard->id])
            ->with('message', 'Job card rejected successfully!')
            ->with('action_type', 'rejected');
    }

    public function approve($id)
    {
        $jobcard = JobCard::findOrFail($id);

        // Check if the job card is already approved (work_status == 1)
        if ($jobcard->work_status != 1) {
            // If already approved, redirect to the Thank You page with a message
            return redirect()->route('thankyou.page')
                ->with('message', 'You have already take action')
                ->with('action_type', 'action taken');
        }

        // Update the job card's status to 'approved' (work_status = 1)
        $jobcard->work_status = 2;
        $jobcard->save();

        // Redirect to the job card preview PDF page with a success message
        return redirect()->route('jobcards.previewPdf', ['id' => $jobcard->id])
            ->with('message', 'Job card approved successfully!')
            ->with('action_type', 'approved');
    }


    public function estimateViewPage(Request $request)
    {
        $value = $request->searchdata;
        $jobcard = JobCard::with('payment', 'insuranceCompany', 'customer')->where('job_card_no', $value)->first();
        $garage = User::findOrFail(auth_id())->first();

        return view('jobcards.estimate', compact('jobcard', 'garage'));
    }

    public function estimateView($id)
    {

        $jobcard = JobCard::with('payment', 'insuranceCompany', 'customer')->where('id', $id)->first();
        $garage = User::findOrFail(auth_id())->first();

        return view('jobcards.estimate', compact('jobcard', 'garage'));
    }

    // public function previewPdf($id)
    // {
    //     $jobcard = (object)JobCard::with('payment')->findOrFail($id)->toArray();

    //     $pdf = Pdf::loadView('jobcards.pdf_preview', compact('jobcard'))
    //         ->setPaper('a4')
    //         ->setWarnings(false);


    //     return $pdf->stream('JobCard_' . $jobcard->job_card_no . '.pdf');
    // }
    public function previewPdf($id)
    {
        $jobcard = (object)JobCard::with('payment', 'insuranceCompany', 'customer')->findOrFail($id)->toArray();

        // Decode JSON
        $parts = json_decode($jobcard->inventory, true) ?? [];
        $services = json_decode($jobcard->service, true) ?? [];

        // Calculate totals
        $jobcard->parts_total = collect($parts)->sum(fn($p) => $p['total'] ?? 0);
        $jobcard->services_total = collect($services)->sum(fn($s) => $s['total'] ?? 0);

        $jobcard->grand_total = $jobcard->parts_total + $jobcard->services_total;

        return view('jobcards.pdf_preview', compact('jobcard'));
    }



    public function index()
    {


        // $customers = Customer::orderBy('cus_name')->get();
        // $vehicles  = Vehicle::orderBy('id', 'desc')->get();
        $jobcard_uid = JobCard::max('uid') + 1;
        $jobcard_no = generateJobCardNumbers(auth_id())['job_card_no'];

        $vehicles = Vehicle::all();
        $customers = Customer::all();
        $brands = CarMaker::all();
        $models = CarModel::all();
        $service = Service::all();
        $inventory = Inventory::all();
        $packages = ServicePackage::all();
        return view('jobcards.index', compact('jobcard_no', 'vehicles', 'customers', 'brands', 'models', 'inventory', 'service', 'packages', 'jobcard_uid'));


        // Return the transformed data to the view
        // return view('jobcards.index', compact('customers', 'vehicles', 'inventory', 'packages', 'jobcard_uid'));
    }

    public function pendingPay()
    {
        $customers = Customer::orderBy('cus_name')->get();
        $vehicles  = Vehicle::orderBy('id', 'desc')->get();



        // Fetch inventory from DB
        $inventoryFromDb = Inventory::all(); // or a query you already have

        // Transform inventory to the desired structure
        $inventory = $inventoryFromDb->map(function ($item) {
            return [
                'id' => $item->id,
                'part_name' => $item->Product,
                'mrp' => $item->SalePrice, // or CostPrice if you prefer
                'discount' => 0, // default value
                'stock' => $item->Stock,
            ];
        })->toArray();


        // Create an associative array indexed by 'id' to make lookup easier
        $inventoryIndex = array_column($inventory, null, 'id');

        // Fetch service packages from the database
        $packagesFromDb = ServicePackage::all();

        // Transform the packages into the desired structure
        $packages = $packagesFromDb->map(function ($package) use ($inventoryIndex) {
            return [
                'id' => $package->id,
                'name' => $package->package, // Assuming 'package' is the name of the package
                'items' => collect($package->items)->map(function ($item) use ($inventoryIndex) {
                    // Dynamically access the inventory using the item id
                    $inventoryItem = $inventoryIndex[$item['id']] ?? null; // Safely handle missing inventory
                    return [
                        'id' => $item['id'],
                        'part_name' => $inventoryItem ? $inventoryItem['part_name'] : 'Unknown', // Default 'Unknown' if not found
                        'mrp' => $inventoryItem ? $inventoryItem['mrp'] : 0, // Default 0 if not found
                        'discount' => 0, // Default value (or you can customize this)
                    ];
                })->toArray(),
            ];
        });

        // Return the transformed data to the view
        return view('jobcards.pending_pay', compact('customers', 'vehicles', 'inventory', 'packages'));
    }

    public function getList(Request $request)
    {
        // Eager load customer or vehicle if needed, otherwise just select fields
        $data = JobCard::select('id', 'job_card_no', 'invoice_no', 'name', 'carbrand', 'work_status', 'status', 'totalPrice', 'dueamount')->get();

        return Datatables::of($data)
            ->addIndexColumn()
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


                switch ($row->work_status) {
                    case 4:

                        if ($row->status == 'C') {
                            $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Invoice</a> &nbsp;';
                        }

                        if ($row->status == 'P') {
                            $btn .= '<button class="btn btn-sm btn-warning mark-payment" data-id="' . $row->id . '" data-invoice="' . $row->invoice_no . '" data-dueamount="' . $row->dueamount . '">Mark Payment</button> &nbsp;';
                        }

                        break;

                    default:
                        $btn .= '<button class="btn btn-sm btn-success send-email" data-id="' . $row->id . '">Send Email</button> &nbsp;';
                        $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Estimate</a> &nbsp;';
                        $btn .= '<button class="btn btn-sm btn-primary editJobCard" data-id="' . $row->id . '">Edit</button> &nbsp;';
                        break;
                }


                // if ($row->work_status !== 1) {
                //     $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Estimate</a> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-primary editJobCard" data-id="' . $row->id . '">Edit</button> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-warning mark-payment" data-id="' . $row->id . '" data-invoice="' . $row->invoice_no . '" data-dueamount="' . $row->dueamount . '">Mark Payment</button> &nbsp;';
                // } else {
                //     // $btn .= '<button onclick="window.location.href=\'' . $whatsappLink . '\'" class="btn btn-sm btn-success">Send via WhatsApp</button> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-success send-email" data-id="' . $row->id . '">Send Email</button> &nbsp;';
                // }

                // if ($row->work_status !== 1) {
                //     $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Estimate</a> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-primary editJobCard" data-id="' . $row->id . '">Edit</button> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-warning mark-payment" data-id="' . $row->id . '" data-invoice="' . $row->invoice_no . '" data-dueamount="' . $row->dueamount . '">Mark Payment</button> &nbsp;';
                // } else {
                //     // $btn .= '<button onclick="window.location.href=\'' . $whatsappLink . '\'" class="btn btn-sm btn-success">Send via WhatsApp</button> &nbsp;';
                //     $btn .= '<button class="btn btn-sm btn-success send-email" data-id="' . $row->id . '">Send Email</button> &nbsp;';
                // }


                return $btn;
            })
            ->editColumn('status', function ($row) {
                // Convert status code to readable text
                return match ($row->status) {
                    'P' => '<span class="badge badge-warning">Pending</span>',
                    'C' => '<span class="badge badge-success">Complete</span>',
                    'R' => '<span class="badge badge-danger">Rejected</span>',
                    default => '<span class="badge badge-secondary">Unknown</span>',
                };
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }



    public function getListPending(Request $request)
    {
        $status = $request->status;

        $data = JobCard::select('id', 'job_card_no', 'invoice_no', 'name', 'carbrand', 'status', 'dueamount', 'registration')
            ->when($status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('dueamount', 'desc')
            ->get();


        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = '<a href="' . route('jobcards.previewPdf', ['id' => $row->id]) . '" class="btn btn-sm btn-info" target="_blank">Preview PDF</a> &nbsp';
                $btn .= '<a href="' . route('jobcards.estimate', ['id' => $row->id]) . '" class="btn btn-sm btn-warning" target="_blank">Estimate</a> &nbsp;';
                return $btn;
            })
            ->editColumn('status', function ($row) {
                // Convert status code to readable text
                return match ($row->status) {
                    'P' => '<span class="badge badge-warning">Pending</span>',
                    'C' => '<span class="badge badge-success">Complete</span>',
                    'R' => '<span class="badge badge-danger">Rejected</span>',
                    default => '<span class="badge badge-secondary">Unknown</span>',
                };
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }



    public function edit($id)
    {
        $jobcard = JobCard::findOrFail($id);

        // Decode JSON services
        $services = $jobcard->service ? json_decode($jobcard->service, true) : [];
        $inventory = $jobcard->inventory ? json_decode($jobcard->inventory, true) : [];

        // Merge & return
        return response()->json(array_merge(
            $jobcard->toArray(),
            ['inventory' => $inventory],
            ['services' => $services]
        ));
    }



    /* ===============================
   STORE NEW JOB CARD
================================ */
    public function store(Request $request)
    {
        return $this->saveJobCard($request);
    }

    /* ===============================
   UPDATE EXISTING JOB CARD
================================ */
    public function update(Request $request, $id)
    {
        return $this->saveJobCard($request, $id);
    }

    /* ===============================
   COMMON SAVE LOGIC
================================ */
    private function saveJobCard(Request $request, $id = null)
    {


        // ✅ Validation
        $request->validate([
            'job_card_type' => 'required',
            'c_id'          => 'required',
            'v_id'          => 'required',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Decode JSON
    |--------------------------------------------------------------------------
    */
        $services  = $request->filled('services')
            ? json_decode($request->services, true) ?? []
            : [];

        $inventory = $request->filled('inventory')
            ? json_decode($request->inventory, true) ?? []
            : [];


        /*
    |--------------------------------------------------------------------------
    | Calculate Totals (🔥 FIX)
    |--------------------------------------------------------------------------
    */
        $serviceTotal   = collect($services)->sum('total');
        $inventoryTotal = collect($inventory)->sum('total');



        // Calculate totalPrice and dueAmount ensuring decimal precision
        $totalPrice = number_format($serviceTotal + $inventoryTotal, 2, '.', '');
        $dueAmount  = number_format($totalPrice, 2, '.', ''); // By default, full amount due


        /*
    |--------------------------------------------------------------------------
    | Discounts
    |--------------------------------------------------------------------------
    */
        $serviceDiscount = is_array($request->service_discount)
            ? array_sum($request->service_discount)
            : 0;

        /*
    |--------------------------------------------------------------------------
    | Prepare Data
    |--------------------------------------------------------------------------
    */
        $data = [
            'job_card_type' => $request->job_card_type,
            'uid'           => $request->uid,
            'm_id'          => $request->m_id,
            'c_id'          => $request->c_id,
            'v_id'          => $request->v_id,

            'name'          => $request->name,
            'contact'       => $request->contact,
            'email'         => $request->email,
            'address'       => $request->address,

            'carbrand'      => $request->vehBrand,
            'carmodel'      => $request->vehModel,
            'registration'  => $request->vehReg,
            'fueltype'      => $request->vehFuel,
            'chassis_no'    => $request->vehChassis,
            'odometer'      => $request->odometer,
            'transmission'  => $request->vehTrans,
            'braking'       => $request->braking,
            'fuelmeter'     => $request->fuelmeter,

            'inventory'     => !empty($inventory) ? json_encode($inventory) : null,
            'service'       => !empty($services) ? json_encode($services) : null,

            // ✅ FIXED TOTALS
            'totalPrice'    => $totalPrice,
            'dueamount'     => $dueAmount,
            'service_discount' => $serviceDiscount,

            'insurance_code'          => $request->insurance_code,
            'insurance_company'       => $request->insurance_company_name,
            'insurance_company_name'  => $request->insurance_company_name,
            'insurance_policy_number' => $request->insurance_policy_number,
            'insurance_claim_number'  => $request->insurance_claim_number,

            'voice_of_customer'       => $request->voice_of_customer,
            'instruction_for_mechanic' => $request->instruction_for_mechanic,
            'remark'                  => $request->remark,

            'status'      => 'P',
            'work_status' => 1,
            'g_id'        => auth_id(),
        ];



        DB::beginTransaction();

        try {
            if ($id) {
                // 🔄 UPDATE
                $jobCard = JobCard::findOrFail($id);
                $jobCard->update($data);
            } else {
                // 🆕 CREATE
                $data['job_card_no'] = generateJobCardNumbers(auth_id())['job_card_no'];
                $data['invoice_no'] = generateJobCardNumbers(auth_id())['invoice_no'];
                // $data['job_card_no'] = 'JC-' . now()->format('Ymd') . '-' . rand(1000, 9999);
                // $data['invoice_no']  = 'INVC-' . rand(1000, 9999);

                $jobCard = JobCard::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => $id
                    ? 'Job Card updated successfully'
                    : 'Job Card created successfully',
                'job_card_id' => $jobCard->id,
                'totalPrice'  => $totalPrice,
                'dueamount'   => $dueAmount
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong'
            ], 500);
        }
    }



    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:jobcard,id',
            'status' => 'required|string',
        ]);

        $jobCard = JobCard::find($request->id);
        $jobCard->work_status = (int)$request->status;


        $jobCard->save();

        return response()->json(['success' => true]);
    }


    public function sendEmail($id)
    {
        // Eager load related customer and insurance company
        $jobcard = JobCard::with(['customer', 'insuranceCompany'])->findOrFail($id);

        // Determine recipient email
        $recipientEmail = null;

        if ($jobcard->insurance_company_id) {
            $recipientEmail = $jobcard->insuranceCompany->insurence_email_address;
        } elseif ($jobcard->customer && !empty($jobcard->customer->cus_email)) {
            $recipientEmail = $jobcard->customer->cus_email;
        }

        // Send email if we have a valid recipient
        if ($recipientEmail) {
            \Mail::to($recipientEmail)->send(new JobCardApprovalMail($jobcard));

            return response()->json([
                'success' => true,
                'message' => 'Email sent successfully to ' . $recipientEmail
            ]);
        }

        // If no valid email found
        return response()->json([
            'success' => false,
            'message' => 'No valid recipient email found. Email not sent.'
        ]);
    }



    public function markPayment(Request $request)
    {
        $request->validate([
            'job_card_id' => 'required|exists:jobcard,id',
            'payment_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        // Find the job card
        $jobCard = JobCard::findOrFail($request->job_card_id);

        // Update payment related fields
        $jobCard->payment_method = $request->payment_method;
        $jobCard->dueamount -= $request->payment_amount; // Decrease due amount

        // If the due amount becomes zero or less, mark the job card as completed
        if ($jobCard->dueamount <= 0) {
            $jobCard->dueamount = 0;
            $jobCard->status = 'C';
        }
        $jobCard->save();


        $paymentDetails = [
            'g_id' => $jobCard->g_id,  // Assuming g_id exists in the JobCard model
            'c_id' => $jobCard->c_id,  // Assuming c_id exists in the JobCard model
            'jobcard_id' => $jobCard->id,
            'amount' => $request->payment_amount,
            'status' => 'C',  // Payment status ('C' for Completed, you can use 'P' for Pending if needed)
            'payment_type' => $request->payment_method,  // Payment method (Cash, Card, etc.)
            'created_at' => now()->toDateString(),  // Use current date for created_at
        ];


        // Insert a record into the payment_history table using DB facade
        DB::table('payment_history')->insert($paymentDetails);

        // Optionally, you could save payment history, for now, we're just updating the job card

        return response()->json(['success' => true]);
    }

    public function thermalInvoice($id)
    {
        $jobcard = Jobcard::with(['garage', 'customer'])->findOrFail($id);

        $inventoryItems = json_decode($jobcard->inventory, true) ?: [];
        $serviceItems   = json_decode($jobcard->service, true) ?: [];

        $data = [
            'shop_name'    => $jobcard->garage->g_name ?? 'N/A',
            'shop_address' => $jobcard->garage->g_address ?? 'N/A',
            'shop_contact' => $jobcard->garage->g_mob ?? 'N/A',
            'shop_email'   => $jobcard->garage->g_email ?? 'N/A',
            'invoice_no'   => $jobcard->invoice_no,
            'created_at'   => $jobcard->created_at->format('d-m-Y H:i'),
            'customer' => [
                'name'    => $jobcard->customer->cus_name ?? $jobcard->name ?? 'N/A',
                'contact' => $jobcard->customer->cus_mob ?? $jobcard->contact ?? 'N/A',
                'address' => $jobcard->customer->c_add ?? $jobcard->address ?? 'N/A'
            ],
            'vehicle' => [
                'registration' => $jobcard->registration ?? 'N/A',
                'brand'        => $jobcard->carbrand ?? 'N/A',
                'model'        => $jobcard->carmodel ?? 'N/A',
                'odometer'     => $jobcard->odometer ?? 'N/A'
            ],
            'inventory' => $inventoryItems,
            'services'  => $serviceItems,
            'subtotal'  => $jobcard->totalPrice ?? 0,
            'tax'       => 0,
            'discount'  => ($jobcard->service_discount ?? 0) + ($jobcard->part_discount ?? 0),
            'total'     => $jobcard->totalPrice ?? 0
        ];

        $pdf = PDF::loadView('jobcards.thermal', compact('data'))
            ->setPaper([0, 0, 300, 750], 'portrait');

        return $pdf->stream('thermal-invoice.pdf');
    }
}
