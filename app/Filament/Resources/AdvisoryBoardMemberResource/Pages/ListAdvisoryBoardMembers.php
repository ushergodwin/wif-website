<?php

namespace App\Filament\Resources\AdvisoryBoardMemberResource\Pages;

use App\Filament\Resources\AdvisoryBoardMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvisoryBoardMembers extends ListRecords
{
    protected static string $resource = AdvisoryBoardMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

