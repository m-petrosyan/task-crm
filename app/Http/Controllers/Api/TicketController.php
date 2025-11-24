<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Models\Ticket;
use App\Repositories\TicketRepository;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService,
    ) {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['status', 'date', 'search']);
        $tickets = TicketRepository::index($filters);

        return view('dashboard.index', compact('tickets'));
    }

    public function show(Ticket $ticket): View
    {
        return view('dashboard.show', compact('ticket'));
    }


    public function store(TicketCreateRequest $request): Response
    {
        $this->ticketService->store($request->validated());

        return response()->noContent();
    }
}