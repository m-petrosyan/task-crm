<?php

namespace App\Interfaces;

use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Pagination\LengthAwarePaginator;

interface TicketInterface
{
    public function index(array $filters = []): LengthAwarePaginator;

    public function store(array $attributes, Customer $customer): Ticket;

    public function statistic(): array;

    public function update(Ticket $ticket, array $data): void;
}