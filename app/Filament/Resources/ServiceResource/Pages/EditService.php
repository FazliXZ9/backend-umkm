<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    // Tambahkan fungsi ini untuk redirect ke halaman Index setelah Save Changes
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
