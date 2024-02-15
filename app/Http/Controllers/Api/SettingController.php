<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Setting
 */
class SettingController extends Controller
{
    protected $successStatus = 200;

    /**
     * Contact Us
     *
     * This endpoint will be used to contact us.
     *
     * @bodyParam first_name string required First Name of the user. Example: John
     * @bodyParam last_name string required Last Name of the user. Example: Doe
     * @bodyParam email string required Email of the user. Example:
     * @bodyParam phone string required Phone of the user. Example: 9876543210
     * @bodyParam message string required Message of the user. Example: Message
     * @response {
     * "message": "Contact us successfully."
     * 'status': true
     * }
     */

    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => false], 201);
        }

        try {
            $contactUs = new ContactUs();
            $contactUs->candidate_id = $request->user()->id;
            $contactUs->first_name = $request->first_name;
            $contactUs->last_name = $request->last_name;
            $contactUs->email = $request->email;
            $contactUs->phone = $request->phone;
            $contactUs->message = $request->message;
            $contactUs->save();
            return response()->json(['message' => 'Contact us successfully.', 'status' => true], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 401);
        }
    }
}
