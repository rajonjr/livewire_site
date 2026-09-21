<?php

namespace App\Filament\Resources\Desks\Pages;

use App\Filament\Resources\Desks\DeskResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDesk extends EditRecord
{
    protected static string $resource = DeskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
