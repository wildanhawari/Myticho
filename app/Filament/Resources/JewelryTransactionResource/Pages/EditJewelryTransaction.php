<?php

namespace App\Filament\Resources\JewelryTransactionResource\Pages;

use App\Filament\Resources\JewelryTransactionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJewelryTransaction extends EditRecord
{
    protected static string $resource = JewelryTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
