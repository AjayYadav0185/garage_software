<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuelTypeResource\Pages;
use App\Models\FuelType;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Actions;

class FuelTypeResource extends Resource
{
    protected static ?string $model = FuelType::class;
    protected static ?string $navigationLabel = 'Fuel Types';
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
   

    public static function form(Form $form): Form
    {
        return $form->schema([
            Components\TextInput::make('carFuel')
                ->label('Fuel Type')
                ->required()
                ->maxLength(255),

            Components\TextInput::make('code')
                ->label('Fuel Code')
                ->maxLength(10),

            Components\Textarea::make('description')
                ->label('Description')
                ->rows(3),

            Components\FileUpload::make('icon')
                ->label('Icon')
                ->image()
                ->directory('fuel-icons')
                ->visibility('public'),

            Components\Toggle::make('status')
                ->label('Active')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('id')->sortable(),
                Columns\TextColumn::make('carFuel')->label('Fuel Type')->sortable()->searchable(),
                Columns\TextColumn::make('code')->label('Code'),
                Columns\IconColumn::make('status')->boolean()->label('Active'),
                Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFuelTypes::route('/'),
            'create' => Pages\CreateFuelType::route('/create'),
            'edit' => Pages\EditFuelType::route('/{record}/edit'),
        ];
    }
}

