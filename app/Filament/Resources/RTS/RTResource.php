<?php

namespace App\Filament\Resources\RTS;

use App\Filament\Resources\RTS\Pages\CreateRT;
use App\Filament\Resources\RTS\Pages\EditRT;
use App\Filament\Resources\RTS\Pages\ListRTS;
use App\Filament\Resources\RTS\Schemas\RTForm;
use App\Filament\Resources\RTS\Tables\RTSTable;
use App\Models\RTModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class RTResource extends Resource
{
    protected static ?string $model = RTModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'no_rt';
    // AWAL RENOVASI MANUAL

    protected static UnitEnum|string|null $navigationGroup = 'Wilayah';

    protected static ?string $navigationLabel = 'RT';

    protected static ?string $modelLabel = 'RT';

    protected static ?string $pluralModelLabel = 'RT';

    // AKHIR RENOVASI MANUAL

    public static function form(Schema $schema): Schema
    {
        return RTForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RTSTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRTS::route('/'),
            'create' => CreateRT::route('/create'),
            'edit' => EditRT::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
