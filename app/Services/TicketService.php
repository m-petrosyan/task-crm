<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;

class TicketService
{
    public function __construct(
        protected CustomerRepository $customerRepository,
        protected TicketRepository $ticketRepository
    ) {
    }

    public function store(array $attributes): void
    {
        $customer = $this->customerRepository->store([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
        ]);

        $ticket = $this->ticketRepository->store([
            'subject' => $attributes['subject'],
            'text' => $attributes['text'],
        ],
            $customer
        );

        if (isset($attributes['file'])) {
            $ticket->addMedia($attributes['file'])->toMediaCollection('attachments');
        }
    }

    public function update(Ticket $ticket, array $attributes): void
    {
        $this->ticketRepository->update($ticket, $attributes);
    }
}