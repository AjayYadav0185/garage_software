<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarMakerResource\Pages;
use App\Models\CarMaker;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Actions;

class CarMakerResource extends Resource
{
    protected static ?string $model = CarMaker::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Car Makers';

    // -------------------- Form --------------------
    public static function form(Form $form): Form
    {
        return $form->schema([
            Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Components\Select::make('country_id')
                ->label('Country')
                ->relationship('country', 'name')
                ->required(),

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
                Columns\TextColumn::make('country.name')->label('Country')->sortable(),
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
            'index' => Pages\ListCarMakers::route('/'),
            'create' => Pages\CreateCarMaker::route('/create'),
            'edit' => Pages\EditCarMaker::route('/{record}/edit'),
        ];
    }
}
