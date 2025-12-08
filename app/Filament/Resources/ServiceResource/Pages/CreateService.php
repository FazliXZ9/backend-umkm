<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    // Tambahkan fungsi ini untuk redirect ke halaman Index setelah Save
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
