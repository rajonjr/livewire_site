<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()
                    ->columns(1)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom de la salle')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        KeyValue::make('coordinates')
                            ->label('Carte / Disposition (JSON)')
                            ->columnSpanFull()
                            ->helperText('Paramétrez les positions ou options graphiques de la pièce'),
                    ])
            ]);
    }
}
