<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AuthAccount;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Rules\PhoneNumber;

class RegisteredUserController extends Controller
{
    /**
     * Show registration form
     */
    public function create(): View
    {
        return view('auth.register', [
            'countries' => Country::orderBy('name')->get()
        ]);
    }

    /**
     * Handle registration
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'terms' => ['required', 'accepted'],
                'name'     => ['required', 'string', 'max:200'],
                'mobile'   => ['required', 'string', 'max:50', 'unique:call_login,g_mob'],
                'mobile'     => [
                    'required',
                    'string',
                    'max:50',
                    new PhoneNumber($request->code),
                    'unique:call_login,g_mob'
                ],
                'email'    => [
                    'required',
                    'string',
                    'email',
                    'max:100',
                    'unique:call_login,email',
                    'unique:call_login,g_email'
                ],
                'address'    => ['required', 'string'],
                'country_id' => ['required', 'exists:countries,id'],
                'password'  => ['required', Rules\Password::defaults()],
            ],
            [
                'email.unique'   => 'This email is already registered.',
                'mobile.unique'  => 'This mobile number is already registered.',
                'country_id.required' => 'Please select a country.',
            ]
        );



        /* ================================
         | Create ADMIN (call_login)
         ================================= */
        $user = User::create([
            'username'  => $request->name,
            'g_name'    => $request->name,
            'g_mob'     => $request->mobile,
            'email'     => $request->email,
            'g_email'   => $request->email,
            'g_address' => $request->address,
            'password'  => Hash::make($request->password),
            'country_id' => $request->country_id,

            // defaults
            'g_gst'     => 'N/A',
            'img'       => '',
            'qrcode'    => '',
            'state'     => '',
            'city'      => '',
            'stamp'     => null,
            'sign'      => null,
            'trial_end_date' => now()->addDays(7),
        ]);


        /* ================================
         | Create AuthAccount
         ================================= */
        AuthAccount::firstOrCreate(
            [
                'type'   => 'admin',
                'ref_id' => $user->g_id,
            ],
            [
                'name'       => $user->g_name,
                'login_type' => 'admin',
                'email'      => $user->g_email,
                'password'   => $user->password,
                'country_id' => $user->country_id,
                'lang'   => $user->country->language ?? 'en',
            ]
        );

        event(new Registered($user));

        Auth::loginUsingId(
            AuthAccount::where('type', 'admin')
                ->where('ref_id', $user->g_id)
                ->value('id')
        );

        return redirect(RouteServiceProvider::HOME);
    }
}
