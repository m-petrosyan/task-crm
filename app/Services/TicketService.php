<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;

class TicketService
{

    public function store(array $attributes): void
    {
        $customer = CustomerRepository::store([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'phone' => $attributes['phone'],
        ]);

        $ticket = TicketRepository::store([
            'subject' => $attributes['subject'],
            'text' => $attributes['text'],
        ],
            $customer
        );
 

        if ($attributes['file']) {
            $ticket->addMedia($attributes['file'])->toMediaCollection('attachments');
        }
    }
}