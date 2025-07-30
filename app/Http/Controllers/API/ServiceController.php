<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Helpers\ServiceHelper;
use Illuminate\Support\Facades\Log;
use App\Models\Service;

class ServiceController extends Controller
{
    
   public function create(ServiceRequest $request)
    {
        try {
            // Check if authenticated user is admin
            if (auth()->user()->role !== 'admin') {
                return ResponseHelper::error(
                    'You are not authorized to perform this action',
                    'unauthorized',
                    403
                );
            }

            // Store the service using helper
            $service = ServiceHelper::storeService($request);

            if ($service) {
                return ResponseHelper::success(
                    $service,
                    'Service added successfully',
                    'success',
                    201
                );
            }

            return ResponseHelper::error(
                'Failed to add service',
                'error',
                400
            );
        } catch (\Exception $e) {
            Log::error('Service addition failed: ' . $e->getMessage() . ' - Line: ' . $e->getLine());

            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            // Check if authenticated user is admin
            if (auth()->user()->role !== 'admin') {
                return ResponseHelper::error(
                    'You are not authorized to perform this action',
                    'unauthorized',
                    403
                );
            }

            // Debug: Log all input
            Log::info('All input:', $request->all());
            Log::info('JSON input:', $request->json()->all());

            // Find the service by ID
            $service = Service::findOrFail($id);

            // Update the service using helper
            $updatedService = ServiceHelper::updateService($service, $request);

            return ResponseHelper::success(
                $updatedService,
                'Service updated successfully',
                'success',
                200
            );
        } catch (\Exception $e) {
            Log::error('Service update failed: ' . $e->getMessage() . ' - Line: ' . $e->getLine());

            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
        
    }
    public function delete($id)
    {
        try {
            // Check if authenticated user is admin
            if (auth()->user()->role !== 'admin') {
                return ResponseHelper::error(
                    'You are not authorized to perform this action',
                    'unauthorized',
                    403
                );
            }

            // Delete the service using helper
            $deletedService = ServiceHelper::deleteService($id);

            return ResponseHelper::success(
                $deletedService,
                'Service deleted successfully',
                'success',
                200
            );
        } catch (\Exception $e) {
            Log::error('Service deletion failed: ' . $e->getMessage() . ' - Line: ' . $e->getLine());

            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ], 500);
        }
    }
}