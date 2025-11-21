<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(){
        $user = Auth::user();
        
        return view('agents.settings.index',[
            'user' => $user,
        ]);
    }

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
                $user->settings->update([
                    'two_factor_authentication' => $validatedOption['value'],
                ]);
            }

            if($validatedOption['setting'] == "deactivated"){
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
        }
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
