<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'book_id',
        'address_id',
        'quantity',
        'note',
        'amount',
        'status',
        'created_at',
        'updated_at',
        'name',
        'surname',
        'phone',
        'email',
        'full_address',
        'pages',
        'cover_id'
    ];

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

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function books()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
