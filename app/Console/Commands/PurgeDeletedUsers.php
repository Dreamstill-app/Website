<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Media\ImageStorage;
use Illuminate\Console\Command;

/**
 * PIPEDA retention window: accounts soft-deleted via DELETE /me are held for
 * 30 days, then permanently purged — DB rows (cascades cover sorts, chats,
 * claims, progress) and every stored image.
 */
class PurgeDeletedUsers extends Command
{
    protected $signature = 'sorty:purge-deleted-users {--days=30}';

    protected $description = 'Hard-delete accounts past the soft-delete retention window';

    public function handle(ImageStorage $images): int
    {
        $cutoff = now()->subDays((int) $this->option('days'));

        $users = User::onlyTrashed()
            ->where('deleted_at', '<=', $cutoff)
            ->get();

        foreach ($users as $user) {
            // Remove stored media before the rows disappear.
            $images->deleteDirectory("sorts/{$user->id}");
            $images->deleteDirectory("avatars/{$user->id}");
            $images->deleteDirectory("tips/{$user->id}");
            $images->deleteDirectory("chat/{$user->id}");

            if ($user->avatar_path !== null) {
                $images->delete($user->avatar_path);
            }

            $user->forceDelete();
            $this->info("Purged user #{$user->id}");
        }

        $this->info("Done — {$users->count()} account(s) purged.");

        return self::SUCCESS;
    }
}
