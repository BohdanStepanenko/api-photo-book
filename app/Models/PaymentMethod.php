<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($payment_method) {
            if (auth()->check()) {
                $payment_method->user_id = auth()->user()->id;
            }

            return response()->json('Unauthorized', 403);
        });
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
