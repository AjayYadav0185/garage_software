<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarModelResource\Pages;
use App\Models\CarModel;
use App\Models\CarMaker;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Actions;

class CarModelResource extends Resource
{
    protected static ?string $model = CarModel::class;

    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Car Models';

    // -------------------- Form --------------------
    public static function form(Form $form): Form
    {
        return $form->schema([
            Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Components\Select::make('maker_id')
                ->label('Car Maker')
                ->relationship('maker', 'name')
                ->required(),

            Components\TextInput::make('year')
                ->label('Year')
                ->numeric()
                ->required()
                ->minValue(1900)
                ->maxValue(date('Y') + 1),

            Components\Toggle::make('checkin')
                ->label('Checked-in')
                ->default(false),
        ]);
    }

    // -------------------- Table --------------------
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('id')->sortable(),
                Columns\TextColumn::make('name')->sortable()->searchable(),
                Columns\TextColumn::make('maker.name')->label('Maker')->sortable(),
                Columns\TextColumn::make('year')->sortable(),
                Columns\IconColumn::make('checkin')->boolean()->label('Checked-in'),
                Columns\TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // -------------------- Relations --------------------
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // -------------------- Pages --------------------
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCarModels::route('/'),
            'create' => Pages\CreateCarModel::route('/create'),
            'edit' => Pages\EditCarModel::route('/{record}/edit'),
        ];
    }
}
