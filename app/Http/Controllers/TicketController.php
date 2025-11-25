<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\TicketIndexRequest;
use App\Http\Requests\Ticket\TicketUpdateRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use App\Services\TicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController
{
    public function __construct(
        protected TicketService $ticketService,
        protected TicketRepository $ticketRepository
    ) {
    }

    public function index(TicketIndexRequest $request): View
    {
        $tickets = $this->ticketRepository->index($request->validated());

        return view('dashboard.index', compact('tickets'));
    }

    public function show(Ticket $ticket): View
    {
        return view('dashboard.show', compact('ticket'));
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket): RedirectResponse
    {
        $this->ticketService->update($ticket, $request->validated());

        return back()->with('success', 'Ticket status updated successfully.');
    }
}