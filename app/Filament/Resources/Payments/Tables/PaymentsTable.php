<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('feeBill.payment_status')
                    ->label('Payment Status'),
                TextColumn::make('user.name')
                    ->label('Recorded By'),
                TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date(),
                TextColumn::make('amount_paid')
                    ->label('Amount Paid')
                    ->money('idr', true),
                TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(50),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                // IconColumn::make('is_confirmed')
                //     ->label('Confirmed')
                //     ->boolean(),
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
            ->reorderable();
    }
}
