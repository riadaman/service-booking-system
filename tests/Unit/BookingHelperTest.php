<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\BookingHelper;
use App\Models\Booking;
use App\Models\User;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class BookingHelperTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_booking_creates_booking_successfully()
    {
        
        $user = User::factory()->create();
        $service = Service::factory()->create();
        
        
        $this->actingAs($user);
        
        // Create a mock request
        $request = new Request([
            'service_id' => $service->id,
            'date' => '2025-08-01'
        ]);
        
        
        $booking = BookingHelper::storeBooking($request);
        
        
        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertEquals($user->id, $booking->user_id);
        $this->assertEquals($service->id, $booking->service_id);
        $this->assertEquals('2025-08-01', $booking->booking_date);
        $this->assertEquals('pending', $booking->status);
        
       
        $this->assertDatabaseHas('bookings', [
            'user_id' => $user->id,
            'service_id' => $service->id,
            'booking_date' => '2025-08-01',
            'status' => 'pending'
        ]);
    }
}