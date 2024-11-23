<?php

namespace App\Filament\Resources\JewelryResource\Pages;

use App\Filament\Resources\JewelryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewelries extends ListRecords
{
    protected static string $resource = JewelryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
