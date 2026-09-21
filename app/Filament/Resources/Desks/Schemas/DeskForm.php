<?php

namespace App\Filament\Resources\Desks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DeskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('room_id')
                    ->label('Salle')
                    ->relationship('room', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('code')
                    ->label('Code / Numéro du bureau')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Type de bureau')
                    ->options([
                        'standard' => 'Standard',
                        'premium' => 'Premium',
                        'box' => 'Box Fermé',
                    ])
                        ->default('standard')
                        ->required(),
                TextInput::make('hourly_rate')
                    ->label('Tarif horaire')
                    ->numeric()
                    ->prefix('€')
                    ->default(5.00)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Actif / Disponible')
                    ->default(true)
                    ->required(),
            ]);
    }
}
