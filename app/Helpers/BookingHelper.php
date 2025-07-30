<?php

namespace App\Helpers;

use App\Http\Requests\ServiceRequest;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BookingHelper 
{
    public static function storeBooking($request)
    {
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'booking_date' => $request->date,
            'status' => 'pending',
        ]);
        return $booking;
    }
    
}