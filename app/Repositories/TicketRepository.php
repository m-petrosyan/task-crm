<?php

namespace App\Repositories;

use App\Interfaces\TicketInterface;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketRepository implements TicketInterface
{
    public function index(array $filters = []): LengthAwarePaginator
    {
        return Ticket::query()
            ->with('customer')
            ->when(isset($filters['status']), fn($q) => $q->where('status', $filters['status']))
            ->when(isset($filters['date']), fn($q) => $q->whereDate('created_at', $filters['date']))
            ->when(isset($filters['search']), fn($q) => $q->whereHas('customer', fn($sub) => $sub
                ->whereAny(['email', 'phone'], 'like', "%{$filters['search']}%")
            ))
            ->latest()
            ->paginate(10);
    }

    public function statistic(): array
    {
        return [
            'day' => Ticket::query()->daily()->count(),
            'week' => Ticket::query()->weekly()->count(),
            'month' => Ticket::query()->monthly()->count(),
        ];
    }


    public function store(array $attributes, Customer $customer): Ticket
    {
        return $customer->tickets()
            ->create($attributes);
    }

    public function update(Ticket $ticket, array $data): void
    {
        $data['manager_reply_at'] = now();

        $ticket->update($data);
    }
}