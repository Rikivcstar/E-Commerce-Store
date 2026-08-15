<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\User;
use App\States\SalesOrder\Cancel;
use App\States\SalesOrder\Completed;
use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Progress;
use Illuminate\Support\Carbon;

class SalesReportService
{
    /**
     * Stats ringkasan bulan ini (omset, total order, produk terjual, pelanggan baru)
     */
    public function monthlyStats(): array
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $revenue = SalesOrder::query()
            ->whereState('status', [Completed::class, Progress::class])
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total');

        $order_count = SalesOrder::query()
            ->whereNotState('status', Cancel::class)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        $items_sold = SalesOrderItem::query()
            ->whereHas('salesOrder', function ($q) use ($startOfMonth, $endOfMonth) {
                $q->whereNotState('status', Cancel::class)
                    ->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
            })
            ->sum('quantity');

        $new_customers = User::query()
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        return [
            'revenue' => (float) $revenue,
            'order_count' => (int) $order_count,
            'items_sold' => (int) $items_sold,
            'new_customers' => (int) $new_customers,
        ];
    }

    /**
     * Tren omset harian N hari terakhir untuk grafik
     */
    public function revenueByDay(int $days = 30): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $rawRevenues = SalesOrder::query()
            ->whereState('status', [Completed::class, Progress::class])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as daily_total')
            ->groupBy('date')
            ->pluck('daily_total', 'date')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $displayLabel = Carbon::now()->subDays($i)->format('d M');
            $labels[] = $displayLabel;
            $data[] = (float) ($rawRevenues[$date] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    /**
     * Jumlah pesanan per status
     */
    public function ordersByStatus(): array
    {
        return [
            'pending' => SalesOrder::query()->whereState('status', Pending::class)->count(),
            'progress' => SalesOrder::query()->whereState('status', Progress::class)->count(),
            'completed' => SalesOrder::query()->whereState('status', Completed::class)->count(),
            'cancel' => SalesOrder::query()->whereState('status', Cancel::class)->count(),
        ];
    }

    /**
     * Produk terlaris (Top N)
     */
    public function topProducts(int $limit = 5)
    {
        return Product::query()
            ->select('products.*')
            ->selectSub(function ($query) {
                $query->from('sales_order_items')
                    ->join('sales_orders', 'sales_orders.id', '=', 'sales_order_items.sales_order_id')
                    ->whereColumn('sales_order_items.sku', 'products.sku')
                    ->whereIn('sales_orders.status', [Completed::class, Progress::class])
                    ->selectRaw('COALESCE(SUM(sales_order_items.quantity), 0)');
            }, 'total_sold')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    /**
     * Daftar produk dengan stok menipis
     */
    public function lowStockQuery(int $threshold = 5)
    {
        return Product::query()->lowStock($threshold)->orderBy('stock', 'asc');
    }

    /**
     * Data sparkline harian untuk N hari terakhir (Pendapatan)
     */
    public function revenueSparkline(int $days = 7): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $raw = SalesOrder::query()
            ->whereState('status', [Completed::class, Progress::class])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $result[] = (float) ($raw[$date] ?? 0);
        }

        return $result;
    }

    /**
     * Data sparkline harian untuk N hari terakhir (Jumlah Order)
     */
    public function ordersSparkline(int $days = 7): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $raw = SalesOrder::query()
            ->whereNotState('status', Cancel::class)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $result[] = (int) ($raw[$date] ?? 0);
        }

        return $result;
    }

    /**
     * Data sparkline harian untuk N hari terakhir (Produk Terjual)
     */
    public function itemsSoldSparkline(int $days = 7): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $raw = SalesOrderItem::query()
            ->whereHas('salesOrder', function ($q) use ($startDate, $endDate) {
                $q->whereNotState('status', Cancel::class)
                    ->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->selectRaw('DATE(created_at) as date, SUM(quantity) as qty')
            ->groupBy('date')
            ->pluck('qty', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $result[] = (int) ($raw[$date] ?? 0);
        }

        return $result;
    }

    /**
     * Data sparkline harian untuk N hari terakhir (Pelanggan Baru)
     */
    public function customersSparkline(int $days = 7): array
    {
        $startDate = Carbon::now()->subDays($days - 1)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $raw = User::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $result[] = (int) ($raw[$date] ?? 0);
        }

        return $result;
    }

    /**
     * Query 5 pesanan terbaru
     */
    public function latestOrdersQuery(int $limit = 5)
    {
        return SalesOrder::query()
            ->with('user')
            ->latest('created_at');
    }
}
