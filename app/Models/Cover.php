<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
