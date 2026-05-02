<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'address', 'status'];

    public function contributions()
    {
        // Satu anggota punya banyak riwayat iuran
        return $this->hasMany(Contribution::class, 'member_id');
    }
}
