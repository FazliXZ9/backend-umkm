<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser; // <--- TAMBAHKAN INI
use Filament\Panel;                         // <--- TAMBAHKAN INI

// 2. Tambahkan "implements FilamentUser"
class User extends Authenticatable implements FilamentUser // <--- UBAH BARIS INI
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 3. Tambahkan Fungsi Ini Paling Bawah
    public function canAccessPanel(Panel $panel): bool
    {
        // Return true artinya: Izinkan user ini masuk ke panel admin
        // Anda bisa tambah logika: return $this->email === 'admin@gmail.com';
        return true; 
    }
}
