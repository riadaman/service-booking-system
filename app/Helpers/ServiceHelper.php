<?php

namespace App\Helpers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ServiceHelper 
{
    public static function storeService($request)
    {
        return Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'status' => $request->status,
        ]);
    }
    public static function updateService($service, $request)
    {
       
        // Log::info('Request data:', $request->all());
        // Log::info('Name value:', ['name' => $request->name]);
        
        $service->name = $request->name;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->status = $request->status;
        $service->save();

        return $service;
    }
}