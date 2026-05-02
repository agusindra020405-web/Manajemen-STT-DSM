<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;


    protected $fillable = [
        'member_id',
        'month',
        'year',
        'amount',
        'status',
        'midtrans_token'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
