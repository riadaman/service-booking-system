<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helper\ResponseHelper;
use Illuminate\Support\Facades\Log;

// use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

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
   
}
