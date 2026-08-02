<?php

namespace App\Filament\Resources\CommunityTips\Tables;

use App\Models\CommunityTip;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CommunityTipsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable(),
                TextColumn::make('text')
                    ->wrap()
                    ->limit(120)
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        default => 'danger',
                    }),
                TextColumn::make('moderation_reason')
                    ->label('Moderation note')
                    ->placeholder('—')
                    ->limit(50)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime('M j, g:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (CommunityTip $record): bool => $record->status !== 'approved')
                    ->action(fn (CommunityTip $record) => $record->update([
                        'status' => 'approved',
                        'moderation_source' => 'admin',
                    ])),
                Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (CommunityTip $record): bool => $record->status !== 'rejected')
                    ->requiresConfirmation()
                    ->action(fn (CommunityTip $record) => $record->update([
                        'status' => 'rejected',
                        'moderation_source' => 'admin',
                    ])),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
