<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    // Menambahkan fillable agar data bisa disimpan
    protected $fillable = [
        'about_description',
        'image_path',
    ];
}
