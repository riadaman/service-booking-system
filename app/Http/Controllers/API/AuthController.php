<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
     /**
     * register new user.
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
         try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'user', 
            ]);
            if($user){
             return   ResponseHelper::success(
                    $user,
                    'User registered successfully',
                    'success',
                    201
                );
            }
            return   ResponseHelper::error(
                'User registration failed',
                'error',
                400
                );
        } catch (\Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage() . '-Line: ' . $e->getLine());
             return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }
     public function login(LoginRequest $request)
    {
       try{
            if(!Auth::attempt(['email' => $request->email,'password' => $request->password,])){
                return ResponseHelper::error(
                    'Invalid credentials',
                    'error',
                    401
                );
            }
            $user = Auth::user();
            // dd($user);
            // create a new token for the user
            $token = $user->createToken('auth_token')->plainTextToken;
            return ResponseHelper::success(
                [
                    'user' => $user,
                    'token' => $token
                ],
                'User logged in successfully',
                'success',
                200
            );
       }
         catch (\Exception $e) {
                Log::error('User login failed: ' . $e->getMessage() . '-Line: ' . $e->getLine());
                return ResponseHelper::error(
                 'User login failed',
                 'error',
                 500
                );
          }
    }
    public function userLogout(Request $request)
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return ResponseHelper::success(
                    null,
                    'User logged out successfully',
                    'success',
                    200
                );
            } else {
                return ResponseHelper::error(
                    'User not found',
                    'error',
                    404
                );
            }
        } catch (\Exception $e) {
            Log::error('User logout failed: ' . $e->getMessage() . '-Line: ' . $e->getLine());
            return ResponseHelper::error(
                'User logout failed',
                'error',
                500
            );
        }
    }
   
}
