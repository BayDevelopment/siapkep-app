<?php

namespace App\Filament\Resources\Mutations;

use App\Filament\Resources\Mutations\Pages\CreateMutations;
use App\Filament\Resources\Mutations\Pages\EditMutations;
use App\Filament\Resources\Mutations\Pages\ListMutations;
use App\Filament\Resources\Mutations\Pages\ViewMutations;
use App\Filament\Resources\Mutations\Schemas\MutationsForm;
use App\Filament\Resources\Mutations\Schemas\MutationsInfolist;
use App\Filament\Resources\Mutations\Tables\MutationsTable;
use App\Models\MutationsModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class MutationsResource extends Resource
{
    protected static ?string $model = MutationsModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $recordTitleAttribute = 'mutation_type';

    // AWAL RENOVASI MANUAL
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }

    protected static UnitEnum|string|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;  // Ganti angka sesuai urutan yang diinginkan, lebih rendah berarti lebih atas

    protected static ?string $navigationLabel = 'Mutasi';

    protected static ?string $modelLabel = 'Mutasi';

    protected static ?string $pluralModelLabel = 'Mutasi';

    // AKHIR RENOVASI MANUAL

    public static function form(Schema $schema): Schema
    {
        return MutationsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MutationsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MutationsTable::configure($table);
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
            'index' => ListMutations::route('/'),
            'create' => CreateMutations::route('/create'),
            'view' => ViewMutations::route('/{record}'),
            'edit' => EditMutations::route('/{record}/edit'),
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
