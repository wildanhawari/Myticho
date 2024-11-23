<?php

namespace App\Filament\Resources\JewelryPhotoResource\Pages;

use App\Filament\Resources\JewelryPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJewelryPhoto extends EditRecord
{
    protected static string $resource = JewelryPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
