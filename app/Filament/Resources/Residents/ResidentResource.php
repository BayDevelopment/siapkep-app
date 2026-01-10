<?php

namespace App\Filament\Resources\Residents;

use App\Filament\Resources\Residents\Pages\CreateResident;
use App\Filament\Resources\Residents\Pages\EditResident;
use App\Filament\Resources\Residents\Pages\ListResidents;
use App\Filament\Resources\Residents\Pages\ViewResident;
use App\Filament\Resources\Residents\Schemas\ResidentForm;
use App\Filament\Resources\Residents\Schemas\ResidentInfolist;
use App\Filament\Resources\Residents\Tables\ResidentsTable;
use App\Models\ResidentModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ResidentResource extends Resource
{
    protected static ?string $model = ResidentModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'full_name';

    // AWAL RENOVASI MANUAL
    public static function getElequentQuery(): Builder
    {
        return parent::getElequentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Penduduk';

    protected static ?string $modelLabel = 'Penduduk';

    protected static ?string $pluralModelLabel = 'Penduduk';

    // AKHIR RENOVASI MANUAL

    public static function form(Schema $schema): Schema
    {
        return ResidentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ResidentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResidentsTable::configure($table);
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
            'index' => ListResidents::route('/'),
            'create' => CreateResident::route('/create'),
            'view' => ViewResident::route('/{record}'),
            'edit' => EditResident::route('/{record}/edit'),
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
