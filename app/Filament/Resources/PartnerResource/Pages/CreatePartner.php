<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use App\Models\Partner;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // Extract logos from data
        $logos = $data['logo'] ?? [];
        unset($data['logo']);

        // If it's a single logo (string), convert to array
        if (!is_array($logos)) {
            $logos = [$logos];
        }

        // Filter out empty logos
        $logos = array_filter($logos);

        // If multiple logos, create a partner record for each
        if (count($logos) > 1) {
            $createdCount = 0;
            $firstRecord = null;
            
            foreach ($logos as $logo) {
                if (empty($logo)) {
                    continue;
                }

                // Extract filename from path and use as name
                $filename = basename($logo);
                $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
                // Clean up the name: remove special chars, replace underscores/hyphens with spaces, title case
                $name = Str::title(str_replace(['_', '-'], ' ', $nameWithoutExt));

                $partner = Partner::create([
                    'name' => $name ?: null,
                    'logo' => $logo,
                    'is_active' => $data['is_active'] ?? true,
                    'order' => $data['order'] ?? 0,
                ]);
                
                if ($createdCount === 0) {
                    $firstRecord = $partner;
                }
                $createdCount++;
            }

            // Show notification
            Notification::make()
                ->title('Success')
                ->body("Created {$createdCount} partner(s) from uploaded logos.")
                ->success()
                ->send();

            // Return the first record (will be used for redirect, but we've already created all)
            return $firstRecord ?? Partner::make();
        } else {
            // Single logo - use filename as name if name is not provided
            $logo = $logos[0] ?? null;
            if (empty($data['name']) && !empty($logo)) {
                $filename = basename($logo);
                $nameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
                $data['name'] = Str::title(str_replace(['_', '-'], ' ', $nameWithoutExt)) ?: null;
            }

            $data['logo'] = $logo;
            return static::getModel()::create($data);
        }
    }
}

