<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketRepository
{
    public static function index(array $filters = []): LengthAwarePaginator
    {
        return Ticket::query()
            ->with('customer')
            ->when(isset($filters['status']), fn($q) => $q->where('status', $filters['status']))
            ->when(isset($filters['date']), fn($q) => $q->whereDate('created_at', $filters['date']))
            ->when(isset($filters['search']), fn($q) => $q->whereHas('customer', fn($sub) => $sub
                ->where('email', 'like', "%{$filters['search']}%")
                ->orWhere('phone', 'like', "%{$filters['search']}%")
            ))
            ->latest()
            ->paginate(10);
    }


    public static function store(array $attributes, Customer $customer): Ticket
    {
        return $customer->tickets()
            ->create($attributes);
    }
}