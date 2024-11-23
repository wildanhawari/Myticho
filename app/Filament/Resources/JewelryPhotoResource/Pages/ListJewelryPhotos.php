<?php

namespace App\Filament\Resources\JewelryPhotoResource\Pages;

use App\Filament\Resources\JewelryPhotoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewelryPhotos extends ListRecords
{
    protected static string $resource = JewelryPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
