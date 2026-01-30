<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function editPage(Request $request): View
    {
        $user = User::findOrFail(auth_id()); // No need to call `first()` after `findOrFail()`

        // Generate URLs for the images
        $user->img_url = $user->img ? asset('storage/' . $user->img) : null;
        $user->qrcode_url = $user->qrcode ? asset('storage/' . $user->qrcode) : null;
        $user->stamp_url = $user->stamp ? asset('storage/' . $user->stamp) : null;
        $user->sign_url = $user->sign ? asset('storage/' . $user->sign) : null;

        // dd($user->sign_url);

        return view('profile.edit', [
            'user' => $user,
        ]);
    }


    public function edit(Request $request): View
    {
        return view('profile.changepassword', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function verifyChangePassword(Request $request)
    {
        $params = $request->all();
        $messages = [
            'old_password.required' => 'Please enter old password.',
            'new_password.required' => 'Please enter new password.',
            'confirm_password.required' => 'Please enter confirm password.',
        ];
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required|required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'confirm_password' => 'same:new_password|min:8',
        ];
        $validator = validator()->make($params, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->errors());
        }

        $obj = User::findOrFail(auth_id())->first();

        if (Hash::check($request->old_password, $obj->password)) {
            $password = Hash::make($request->new_password);
            $updated_date = date('Y-m-d H:i:s');
            $status = DB::table('call_login')
                ->where('g_id', $obj->g_id)
                ->update([
                    'password' => $password,
                ]);

            return redirect('profile')->with(
                'success',
                'Password changed successfully.'
            );
        } else {
            return redirect('profile')->with(
                'error',
                'Opps! You have entered invalid credentials.'
            );
        }

        return redirect('profile')->with(
            'error',
            'The current password is incorrect.'
        );
    }

    public function updatePassword(Request $request)
    {

        // Validate the input data
        $validated = $request->validate([
            'g_mob' => 'required|numeric|exists:users,g_mob', // Ensure the mobile number exists in the users table
            'password' => 'required|min:8', // Password must be at least 8 characters
        ]);

        // Retrieve user by mobile number
        $user = User::where('g_mob', $request->g_mob)->first();

        if ($user) {
            // Hash the new password
            $user->password = Hash::make($request->password);

            // Save the updated user data
            $user->save();

            // Set session message
            Session::flash('msg6', 'Password Updated Successfully!');
            return redirect()->route('login'); // Redirect to login page
        } else {
            // User not found
            Session::flash('msg7', 'User not found!');
            return redirect()->back(); // Go back to the form
        }
    }

    // Handle the profile update form submission
    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'g_name' => 'required|string|max:255',
            'g_mob' => 'required|string|max:15',
            'g_gst' => 'nullable|string|max:15',
            'g_email' => 'required|email|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qrcode' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sign' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'g_address' => 'required|string|max:255',
        ]);


        // Get the authenticated user

        $user = User::findOrFail(auth_id())->first();

        // Handle image uploads if they exist
        if ($request->hasFile('img')) {
            // $imgPath = $request->file('img')->store('images', 'public');
            $imgPath = $request->file('img')->move(public_path('store/images'), $request->file('img')->getClientOriginalName());
            $relativePath = \Illuminate\Support\Str::after($imgPath->getRealPath(), public_path() . DIRECTORY_SEPARATOR . 'store' . DIRECTORY_SEPARATOR);
            $user->img = "store/$relativePath";
        }

        if ($request->hasFile('qrcode')) {
            // $qrcodePath = $request->file('qrcode')->store('qrcodes', 'public');
            $qrcodePath = $request->file('qrcode')->move(public_path('store/qrcodes'), $request->file('qrcode')->getClientOriginalName());
            $relativePath = \Illuminate\Support\Str::after($qrcodePath->getRealPath(), public_path() . DIRECTORY_SEPARATOR . 'store' . DIRECTORY_SEPARATOR);
            $user->qrcode = "store/$relativePath";
        }

        if ($request->hasFile('stamp')) {
            // $stampPath = $request->file('stamp')->store('stamps', 'public');
            $stampPath = $request->file('stamp')->move(public_path('store/stamps'), $request->file('stamp')->getClientOriginalName());
            $relativePath = \Illuminate\Support\Str::after($stampPath->getRealPath(), public_path() . DIRECTORY_SEPARATOR . 'store' . DIRECTORY_SEPARATOR);
            $user->stamp = "store/$relativePath";
        }

        if ($request->hasFile('sign')) {
            // $signPath = $request->file('sign')->store('signatures', 'public');
            $signPath = $request->file('sign')->move(public_path('store/signatures'), $request->file('sign')->getClientOriginalName());
            $relativePath = \Illuminate\Support\Str::after($signPath->getRealPath(), public_path() . DIRECTORY_SEPARATOR . 'store' . DIRECTORY_SEPARATOR);
            $user->sign = "store/$relativePath";
        }

        // Update the user details
        $user->g_name = $request->g_name;
        $user->g_mob = $request->g_mob;
        $user->g_gst = $request->g_gst;
        $user->g_email = $request->g_email;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->g_address = $request->g_address;


        // Save the updated user data
        $user->save();

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.edit-page')->with('success', 'Profile updated successfully!');
    }



    public function updateLanguage(Request $request)
    {
        $request->validate([
            'lang' => 'required|string|max:10',
        ]);

        $account = Auth::user();

        // Update language in auth_accounts
        $account->update([
            'lang' => $request->lang,
        ]);


        // Apply immediately
        app()->setLocale($request->lang);
        session(['locale' => $request->lang]);

        return back()->with('success', 'Language updated successfully.');
    }
}
