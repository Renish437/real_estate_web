<?php

namespace App\Filament\Resources\MailSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MailSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mail_mailer')
                    ->searchable(),
                TextColumn::make('mail_host')
                    ->searchable(),
                TextColumn::make('mail_port')
                    ->searchable(),
                TextColumn::make('mail_username')
                    ->searchable(),
                TextColumn::make('mail_encryption')
                    ->searchable(),
                TextColumn::make('mail_from_address')
                    ->searchable(),
                TextColumn::make('mail_from_name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
