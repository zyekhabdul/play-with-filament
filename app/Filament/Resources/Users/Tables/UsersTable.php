<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use PHPUnit\Framework\Reorderable;
use Filament\Actions\ViewAction;


class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                ->sortable(),
                TextColumn::make('user_name')
                ->sortable()
                ->searchable(),
                TextColumn::make('email')
                ->searchable(),
                TextColumn::make('created_at')
                ->dateTime()
                ->toggleable($isToggledHiddenByDefault = true),
                TextColumn::make('updated_at')
                ->dateTime()
                ->toggleable($isToggledHiddenByDefault = true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderableColumns();
    }
}
