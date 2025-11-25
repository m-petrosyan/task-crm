<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'customer_id',
        'subject',
        'text',
        'status',
        'manager_reply_at',
    ];

    protected $casts = [
        'manager_reply_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    #[Scope]
    public function weekly(Builder $query): void
    {
        $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    #[Scope]
    public function daily(Builder $query): void
    {
        $query->whereDate('created_at', today());
    }

    #[Scope]
    public function monthly(Builder $query): void
    {
        $query->whereMonth('created_at', now()->month);
    }
}
