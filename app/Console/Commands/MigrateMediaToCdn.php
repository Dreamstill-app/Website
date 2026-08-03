<?php

namespace App\Console\Commands;

use App\Models\CommunityTip;
use App\Models\SortImage;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * One-off: copy media from the private local disk to the Azure CDN container,
 * keeping the same relative paths (URLs resolve via config afterwards).
 */
class MigrateMediaToCdn extends Command
{
    protected $signature = 'sorty:migrate-media-to-cdn {--dry-run}';

    protected $description = 'Copy local media (sort images, avatars, tip photos) to the Azure CDN disk';

    public function handle(): int
    {
        $local = Storage::disk('local');
        $azure = Storage::disk('azure');
        $dry = (bool) $this->option('dry-run');

        $paths = collect()
            ->merge(SortImage::query()->pluck('path'))
            ->merge(User::query()->whereNotNull('avatar_path')->pluck('avatar_path'))
            ->merge(CommunityTip::query()->whereNotNull('image_path')->pluck('image_path'))
            ->filter()
            ->unique();

        $copied = 0;
        $missing = 0;
        $skipped = 0;

        foreach ($paths as $path) {
            if (! $local->exists($path)) {
                $missing++;

                continue;
            }

            if ($azure->exists($path)) {
                $skipped++;

                continue;
            }

            if (! $dry) {
                $azure->put($path, $local->get($path));
            }

            $copied++;

            if ($copied % 25 === 0) {
                $this->info("… {$copied} copied");
            }
        }

        $this->info(($dry ? '[dry-run] ' : '')."Copied {$copied}, already present {$skipped}, missing locally {$missing} (of {$paths->count()} tracked files).");

        return self::SUCCESS;
    }
}
