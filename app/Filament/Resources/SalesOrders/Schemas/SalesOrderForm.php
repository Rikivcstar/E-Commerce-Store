<?php

namespace App\Filament\Resources\SalesOrders\Schemas;

use App\Models\SalesOrder;
use App\Services\RegionQueryService;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class SalesOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make("Sales Order General Information")
                ->description("Meta & Customer Info")
                ->schema([
                    TextEntry::make('trx_id')
                        ->label('TRX ID')
                        ->inlineLabel(),
                    TextEntry::make('status')
                        ->formatStateUsing(fn($state) => $state->label())
                        ->inlineLabel(),
                    TextEntry::make('due_date_at')
                        ->label('Due Date')
                        ->inlineLabel(),
                    TextEntry::make('customer_full_name')
                        ->label("Customer")
                        ->inlineLabel(),
                    TextEntry::make('customer_email')
                        ->label("Customer Email")
                        ->inlineLabel(),
                    TextEntry::make('customer_phone')
                        ->label('Customer Phone')
                        ->inlineLabel(),
                    TextEntry::make('address_line')
                        ->label('Shipping Address')
                        ->inlineLabel()
                        ->formatStateUsing(function($state, SalesOrder $sales_order) {
                            $region = app(RegionQueryService::class)->searchRegionByCode(
                                $sales_order->destination_code
                            );

                            return "$state {$region->label}";
                        }),
                ]),

                Section::make('Shipping Details')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('shipping_driver')
                            ->label('Vendor')
                            ->inlineLabel(),
                        TextEntry::make('shipping_courier')
                            ->inlineLabel(),
                        TextEntry::make('shipping_service')
                            ->inlineLabel(),
                        TextEntry::make('shipping_estimated_delivery')
                            ->inlineLabel(),
                        TextEntry::make('shipping_weight')
                            ->suffix('gram')
                            ->inlineLabel(),
                        TextEntry::make('shipping_reciept_number')
                            ->inlineLabel()
                    ]),
                RepeatableEntry::make('items')
                    ->schema([
                        TextEntry::make('name')
                            ->formatStateUsing(fn($state, Model $record) => "({$record->sku}) $state"),
                        TextEntry::make('quantity'),
                        TextEntry::make('price')
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                        TextEntry::make('total')
                            ->formatStateUsing(fn($state) => Number::currency($state))
                    ])
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->columns(4),
                Section::make("Summaries")
                    ->schema([
                        TextEntry::make('payment_label')
                            ->inlineLabel(),
                        TextEntry::make('payment_paid_at')
                            ->label('Paid At')
                            ->inlineLabel(),
                        TextEntry::make('sub_total')
                            ->label('Sub Total')
                            ->formatStateUsing(fn($state) => Number::currency($state))
                            ->inlineLabel(),
                        TextEntry::make('shipping_total')
                            ->label("Shpping Total")
                            ->formatStateUsing(fn($state) => Number::currency($state))
                            ->inlineLabel()

                    ])
            ]);
    }
}
