<?php

namespace App\Filament\Resources\Desks\Pages;

use App\Filament\Resources\Desks\DeskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDesks extends ListRecords
{
    protected static string $resource = DeskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
