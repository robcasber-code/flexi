<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\CustomerRepository;
use App\Http\Resources\RandomUserResource;
class CustomerService
{
    public function __construct(
        protected CustomerRepository $customerRepository
    ) {}

    public function import(int $count): int
    {
        $response = Http::withoutVerifying()->get('https://randomuser.me/api/', [
            'nat' => 'au',
            'results' => $count,
        ]);

        if (!$response->successful()) {
            throw new \Exception('Failed to fetch data from API.');
        }

        $users = $response->json('results');
        $imported = 0;

        foreach ($users as $user) {
            $data = RandomUserResource::transform($user);
            $this->customerRepository->createOrUpdate($data);
            $imported++;
        }

        return $imported;
    }

     public function getAllCustomers()
    {
        return $this->customerRepository->getAll();
    }

    public function getCustomerById(int $id)
    {
        return $this->customerRepository->findById($id);
    }
}
