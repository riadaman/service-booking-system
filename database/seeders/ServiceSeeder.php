<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'House Cleaning', 'description' => 'Professional house cleaning service', 'price' => 50.00],
            ['name' => 'Plumbing Repair', 'description' => 'Expert plumbing repair and maintenance', 'price' => 75.00],
            ['name' => 'Electrical Work', 'description' => 'Licensed electrical installation and repair', 'price' => 80.00],
            ['name' => 'Lawn Mowing', 'description' => 'Regular lawn mowing and maintenance', 'price' => 30.00],
            ['name' => 'Painting Service', 'description' => 'Interior and exterior painting', 'price' => 100.00],
            ['name' => 'Carpet Cleaning', 'description' => 'Deep carpet cleaning service', 'price' => 60.00],
            ['name' => 'HVAC Maintenance', 'description' => 'Heating and cooling system maintenance', 'price' => 90.00],
            ['name' => 'Window Cleaning', 'description' => 'Professional window cleaning', 'price' => 40.00],
            ['name' => 'Appliance Repair', 'description' => 'Home appliance repair service', 'price' => 70.00],
            ['name' => 'Pest Control', 'description' => 'Professional pest control treatment', 'price' => 85.00],
            ['name' => 'Roofing Service', 'description' => 'Roof repair and maintenance', 'price' => 120.00],
            ['name' => 'Flooring Installation', 'description' => 'Professional flooring installation', 'price' => 110.00],
            ['name' => 'Gutter Cleaning', 'description' => 'Gutter cleaning and maintenance', 'price' => 45.00],
            ['name' => 'Pool Cleaning', 'description' => 'Swimming pool cleaning service', 'price' => 55.00],
            ['name' => 'Handyman Service', 'description' => 'General handyman repairs', 'price' => 65.00],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}