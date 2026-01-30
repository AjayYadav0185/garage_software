<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use App\Models\JobCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;



class ReminderController extends Controller
{
    public function __construct()
    {
        // Ensure table exists on every controller load
        Reminder::ensureTableExists();
    }

    // Show all reminders and counts (for Blade page)
    public function index()
    {
        $reminderCounts = Reminder::getCountsByType();
        return view('reminders.index', compact('reminderCounts'));
    }


    public function ajax(Request $request)
    {
        $data = JobCard::select('*')->get();
        $reminderRows = collect();

        foreach ($data as $row) {

            // Service Reminder
            if (!is_null($row->service_due_date)) {
                $reminderRows->push((object)[
                    'id' => $row->uid,
                    'name' => $row->name,
                    'contact' => $row->contact,
                    'email' => $row->email,
                    'address' => $row->address,
                    'carbrand' => $row->carbrand,
                    'carmodel' => $row->carmodel,
                    'fueltype' => $row->fueltype,
                    'registration' => $row->registration,
                    'reminder_type' => 'Service',
                    'due_date' => $row->service_due_date,
                    'is_sent' => $row->service_reminder_sent ?? 0,
                    'status' => $row->status,
                ]);
            }

            // Insurance Reminder
            if (!is_null($row->insexpiry)) {
                $reminderRows->push((object)[
                    'id' => $row->uid,
                    'name' => $row->name,
                    'contact' => $row->contact,
                    'email' => $row->email,
                    'address' => $row->address,
                    'carbrand' => $row->carbrand,
                    'carmodel' => $row->carmodel,
                    'fueltype' => $row->fueltype,
                    'registration' => $row->registration,
                    'reminder_type' => 'Insurance',
                    'due_date' => $row->insexpiry,
                    'is_sent' => $row->insurance_reminder_sent ?? 0,
                    'status' => $row->status,
                ]);
            }
        }

        return datatables()->of($reminderRows)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $phone = '8802929885';
                // $phone = $row->contact ?? '8802929885';
                $name = $row->name;
                $user = auth()->user() ? auth()->user()->g_name : 'Admin';
                $gMob = auth()->user() ? auth()->user()->g_mob : '';
                $gAddress = auth()->user() ? auth()->user()->g_address : '';
                $type = $row->reminder_type;

                $message = "Dear $name,\n\nThis is $user from Meri Garage.\n\n" .
                    "This is a $type reminder for your vehicle.\n" .
                    "Due Date: {$row->due_date}\n\n" .
                    "Best regards,\n$user\nContact: $gMob\nAddress: $gAddress";

                $encodedMessage = urlencode($message);
                $whatsappLink = "https://wa.me/$phone?text=$encodedMessage";

                $btn = '';
                // $btn .= '<button class="btn btn-sm btn-primary send-reminder" data-id="' . $row->id . '" data-type="' . strtolower($type) . '">Send Email</button>';
                $btn .= '<button onclick="window.location.href=\'' . $whatsappLink . '\'" class="btn btn-sm btn-success">Send via WhatsApp</button> &nbsp;';
                return $btn;
            })
            ->editColumn('status', function ($row) {
                return match ($row->status) {
                    'P' => '<span class="badge badge-warning">Pending</span>',
                    'C' => '<span class="badge badge-success">Complete</span>',
                    default => '<span class="badge badge-secondary">Unknown</span>',
                };
            })
            ->rawColumns(['actions'])
            ->make(true);
    }



    // AJAX endpoint for DataTables
    // public function ajax(Request $request)
    // {
    //     $reminders = Reminder::query();

    //     return datatables()->of($reminders)
    //         ->addColumn('actions', function ($row) {
    //             // $btn = '<button class="btn btn-sm btn-primary edit-reminder" data-id="' . $row->id . '">Edit</button> ';
    //             // $btn .= '<button class="btn btn-sm btn-danger delete-reminder" data-id="' . $row->id . '">Delete</button> ';
    //             // if (!$row->is_sent) {
    //             $btn = '<button class="btn btn-sm btn-success send-reminder" data-id="' . $row->id . '">Send Reminder</button>';
    //             // }
    //             return $btn;
    //         })
    //         ->editColumn('is_sent', function ($row) {
    //             return $row->is_sent ? '<span class="badge bg-success">Sent</span>' : '<span class="badge bg-warning">Pending</span>';
    //         })
    //         ->rawColumns(['actions', 'is_sent'])
    //         ->make(true);
    // }


    public function send(Request $request)
    {
        $reminder = Reminder::find($request->id);

        if (!$reminder) {
            return response()->json(['status' => 'error', 'message' => 'Reminder not found'], 404);
        }

        $actionUrl = '';

        Mail::to('ajayretro1@gmail.com')->send(new ReminderMail($reminder, $actionUrl));
        // Mail::to($reminder->email)->send(new ReminderMail($reminder, $actionUrl));

        $reminder->is_sent = $reminder->is_sent + 1;
        $reminder->save();

        return response()->json(['status' => 'success', 'message' => 'Reminder sent successfully to ' . $reminder->email]);
    }


    // Send individual reminder
    // public function send(Request $request)
    // {
    //     $id = $request->id;
    //     $reminder = Reminder::find($id);

    //     if (!$reminder) {
    //         return response()->json(['status' => 'error', 'message' => 'Reminder not found'], 404);
    //     }

    //     // Optional: implement actual email sending here
    //     // Mail::to($reminder->email)->send(new ReminderMail($reminder));

    //     $reminder->is_sent = 1;
    //     $reminder->save();

    //     return response()->json(['status' => 'success', 'message' => 'Reminder sent successfully to ' . $reminder->email]);
    // }

    // Store new reminder
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'reminder_type' => 'required|string|in:service,insurance',
            'service_date' => 'nullable|date',
        ]);

        Reminder::create($data);

        return response()->json(['status' => 'success', 'success' => 'Reminder added successfully!']);
    }

    // Get reminder for editing
    public function edit($id)
    {
        $reminder = Reminder::find($id);
        if (!$reminder) {
            return response()->json(['status' => 'error', 'message' => 'Reminder not found'], 404);
        }
        return response()->json($reminder);
    }

    // Update reminder
    public function update(Request $request, $id)
    {
        $reminder = Reminder::find($id);
        if (!$reminder) {
            return response()->json(['status' => 'error', 'message' => 'Reminder not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'reminder_type' => 'required|string|in:service,insurance',
            'service_date' => 'nullable|date',
        ]);

        $reminder->update($data);

        return response()->json(['status' => 'success', 'success' => 'Reminder updated successfully!']);
    }

    // Delete reminder
    public function destroy($id)
    {
        $reminder = Reminder::find($id);
        if (!$reminder) {
            return response()->json(['status' => 'error', 'message' => 'Reminder not found'], 404);
        }

        $reminder->delete();

        return response()->json(['status' => 'success', 'success' => 'Reminder deleted successfully!']);
    }
}
