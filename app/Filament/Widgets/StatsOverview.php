<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use App\Models\CompanyProfile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Layanan', Service::count())
                ->description('Item layanan yang terdaftar')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success') 
                ->chart([7, 2, 10, 3, 15, 4, 17]), 

            Stat::make('Total Kategori', Service::distinct('category')->count())
                ->description('Variasi jenis layanan')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'), 

            Stat::make('Update Terakhir', CompanyProfile::latest('updated_at')->first()?->updated_at->diffForHumans() ?? 'Belum ada')
                ->description('Waktu perubahan profil')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'), 
        ];
    }
}
