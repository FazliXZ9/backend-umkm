<?php

namespace App\Filament\Widgets;

use App\Models\LoginLog;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestLoginLogs extends BaseWidget
{
    protected static ?string $heading = 'Riwayat Login Terakhir';

    // Atur lebar widget agar memenuhi layar (full width)
    protected int | string | array $columnSpan = 'full';

    // Urutan widget (taruh di bawah statistik angka)
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 atau 10 data terakhir saja agar dashboard tidak berat
                LoginLog::query()->latest('login_at')->limit(5)
            )
            ->columns([
                // Nama User
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->weight('bold'),

                // Email User
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->color('gray'),

                // IP Address
                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->copyable(), // Bisa dicopy

                // Waktu Login (Format "2 minutes ago")
                Tables\Columns\TextColumn::make('login_at')
                    ->label('Waktu Login')
                    ->since()
                    ->dateTimeTooltip(),
            ])
            ->actions([
                // Tidak perlu action edit/delete di sini
            ]);
    }
}
