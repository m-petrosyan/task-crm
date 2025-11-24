<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;

class TicketRepository
{
    public static function store(array $attributes, Customer $customer): Ticket
    {
        return $customer->tickets()
            ->create($attributes);
    }
}