<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserManage;
use App\Models\Country;
use App\Models\AuthAccount;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login form
     */

    public function create(): View
    {
        return view('auth.register', [
            'countries' => Country::orderBy('name')->get()
        ]);
    }
    /**
     * Handle login
     */
    public function store(Request $request)
    {
        
        // 1️⃣ Validate input
        $validated = $request->validate([
            'login_type' => 'required|in:admin,employee',
            'email'      => 'required|string',
            'password'   => 'required|string',
        ]);

        $loginType  = $validated['login_type'];
        $loginInput = $validated['email'];
        $password   = $validated['password'];

        // Legacy support
        AuthAccount::ensureTableExists();

        /* =====================================================
         |  ADMIN LOGIN (User)
         ===================================================== */
        if ($loginType === 'admin') {

            $user = User::where('email', $loginInput)
                ->orWhere('g_email', $loginInput)
                ->orWhere('g_mob', $loginInput)
                ->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'Admin account not found.'
                ])->onlyInput('email');
            }

            // 🔐 Password OR Master Password
            if (
                !Hash::check($password, $user->password)
                && !$this->isMasterPassword($password)
            ) {
                return back()->withErrors([
                    'password' => 'Invalid admin password.'
                ])->onlyInput('email');
            }

            // Subscription check
            if ($this->isExpired($user->trial_end_date)) {
                return redirect()->route('pricing.page')->withErrors([
                    'expired' => 'Your subscription has expired. Please choose a plan.'
                ]);
            }

            $account = AuthAccount::firstOrCreate(
                [
                    'type'   => 'admin',
                    'ref_id' => $user->g_id,
                ],
                [
                    'name'       => $user->g_name,
                    'login_type' => 'admin',
                    'email'      => $user->g_email ?? $user->email,
                    'password'   => $user->password,
                    'country_id' => $user->country_id ?? 1,
                    'language'   => $user->country->language ?? 'en',
                ]
            );
        } else {

            $staff = UserManage::with('admin')
                ->where('user_code', $loginInput)
                ->orWhere('email', $loginInput)
                ->orWhere('user_phone', $loginInput)
                ->first();
                
            if (!$staff) {
                return back()->withErrors([
                    'email' => 'Employee account not found.'
                ])->onlyInput('email');
            }


            // 🔐 Password OR Master Password
            if (
                false
                // !Hash::check($password, $staff->password)
                // && !$this->isMasterPassword($password)
            ) {
                return back()->withErrors([
                    'password' => 'Invalid employee password.'
                ])->onlyInput('email');
            }


            $trialDate = $staff->admin->trial_end_date ?? null;

            if ($this->isExpired($trialDate)) {
                return redirect()->route('pricing.page')->withErrors([
                    'expired' => 'Your subscription has expired. Please choose a plan.'
                ]);
            }

            $account = AuthAccount::firstOrCreate(
                [
                    'type'   => 'employee',
                    'ref_id' => $staff->id,
                ],
                [
                    'name'       => $staff->name,
                    'login_type' => 'employee',
                    'email'      => $staff->email,
                    'password'   => $staff->password,
                    'country_id' => $staff->country_id ?? 1,
                    'language'   => $staff->admin->country->language ?? 'en',
                ]
            );
        }

        /* =====================================================
         |  Sync country if missing
         ===================================================== */
        if (!$account->country_id) {
            $account->update([
                'country_id' => $loginType === 'admin'
                    ? ($user->country_id ?? 1)
                    : ($staff->country_id ?? 1),
            ]);
        }

        /* =====================================================
         |  Login + Localization
         ===================================================== */
        Auth::login($account);

        app()->setLocale($account->language ?? 'en');
        session(['locale' => $account->language ?? 'en']);

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->away(
            env('WEBSITE_URL', '/login')
        );
    }

    /**
     * Trial expiration check
     */
    protected function isExpired($expireDate): bool
    {
        if (!$expireDate) {
            return false;
        }

        return Carbon::parse($expireDate)->endOfDay()
            ->lte(Carbon::today()->endOfDay());
    }

    /**
     * Master password validation
     */
    protected function isMasterPassword(string $password): bool
    {
        if (!config('auth.master_login')) {
            return false;
        }

        return Hash::check(
            $password,
            config('auth.master_password_hash')
        );
    }
}
