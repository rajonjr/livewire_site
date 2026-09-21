<?php

namespace App\Filament\Resources\Desks;

use App\Filament\Resources\Desks\Pages\CreateDesk;
use App\Filament\Resources\Desks\Pages\EditDesk;
use App\Filament\Resources\Desks\Pages\ListDesks;
use App\Filament\Resources\Desks\Schemas\DeskForm;
use App\Filament\Resources\Desks\Tables\DesksTable;
use App\Models\Desk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DeskResource extends Resource
{
    protected static ?string $model = Desk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ComputerDesktop;

    protected static string |UnitEnum| null $navigationGroup = 'Gestion des Espaces';

    // protected static ?string $modelLabel = 'Bureau';
    // protected static ?string $pluralModelLabel = 'Bureaux';

    public static function form(Schema $schema): Schema
    {
        return DeskForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DesksTable::configure($table);
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
            'index' => ListDesks::route('/'),
            'create' => CreateDesk::route('/create'),
            'edit' => EditDesk::route('/{record}/edit'),
        ];
    }
}
