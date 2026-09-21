<?php

namespace App\Models;

use App\Models\Desk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = ['user_id', 'desk_id', 'start_time', 'end_time', 'total_price', 'status', 'payment_id'];
    protected $casts = ['start_time' => 'datetime', 'end_time' => 'datetime'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function desk(): BelongsTo
    {
        return $this->belongsTo(Desk::class);
    }
}
