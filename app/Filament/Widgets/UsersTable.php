<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\Users\UserResource as UsersUserResource;
// use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class UsersTable extends TableWidget
{
    protected int|string|array $columnSpan = [
        'xl' => 5,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => User::query()->latest())
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->headerActions([
                Action::make('create')
                    ->label('Tambah User')
                    ->icon('heroicon-m-plus')
                    ->url(UsersUserResource::getUrl('create')), // /admin/users/create
            ])
            ->recordActions([
                // EDIT → arahkan ke halaman edit UserResource
                ActionsEditAction::make()
                    ->url(fn (User $record) => UsersUserResource::getUrl('edit', ['record' => $record])),

                // HAPUS
                ActionsDeleteAction::make()
                    ->hidden(fn (User $record) => Filament::auth()->id() === $record->id)
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Data User berhasil dihapus!')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    ActionsDeleteBulkAction::make()
                        ->label('Hapus yang dipilih'),
                ]),
            ])
            ->paginated([5, 10, 25])
            ->defaultPaginationPageOption(5);
    }
}
