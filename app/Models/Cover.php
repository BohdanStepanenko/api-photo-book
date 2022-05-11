<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'path'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($cover) {
            if (auth()->check()) {
                $cover->user_id = auth()->user()->id;
            }

            return response()->json('Unauthorized', 403);
        });
    }

    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
