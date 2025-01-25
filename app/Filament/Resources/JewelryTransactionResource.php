<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\JewelryTransaction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JewelryTransactionResource\Pages;
use Filament\Tables\Columns\SelectColumn;  // Use SelectColumn for editable dropdown

class JewelryTransactionResource extends Resource
{
    protected static ?string $model = JewelryTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->options(function () {
                        return \App\Models\User::all()->pluck('name', 'id')->toArray();
                    })
                    ->required(),

                Forms\Components\Select::make('jewelry_id')
                    ->label('Jewelry')
                    ->options(function () {
                        return \App\Models\Jewelry::all()->pluck('name', 'id')->toArray();
                    })
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('sub_total_amount')
                    ->label('Sub Total Amount')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('grand_total_amount')
                    ->label('Grand Total Amount')
                    ->numeric()
                    ->required(),

                Forms\Components\FileUpload::make('proof')
                    ->label('Proof')
                    ->image()
                    ->directory('proofs')
                    ->required(),

                Forms\Components\Select::make('bank_id')
                    ->label('Bank')
                    ->options(function () {
                        return \App\Models\Bank::all()->pluck('name', 'id')->toArray();
                    })
                    ->required(),

                Forms\Components\Toggle::make('is_paid')
                    ->label('Is Paid')
                    ->required(),

                Forms\Components\TextInput::make('transaction_trx_id')
                    ->label('Transaction ID')
                    ->default(fn () => JewelryTransaction::generateUniqueTrxId())
                    ->disabled()
                    ->required(),

                // Add status field
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'processing order' => 'Processing Order',
                        'in delivery' => 'In Delivery',
                        'success' => 'Success',
                    ])
                    ->default('unpaid') // Default status is 'unpaid'
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                ImageColumn::make('proof')
                    ->label('Proof')
                    ->size(50)
                    ->sortable()
                    ->extraAttributes(['class' => 'cursor-pointer'])
                    ->url(fn (JewelryTransaction $record) => $record->proof ? asset('storage/' . $record->proof) : null, true),

                TextColumn::make('user.name')->label('User Name')->sortable(),
                TextColumn::make('transaction_trx_id')->label('Transaction trx id')
                ->sortable()
                ->copyable(),
                TextColumn::make('grand_total_amount')->label('Grand Total')->money('IDR'),

                // Editable status field
                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'checking' => 'Checking',
                        'paid' => 'Paid',
                        'processing order' => 'Processing Order',
                        'in delivery' => 'In Delivery',
                        'success' => 'Success',
                    ])
                    ->sortable()
                    ->searchable()
                    ->default('unpaid')
                    ->action(function (JewelryTransaction $record, $state) {
                        $record->update(['status' => $state]);
                    }),

                ToggleColumn::make('is_paid')
                    ->label('Is Paid')
                    ->sortable()
                    ->onColor('success')
                    ->offColor('danger')
                    ->action(function (JewelryTransaction $record, bool $state): void {
                        $record->update(['is_paid' => $state]);
                    }),
            ])
            ->filters([
                // You can add filters here if needed
            ])
            ->defaultSort('id', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJewelryTransactions::route('/'),
            'create' => Pages\CreateJewelryTransaction::route('/create'),
            'edit' => Pages\EditJewelryTransaction::route('/{record}/edit'),
        ];
    }
}
