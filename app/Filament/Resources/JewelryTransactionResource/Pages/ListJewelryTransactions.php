<?php

namespace App\Filament\Resources\JewelryTransactionResource\Pages;

use App\Filament\Resources\JewelryTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJewelryTransactions extends ListRecords
{
    protected static string $resource = JewelryTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
