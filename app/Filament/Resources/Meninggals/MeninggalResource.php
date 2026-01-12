<?php

namespace App\Filament\Resources\Meninggals;

use App\Filament\Resources\Meninggals\Pages\CreateMeninggal;
use App\Filament\Resources\Meninggals\Pages\EditMeninggal;
use App\Filament\Resources\Meninggals\Pages\ListMeninggals;
use App\Filament\Resources\Meninggals\Pages\ViewMeninggal;
use App\Filament\Resources\Meninggals\Schemas\MeninggalForm;
use App\Filament\Resources\Meninggals\Schemas\MeninggalInfolist;
use App\Filament\Resources\Meninggals\Tables\MeninggalsTable;
use App\Models\MeninggalModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MeninggalResource extends Resource
{
    protected static ?string $model = MeninggalModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-face-frown';

    protected static ?string $recordTitleAttribute = 'resident_id';

    // AWAL RENOVASI MANUAL
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 4;  // Ganti angka sesuai urutan yang diinginkan, lebih rendah berarti lebih atas

    protected static ?string $navigationLabel = 'Meninggal';

    protected static ?string $modelLabel = 'Meninggal';

    protected static ?string $pluralModelLabel = 'Meninggal';

    // AKHIR RENOVASI MANUAL

    public static function form(Schema $schema): Schema
    {
        return MeninggalForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MeninggalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MeninggalsTable::configure($table);
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
            'index' => ListMeninggals::route('/'),
            'create' => CreateMeninggal::route('/create'),
            'view' => ViewMeninggal::route('/{record}'),
            'edit' => EditMeninggal::route('/{record}/edit'),
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
