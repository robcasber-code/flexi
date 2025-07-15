<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    public function createOrUpdate(array $data): Customer
    {
        return Customer::updateOrCreate(
            ['email' => $data['email']],
            $data
        );
    }

    public function getAll(): Collection
    {
        return Customer::select('first_name', 'last_name', 'email', 'country')->get();
    }

    public function findById(int $id): ?Customer
    {
        return Customer::findOrFail($id);
    }
}
