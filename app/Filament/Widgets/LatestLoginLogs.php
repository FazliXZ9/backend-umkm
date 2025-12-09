<?php

namespace App\Filament\Widgets;

use App\Models\LoginLog;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestLoginLogs extends BaseWidget
{
    protected static ?string $heading = 'Riwayat Login Terakhir';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LoginLog::query()->latest('login_at')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->copyable(), 

                Tables\Columns\TextColumn::make('login_at')
                    ->label('Waktu Login')
                    ->since()
                    ->dateTimeTooltip(),
            ])
            ->actions([
            ]);
    }
}
