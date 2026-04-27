<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar kolom bisa diisi
    protected $fillable = ['nama', 'telepon', 'alamat', 'status'];
}