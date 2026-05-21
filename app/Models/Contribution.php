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
        'payment_method',
        'reference_id',
        'xendit_invoice_id',
        'checkout_url',
        'xendit_response',
        'reason_cancel',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
