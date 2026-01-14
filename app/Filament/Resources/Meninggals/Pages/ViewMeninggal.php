<?php

namespace App\Filament\Resources\Meninggals\Pages;

use App\Filament\Resources\Meninggals\MeninggalResource;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class ViewMeninggal extends ViewRecord
{
    protected static string $resource = MeninggalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->icon('heroicon-o-pencil'),
            Action::make('back')
                ->label('Kembali')
                ->url($this->getResource()::getUrl('index'))
                ->icon('heroicon-o-arrow-left')
                ->color('gray'),

        ];
    }

    // berfungsi untuk menampilkan gambar di bagian view
    public function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()
                ->columnSpanFull() // ✅ penting di Filament 4
                ->columns([
                    'default' => 1,
                    'lg' => 3,
                ])
                ->schema([
                    Section::make('Informasi Kematian')
                        ->description('Ringkasan data penduduk dan detail peristiwa.')
                        ->icon('heroicon-o-document-text')
                        ->columnSpan([
                            'lg' => 2,
                        ])
                        ->columns([
                            'default' => 1,
                            'md' => 2,
                        ])
                        ->schema([
                            TextEntry::make('residentMeninggal.full_name')
                                ->label('Nama Penduduk')
                                ->size(TextSize::Large)
                                ->weight(FontWeight::SemiBold)
                                ->placeholder('-'),

                            TextEntry::make('death_date')
                                ->label('Tanggal Meninggal')
                                ->icon('heroicon-o-calendar')
                                ->formatStateUsing(fn ($state) => $state
                                    ? Carbon::parse($state)->locale('id')->translatedFormat('l, d F Y')
                                    : '-'
                                ),

                            TextEntry::make('death_place')
                                ->label('Tempat Meninggal')
                                ->icon('heroicon-o-map-pin')
                                ->placeholder('-'),

                            TextEntry::make('cause_of_death')
                                ->label('Penyebab Kematian')
                                ->icon('heroicon-o-heart')
                                ->badge()
                                ->color('danger')
                                ->placeholder('-'),
                        ]),

                    Section::make('Dokumentasi')
                        ->description('Foto / bukti pendukung.')
                        ->icon('heroicon-o-photo')
                        ->columnSpan([
                            'lg' => 1,
                        ])
                        ->schema([
                            ImageEntry::make('death_certificate_path')
                                ->label('Gambar')
                                ->disk('public')
                                ->visibility('public')
                                ->imageHeight(260)
                                ->extraImgAttributes([
                                    'style' => 'border-radius: 18px; object-fit: cover; width: 100%;',
                                ]),
                        ]),
                ]),
        ]);
    }
}
