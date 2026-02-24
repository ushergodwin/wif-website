<?php

namespace App\Console\Commands;

use App\Models\GalleryItem;
use App\Models\Project;
use Illuminate\Console\Command;

class MigrateGalleryImages extends Command
{
    protected $signature   = 'gallery:migrate-from-projects {--dry-run : Preview what would be inserted without writing to the database}';
    protected $description = 'Copy images from projects.gallery_images JSON into the gallery_items table';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn('DRY RUN — nothing will be written.');
        }

        $projects = Project::whereNotNull('gallery_images')
            ->where('gallery_images', '!=', '[]')
            ->get(['id', 'title', 'gallery_images']);

        if ($projects->isEmpty()) {
            $this->info('No projects with gallery_images found.');
            return self::SUCCESS;
        }

        $inserted = 0;
        $skipped  = 0;

        foreach ($projects as $project) {
            $images = is_array($project->gallery_images) ? $project->gallery_images : [];

            if (empty($images)) {
                continue;
            }

            $this->line("→ <fg=cyan>{$project->title}</> ({$project->id}) — " . count($images) . ' image(s)');

            foreach ($images as $order => $imagePath) {
                // Skip if already imported (match on project_id + image path)
                $exists = GalleryItem::where('project_id', $project->id)
                    ->where('image', $imagePath)
                    ->exists();

                if ($exists) {
                    $this->line("    <fg=yellow>SKIP</> {$imagePath} (already exists)");
                    $skipped++;
                    continue;
                }

                $this->line("    <fg=green>INSERT</> {$imagePath}");

                if (!$dryRun) {
                    GalleryItem::create([
                        'project_id' => $project->id,
                        'image'      => $imagePath,
                        'is_active'  => true,
                        'order'      => $order,
                    ]);
                }

                $inserted++;
            }
        }

        $this->newLine();

        if ($dryRun) {
            $this->warn("DRY RUN complete — {$inserted} would be inserted, {$skipped} would be skipped.");
        } else {
            $this->info("Done — {$inserted} inserted, {$skipped} skipped.");
        }

        return self::SUCCESS;
    }
}
