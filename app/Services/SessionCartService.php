<?php
declare(strict_types=1);
// Mode strict, supaya PHP lebih ketat dalam cek tipe data (int, string, dll)

namespace App\Services;
// Namespace = lokasi class agar tidak bentrok dengan class lain

// Import class dan library yang dipakai
use App\Contract\CartServiceInterface; // Interface yang wajib diimplementasi
use App\Data\CartData;                 // Representasi data keranjang
use App\Data\CartItemData;             // Representasi data item keranjang
use Illuminate\Support\Collection;     // Koleksi Laravel (mirip array tapi lebih kuat)
use Illuminate\Support\Facades\Session;// Akses session Laravel
use Spatie\LaravelData\DataCollection; // Koleksi data dari package spatie

class SessionCartService implements CartServiceInterface
{
    // Key session yang dipakai untuk menyimpan data cart
    protected $session_key = 'cart';

    /**
     * Fungsi load: mengambil data cart dari session
     * Mengembalikan DataCollection berisi CartItemData
     */
    protected function load(): DataCollection
    {
        // Ambil data dari session, default [] kalau tidak ada
        $raw = Session::get($this->session_key, []);
        // Bungkus data ke dalam DataCollection dengan tipe CartItemData
        return new DataCollection(CartItemData::class, $raw);
    }

    /**
     * Fungsi save: menyimpan data cart ke session
     * @param Collection<int, CartItemData> $items
     */
    protected function save(Collection $items): void
    {
        // Simpan koleksi item ke session, dirapikan index array-nya
        Session::put($this->session_key, $items->values()->all());
    }

    /**
     * Menambahkan item baru ke cart atau update jika sku sudah ada
     */
    public function addOrUpdated(CartItemData $item): void
    {
        // Ambil data cart dari session dalam bentuk Collection
        $collection = $this->load()->toCollection();
        $updated = false; // flag apakah item sudah ada sebelumnya

        // Loop semua item cart
        $cart = $collection->map(function (CartItemData $i) use ($item, &$updated) {
            // Jika SKU sama → update dengan item baru
            if ($i->sku == $item->sku) {
                $updated = true;
                return $item;
            }
            // Jika SKU berbeda → biarkan item lama
            return $i;
        })->values()->collect(); // rapikan index array

        // Jika item belum ada → tambahkan baru
        if (! $updated) {
            $cart->push($item);
        }

        // Simpan hasil akhir ke session
        $this->save($cart);
    }

    /**
     * Menghapus item dari cart berdasarkan SKU
     */
    public function remove(string $sku): void
    {
        $cart = $this->load()->toCollection()
            // Buang item yang SKU-nya sama
            ->reject(fn(CartItemData $i) => $i->sku == $sku)
            ->values()  // rapikan index array
            ->collect();

        // Simpan cart hasil filter ke session
        $this->save($cart);
    }

    /**
     * Mengambil satu item dari cart berdasarkan SKU
     * return CartItemData atau null kalau tidak ada
     */
    public function getItemBySku(string $sku): ?CartItemData
    {
        return $this->load()->toCollection()
            ->first(fn(CartItemData $item) => $item->sku == $sku);
    }

    /**
     * Mengambil seluruh isi cart dalam bentuk CartData
     */
    public function all(): CartData
    {
        return new CartData($this->load());
    }
}
