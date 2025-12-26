<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\Student;
use Filament\Actions\BulkAction;
use Illuminate\Support\Collection;


class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(components: [
                TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Name'),
                TextColumn::make('class')
                ->searchable()
                ->sortable()
                ->label('Class'),
                TextColumn::make('address')
                ->columnSpanFull()
                ->wrap(),
                TextColumn::make('phone_number'),
                TextColumn::make('is_active')
                ->label('Status')
    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif')
    ->badge()
    ->color(fn ($state) => $state ? 'success' : 'danger')
    ->sortable()
    ->searchable()
    ->toggleable(),
                TextColumn::make('created_at')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->toggleable(isToggledHiddenByDefault: true),


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

                BulkAction::make('deactivate')
    ->label('Nonaktifkan')
    ->icon('heroicon-o-x-circle')
    ->color('danger')
    ->requiresConfirmation()
    ->modalHeading('Nonaktifkan Siswa')
    ->modalDescription('Apakah Anda yakin ingin menonaktifkan siswa ini?')
    ->modalSubmitActionLabel('Ya, Nonaktifkan')
    ->modalCancelActionLabel('Batal')
    ->action(function (Collection $records) {
        $records->each->update(['is_active' => false]);

        Notification::make()
            ->title('Siswa dinonaktifkan')
            ->body('Siswa terpilih berhasil dinonaktifkan.')
            ->success()
            ->send();
    }),

                BulkAction::make('activate')
    ->label('Aktifkan Kembali')
    ->icon('heroicon-o-check-circle')
    ->color('success')
    ->requiresConfirmation()
    ->action(function (Collection $records) {
        $records->each->update(['is_active' => true]);

        Notification::make()
            ->title('Siswa diaktifkan')
            ->body('Siswa terpilih berhasil diaktifkan kembali.')
            ->success()
            ->send();
    }),

                ]),



            ])
            ->reorderableColumns();
    }
}
