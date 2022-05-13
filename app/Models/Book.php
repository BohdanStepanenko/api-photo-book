<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($book) {
            if (auth()->check()) {
                $book->user_id = auth()->user()->id;
            }

            return response()->json('Unauthorized', 403);
        });
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function covers()
    {
        return $this->hasMany(Cover::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
