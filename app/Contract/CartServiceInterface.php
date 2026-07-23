<?php
declare(strict_types=1);
// Mode strict, PHP akan ketat dalam pengecekan tipe data
// contoh: kalau fungsi minta int, kita kasih string → error

namespace App\Contract;
// Namespace = lokasi class/interface ini disimpan
// Dengan namespace, nama class tidak bentrok dengan yang lain

// Import class yang dipakai
use App\Data\CartData;      // Representasi data keranjang
use App\Data\CartItemData;  // Representasi data item di keranjang

/**
 * Interface = kontrak/aturan yang harus dipatuhi oleh class
 * Jadi siapa pun yang "implements CartServiceInterface"
 * wajib membuat semua fungsi yang ada di sini
 */
interface CartServiceInterface
{
    /**
     * Menambahkan item ke cart atau update kalau SKU sudah ada
     * @param CartItemData $item → data item (misal: nama, sku, qty, harga)
     * return void → tidak mengembalikan nilai
     */
    public function addOrUpdated(CartItemData $item): void;

    /**
     * Menghapus item dari cart berdasarkan SKU
     * @param string $sku → kode unik produk
     */
    public function remove(string $sku): void;

    public function clear() : void;

    /**
     * Mengambil satu item dari cart berdasarkan SKU
     * return CartItemData atau null kalau tidak ditemukan
     */
    public function getItemBySku(string $sku): ?CartItemData;

    /**
     * Mengambil seluruh isi cart
     * return CartData (bisa berisi list item + total harga, dll)
     */
    public function all(): CartData;
}
