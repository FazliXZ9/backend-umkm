<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Tambahkan bagian ini agar data bisa disimpan
    protected $fillable = [
        'title',
        'category',
        'description',
        'image_path',
        'price', // Tambahkan jika Anda sudah menambahkan kolom price di database
    ];
}
