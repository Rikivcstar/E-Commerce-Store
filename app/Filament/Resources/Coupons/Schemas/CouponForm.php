<?php

namespace App\Filament\Resources\Coupons\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Kupon Diskon')
                    ->description('Atur kode promo dan nilai diskon untuk pelanggan.')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Kupon / Voucher')
                            ->placeholder('contoh: DISKON50')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->extraInputAttributes(['style' => 'text-transform: uppercase'])
                            ->dehydrateStateUsing(fn ($state) => strtoupper($state)),

                        Select::make('type')
                            ->label('Tipe Diskon')
                            ->options([
                                'percent' => 'Persentase (%)',
                                'fixed' => 'Potongan Tetap (Rp)',
                            ])
                            ->required()
                            ->default('percent'),

                        TextInput::make('value')
                            ->label('Nilai Diskon')
                            ->helperText('Jika persentase masukan angka 1-100. Jika potongan tetap masukan nominal Rupiah.')
                            ->numeric()
                            ->required(),

                        TextInput::make('min_order_amount')
                            ->label('Batas Minimal Belanja (Rp)')
                            ->placeholder('0')
                            ->numeric()
                            ->default(0),

                        TextInput::make('max_discount_amount')
                            ->label('Maksimal Potongan Diskon (Rp)')
                            ->placeholder('Kosongkan jika tidak ada batas')
                            ->numeric(),

                        TextInput::make('usage_limit')
                            ->label('Batas Kuota Penggunaan')
                            ->placeholder('Kosongkan jika tidak terbatas')
                            ->numeric(),

                        DateTimePicker::make('valid_from')
                            ->label('Berlaku Dari Tanggal'),

                        DateTimePicker::make('valid_until')
                            ->label('Berlaku Sampai Tanggal'),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ]),
            ]);
    }
}
