<?php

namespace App\Helpers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;

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
}