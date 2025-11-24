<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public static function store(array $attributes): Customer
    {
        return Customer::create($attributes);
    }
}