<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'payment_type',
        'date',
        'user_name',
        'user_email',
    ];

    /**
     * Get the user that owns the point.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // You can add more methods or customizations here as needed
}
