<?php

namespace App\Filament\Resources\JewelrySizeResource\Pages;

use App\Filament\Resources\JewelrySizeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewelrySizes extends ListRecords
{
    protected static string $resource = JewelrySizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
