<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCreateRequest;
use App\Http\Resources\Tocket\TicketResource;
use App\Repositories\TicketRepository;
use App\Services\TicketService;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    public function __construct(
        protected TicketService $ticketService,
        protected TicketRepository $ticketRepository,
    ) {
    }

    public function store(TicketCreateRequest $request): Response
    {
        $this->ticketService->store($request->validated());

        return response()->noContent();
    }

    public function statistics(): TicketResource
    {
        return new TicketResource($this->ticketRepository->statistic());
    }
}