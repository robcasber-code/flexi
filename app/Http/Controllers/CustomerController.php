<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerListResource;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerImportRequest;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Import customers from API.
     *
     * @param CustomerImportRequest $request
     * @return JsonResponse
     */
    public function import(CustomerImportRequest $request): JsonResponse
    {
        $count = $request->input('count', 100);

        try {
            $importedCount = $this->customerService->import($count);

            return response()->json([
                'success' => true,
                'message' => "Imported {$importedCount} Australian customers successfully.",
            ]);
        } catch (\Exception $e) {
            \Log::error('Customer import failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to import customers. Please try again later.',
            ], 500);
        }
    }

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getAllCustomers();
        return response()->json(CustomerListResource::collection($customers));
    }

    public function show(int $customerId): JsonResponse
    {
        $customer = $this->customerService->getCustomerById($customerId);
        return response()->json(new CustomerResource($customer));
    }
}
