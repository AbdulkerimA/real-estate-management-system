<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        return view('agents.settings.index',[
            'user' => $user,
        ]);
    }

    public function adminIndex()
    {
        $user = Auth::user();

        // Ensure settings exist
        if (! $user->settings) {
            Setting::create([
                'user_id' => $user->id,
            ]);
        }

        return view('admin.settings', compact('user'));
    }
    // toggle updates
    public function Update(Request $request){

        // return json_encode($request->all()); // for js requests debuging    
        
        $user = Auth::user();
        
        $validatedOption = $request->validate([
            'setting' => 'required|string',
            'value' => 'required|boolean',
        ]);

        // return json_encode($validatedOption);

        // update setting option
        if($validatedOption){
            if($validatedOption['setting'] == 'email_authentication'){
                $user->settings()->firstOrCreate(['user_id' => $user->id]);
                $user->settings->update([
                    'two_factor_authentication' => $validatedOption['value'],
                ]);
            }

            if($validatedOption['setting'] == "deactivated"){
                $user->settings()->firstOrCreate(['user_id' => $user->id]);
                $user->settings->update([
                    $validatedOption['setting'] => $validatedOption['value'],
                ]);
                 return response()->json([
                    'message' => 'logout',
                    'status' => $validatedOption['value'],
                ]);
            }
            $response = $user->settings->update([
                $validatedOption['setting'] => $validatedOption['value'],
            ]);

            return response()->json([
                'message' => 'Preference updated successfully.',
                'status' => $validatedOption['value'],
            ]);


            // user preference
            if ($user->settings) {
                $user->settings->update([
                    $validatedOption['setting'] => $validatedOption['value'],
                ]);

                return response()->json([
                    'message' => ucfirst(str_replace('_', ' ', $validatedOption['setting'])) . ' updated successfully.',
                    'status' => $validatedOption['value'],
                ]);
            }
        }
    }

    // update admin account info

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->update($request->only('name','email','phone'));

        return response()->json([
            'success' => true,
            'message' => 'Account updated successfully'
        ]);
    }

    // update admin password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 422);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    }

    public function destroy(Request $request)
    {
        //
        // return json_encode(['msg'=>"it's working"]);
        try {
            // Delete the record
            Auth::user()->delete();

            // Return success response (for AJAX)
            return response()->json([
                'success' => true,
                'message' => 'Setting deleted successfully.'
            ]);

        } catch (\Exception $e) {
            // Handle error and return proper message
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete setting: ' . $e->getMessage()
            ], 500);
        }
    }
}
