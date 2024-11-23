<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Jewelry;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\JewelryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JewelryResource\RelationManagers;

class JewelryResource extends Resource
{
    protected static ?string $model = Jewelry::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->required()
                ->image(),

                TextInput::make('about')
                ->required()
                ->maxLength(255),

                TextInput::make('price')
                ->required()
                ->numeric(),

                Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Select::make('is_popular')
                ->options([
                    true => 'Popular',
                    false => 'Not Popular',
                ])
                ->required(),

                TextInput::make('stock')
                ->required()
                ->numeric(),

                Select::make('is_sold')
                ->options([
                    true => 'Sold',
                    false => 'Not Sold',
                ])
                ->required(),

                Repeater::make('jewelryPhotos')
                ->relationship('jewelryPhotos')
                ->schema([
                    FileUpload::make('photo')
                    ->required()
                    ->image(),
                ]),

                Repeater::make('jewelrySizes')
                ->relationship('jewelrySizes')
                ->schema([
                    TextInput::make('size')
                    ->required()
                    ->numeric(),
                ]),

                // Repeater::make('jewelrySizes')
                // ->schema([
                //     TextInput::make('jewelrySize_id')
                //     ->relationship('jewelrySizes', 'size')
                //     ->searchable()
                //     ->preload()
                //     ->required(),
                // ]),

                // Repeater::make('jewelrySizes')
                // ->schema([
                //     Select::make('size')
                //     ->searchable()
                //     ->preload()
                //     ->required(),
                // ]),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail'),

                TextColumn::make('name')
                ->searchable(),


                TextColumn::make('price')
                ->money('IDR'),

                TextColumn::make('jewelrySizes.size'),

                TextColumn::make('stock'),

                TextColumn::make('category.name')
                ->searchable(),

                IconColumn::make('is_popular')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Popular'),






            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJewelries::route('/'),
            'create' => Pages\CreateJewelry::route('/create'),
            'edit' => Pages\EditJewelry::route('/{record}/edit'),
        ];
    }
}
