<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Services\TicketService;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService,
    ) {
    }

    public function store(TicketCreateRequest $request): Response
    {
        $this->ticketService->store($request->validated());

        return response()->noContent();
    }
}