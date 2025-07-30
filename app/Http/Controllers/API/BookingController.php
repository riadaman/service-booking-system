<?php

namespace App\Http\Controllers\API;

use App\Helpers\BookingHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function createBooking(BookingRequest $request)
    {
        try {
            
            $booking = BookingHelper::storeBooking($request);

            if($booking){
             return   ResponseHelper::success(
                    $booking,
                    'Booking Created successfully',
                    'success',
                    201
                );
            }
            return   ResponseHelper::error(
                'Booking failed',
                'error',
                400
                );
        } catch (\Exception $e) {
            Log::error('Booking creation failed: ' . $e->getMessage() . ' - Line: ' . $e->getLine());

            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }   
}
