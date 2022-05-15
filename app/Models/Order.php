<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
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
        static::creating(function ($order) {
            if (auth()->check()) {
                $order->user_id = auth()->user()->id;
            }

            return response()->json('Unauthorized', 403);
        });
    }

    public function addresses()
    {
        return $this->hasOne(Address::class);
    }

    public function books()
    {
        return $this->hasOne(Book::class);
    }
}
