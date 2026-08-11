<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Slide Carousel Banner')
                    ->description('Setiap data banner yang Anda buat di sini akan menjadi 1 Slide pada Promo Carousel di Homepage.')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->label('Gambar Slide Carousel')
                            ->helperText('Rekomendasi rasio gambar landscape (contoh: 1600x700 px)')
                            ->image()
                            ->imageEditor(),
                        TextInput::make('title')
                            ->label('Judul Slide')
                            ->placeholder('contoh: Diskon Spesial Musim Panas 50%')
                            ->required(),
                        TextInput::make('subtitle')
                            ->label('Subjudul (opsional)')
                            ->placeholder('contoh: Dapatkan potongan harga hingga 50% untuk koleksi pilihan terkini.'),
                        TextInput::make('link_url')
                            ->label('Link Tujuan')
                            ->placeholder('contoh: /catalog atau https://...')
                            ->helperText('URL internal (mis. /catalog) atau URL eksternal saat slide diklik'),
                        TextInput::make('button_label')
                            ->label('Label Tombol (opsional)')
                            ->placeholder('contoh: Belanja Sekarang'),
                        Toggle::make('is_active')
                            ->label('Tampilkan Slide Ini di Carousel')
                            ->default(true),
                        TextInput::make('order_column')
                            ->label('Urutan Slide')
                            ->numeric()
                            ->default(0)
                            ->helperText('Semakin kecil angkanya (mis. 0, 1, 2), semakin awal urutan slidenya'),
                    ]),
            ]);
    }
}