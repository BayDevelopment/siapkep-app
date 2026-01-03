<?php

namespace App\Filament\Resources\RWS;

use App\Filament\Resources\RWS\Pages\CreateRW;
use App\Filament\Resources\RWS\Pages\EditRW;
use App\Filament\Resources\RWS\Pages\ListRWS;
use App\Filament\Resources\RWS\Schemas\RWForm;
use App\Filament\Resources\RWS\Tables\RWSTable;
use App\Models\RWModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class RWResource extends Resource
{
    protected static ?string $model = RWModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'no_rw';

    // AWAL RENOVASI MANUAL

    protected static UnitEnum|string|null $navigationGroup = 'Wilayah';

    protected static ?string $navigationLabel = 'RW';

    protected static ?string $modelLabel = 'RW';

    protected static ?string $pluralModelLabel = 'RW';

    // AKHIR RENOVASI MANUAL

    public static function form(Schema $schema): Schema
    {
        return RWForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RWSTable::configure($table);
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
            'index' => ListRWS::route('/'),
            'create' => CreateRW::route('/create'),
            'edit' => EditRW::route('/{record}/edit'),
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
