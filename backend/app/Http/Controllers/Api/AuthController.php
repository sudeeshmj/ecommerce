<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function register(CustomerRegisterRequest $request)
    {
        $validatedData = $request->validated();
        $otp = rand(1000, 9999);

        Customer::create([
            'customer_name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'otp' => $otp,
            'otp_created_at' => now()

        ]);
        return ApiResponseHelper::success('Customer created successfully', 201);
    }

    public function CustomerLogin(Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' =>  'required|numeric|digits:10|exists:customers,phone_number',
        ]);

        $otp = rand(1000, 9999);
        $rowsAffected = $this->updateOtp($request->phone_number, $otp);

        if ($rowsAffected) {
            return ApiResponseHelper::success('OTP successfully sent to the user.', 200);
        } else {
            return ApiResponseHelper::error('Failed to send OTP.', 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validatedData = $request->validate([
            'phone_number' =>  'required|numeric|digits:10|',
            'otp' => 'required|numeric|digits:4'
        ]);

        $customer = Customer::where('phone_number', $request->phone_number)
            ->where('otp', $request->otp)
            ->first();

        if (!$customer) {
            return ApiResponseHelper::error('The provided OTP is invalid or has expired.', 422);
        }
        //check otp time
        if ($customer->otp_created_at->diffInMinutes(now()) < 5) {
            //create token
            $token = JWTAuth::fromUser($customer);
            $customer->token = $token;
            // $data = [
            //     'user' => $customer,
            //     'token' => $token
            // ];
            return ApiResponseHelper::success('Successfully validated the OTP.', 200, $customer);
        } else {
            return ApiResponseHelper::error('The provided OTP is invalid or has expired.', 422);
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return ApiResponseHelper::success('Successfully logged out');
    }
    //----------------------helper functions-----------------

    private  function updateOtp($phoneNumber, $otp)
    {
        return Customer::where('phone_number', $phoneNumber)
            ->update(['otp' => $otp, 'otp_created_at' => now()]);
    }
}
