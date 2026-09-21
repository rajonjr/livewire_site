<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('plan_name')
                    ->label('Nom du plan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->label('Prix')
                    ->numeric()
                    ->prefix('€')
                    ->required(),
                DateTimePicker::make('starts_at')
                    ->label('Date de début')
                    ->required(),
                DateTimePicker::make('ends_at')
                    ->label('Date de fin')
                    ->required(),
                TextInput::make('status')
                    ->label('Statut')
                    ->default('active')
                    ->required(),
            ]);
    }
}
