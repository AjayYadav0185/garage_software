<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CountryResource\Pages;
use App\Models\Country;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Forms\Components;
use Filament\Tables\Table;
use Filament\Tables\Columns;
use Filament\Tables\Actions;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;
 
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
   
    protected static ?string $navigationLabel = 'Countries';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Components\TextInput::make('name')
                ->label('Country Name')
                ->required()
                ->maxLength(255),

            Components\TextInput::make('country_code')
                ->label('Country Code')
                ->required()
                ->numeric()
                ->maxLength(5)
                ->helperText('Enter dialing code without +, e.g., 971 for UAE, 91 for India'),

            Components\TextInput::make('currency')
                ->label('Currency Code')
                ->maxLength(10),

            Components\TextInput::make('language')
                ->label('Primary Language')
                ->maxLength(10),

            Components\TextInput::make('timezone')
                ->label('Default Timezone')
                ->maxLength(50),

            Components\FileUpload::make('flag')
                ->label('Flag')
                ->image() // ensure only images are uploaded
                ->directory('flags') // store in storage/app/public/flags
                ->visibility('public')
                ->imagePreviewHeight('50')
                ->required(false), // optional field

            Components\Toggle::make('active')
                ->label('Active')
                ->default(true),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('id')->sortable(),
                Columns\TextColumn::make('name')->sortable()->searchable(),
                Columns\TextColumn::make('code')->label('ISO Code')->sortable(),
                Columns\TextColumn::make('currency')->label('Currency')->sortable(),
                Columns\TextColumn::make('language')->label('Language')->sortable(),
                Columns\TextColumn::make('timezone')->label('Timezone')->sortable(),
                Columns\IconColumn::make('active')->boolean()->label('Active'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
