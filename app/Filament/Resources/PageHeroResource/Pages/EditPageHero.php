<?php

namespace App\Filament\Resources\PageHeroResource\Pages;

use App\Filament\Resources\PageHeroResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPageHero extends EditRecord
{
    protected static string $resource = PageHeroResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

