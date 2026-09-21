<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
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
                Select::make('desk_id')
                    ->label('Bureau')
                    ->relationship('desk', 'code')
                    ->required()
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('start_time')
                    ->label('Heure de début')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->label('Heure de fin')
                    ->required(),
                TextInput::make('total_price')
                    ->label('Prix total')
                    ->numeric()
                    ->prefix('€')
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'paid' => 'Payé',
                        'cancelled' => 'Annulé',
                    ])
                    ->default('pending')
                    ->required(),
                TextInput::make('payment_id')
                    ->label('ID de paiement (Stripe)')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}
