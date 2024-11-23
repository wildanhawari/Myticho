<?php

namespace App\Filament\Resources\JewelryResource\Pages;

use App\Filament\Resources\JewelryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJewelry extends EditRecord
{
    protected static string $resource = JewelryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
