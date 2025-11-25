<?php

namespace App\Interfaces;

use App\Models\Customer;

interface CustomerInterface
{
    public function store(array $attributes): Customer;
}