<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
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
                TextInput::make('invoice_number')
                    ->label('Numéro de facture')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('amount')
                    ->label('Montant')
                    ->numeric()
                    ->prefix('€')
                    ->required(),
                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'unpaid' => 'Impayée',
                        'paid' => 'Payée',
                    ])
                    ->default('unpaid')
                    ->required(),
                DateTimePicker::make('due_date')
                    ->label('Date d\'échéance')
                    ->required(),
            ]);
    }
}
