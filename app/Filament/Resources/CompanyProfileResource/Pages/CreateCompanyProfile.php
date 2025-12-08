<?php

namespace App\Filament\Resources\CompanyProfileResource\Pages;

use App\Filament\Resources\CompanyProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCompanyProfile extends CreateRecord
{
    protected static string $resource = CompanyProfileResource::class;

    // Tambahkan fungsi ini agar setelah 'Create' balik ke tabel list
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
