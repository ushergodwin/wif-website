<?php

namespace App\Filament\Resources\BoardOfDirectorResource\Pages;

use App\Filament\Resources\BoardOfDirectorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBoardOfDirector extends EditRecord
{
    protected static string $resource = BoardOfDirectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

