<?php

namespace App\Repositories;

use App\Interfaces\CustomerInterface;
use App\Models\Customer;

class CustomerRepository implements CustomerInterface
{
    public function store(array $attributes): Customer
    {
        return Customer::create($attributes);
    }
}