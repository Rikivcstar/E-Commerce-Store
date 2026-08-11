# Analisis Arsitektur & Backend WebStore

Dokumen ini adalah hasil audit struktur folder, logic backend, dan rekomendasi pengembangan
agar pembuatan fitur baru tetap konsisten dengan konvensi project.

## 1. Ringkasan Arsitektur (Sudah Bagus)

Layering sudah mengikuti pola enterprise (mirip Bagisto):

```
Contract/        → interface (Cart, Shipping, Payment) — titik abstraksi provider
Services/        → business logic (Checkout, Cart, SalesOrder, resolver service)
Drivers/         → implementasi nyata (Offline, Moota, Komerce) — tambah provider cukup daftar di service
Data/            → DTO (mencegah array mentah bocor ke view/controller)
States/          → status transaksi via Spatie Model States (Pending → Progress → Completed/Cancel)
Events+Listeners → efek samping async (email, generate payment link) di-queue
Http/Livewire/   → interaksi UI (input → validasi → panggil Service)
Filament/        → admin panel (Resource/Pages/Schemas/Tables)
```

Pola ini wajib dipertahankan untuk semua fitur baru (lihat `AGENTS.md`).

## 2. Bug yang Ditemukan & Sudah Diperbaiki

| # | Lokasi | Masalah | Perbaikan |
|---|--------|---------|-----------|
| 1 | `app/Services/SalesOrderService.php:50` | `returnStock()` update `stock` **tanpa where** → stok semua produk tertimpa saat order dibatalkan | `where('sku', ...)->lockForUpdate()->increment('stock', qty)` dalam 1 transaksi |
| 2 | `app/Models/Product.php` | Collection media `images` vs form upload `cover`/`gallery` vs baca `getFirstMediaUrl('cover')` tidak konsisten → gambar produk kosong/error | Daftarkan collection `cover` (single) + `gallery` |
| 3 | `app/Models/Page.php`, `app/Models/Category.php` | `HasMedia` tanpa `registerMediaCollections()` padahal form memakai `collection('image')` → error | Tambahkan `registerMediaCollections()` + konversi thumb |
| 4 | `app/Services/SalesOrderService.php:41` | `SalesOrderData::from($model)` (mapping salah) | Ganti ke `SalesOrderData::fromModel($model)` |
| 5 | `app/Models/User.php:57` | `canAccessPanel()` return `true` → semua customer bisa masuk admin | Batasi `hasAnyRole(['super_admin', 'panel_user'])` |
| 6 | `app/Services/SalesOrderService.php` | `approvePaymentUsingTrxId()` tanpa null-guard (webhook trx tidak ditemukan → error) | Tambah guard + logging |
| 7 | `app/Services/CheckoutService.php` | Key array duplikat (`origin_postal_code`, `destination_postal_code`) | Bersihkan |
| 8 | `app/Services/RegionQueryService.php` | Import nyasar `Amp\Dns\query` | Hapus |

## 3. Rekomendasi Standar Penulisan (Ringkas)

Lihat `AGENTS.md` untuk versi lengkap. Inti:

1. Controller/Livewire = input → validasi → panggil Service. Tanpa logic bisnis.
2. Logic bisnis → `app/Services/` atau `app/Actions/`.
3. Kirim data antar layer via DTO (`app/Data/`).
4. Integrasi eksternal (payment/shipping) = class `implements Contract` + daftar di resolver Service.
5. Efek samping → `Event` + queued `Listener`.
6. Operasi stok/order → `DB::transaction()` + `lockForUpdate()` dengan `where` spesifik.
7. Model `HasMedia` WAJIB deklarasi `registerMediaCollections()`, nama collection sama di form & tempat baca.
8. Filament Resource = pola `Resource + Pages + Schemas + Tables`.
9. Validasi di Livewire `rules()`; hash pakai rule khusus (`ValidShippingHash`, `ValidPaymentMethodHash`).
10. Keamanan: panel admin cek role; halaman sensitif cek kepemilikan.

## 4. Fitur Baru yang Telah Ditambahkan (Fase 1)

### Wishlist
- Migrasi `wishlists` (user_id, product_id, unique pair)
- Relasi `User::wishlistProducts()` & `Product::wishlistedBy()`
- Komponen `Livewire/WishlistToggle` (tombol di halaman produk), `WishlistRemove`, `Wishlist` (halaman akun)
- Route `GET /account/wishlist` (`account.wishlist`) di grup auth
- Link "My Wishlist" di menu akun (desktop & mobile)

### Review & Rating Produk
- Migrasi `product_reviews` (product_id, user_id, rating 1-5, title, body, is_approved)
- Model `ProductReview` + scope `approved()`
- Relasi `Product::reviews()`, `User::reviews()`, `Product::salesOrderItems()`
- Komponen `Livewire/ProductReviews`:
  - Rangkuman rating (rata-rata + distribusi bintang)
  - Daftar ulasan (hanya yang disetujui) + "Pembeli terverifikasi"
  - Form ulasan hanya untuk user yang **sudah pernah membeli** produk (verified purchase) & belum mereview
- Admin: `Filament/Resources/ProductReviews` (list + edit + toggle persetujuan + filter)

## 5. Roadmap Fitur (Perbandingan dengan Bagisto)

### Fase 1 — Wajib (sebagian sudah dibuat)
- [x] Wishlist
- [x] Review & rating (+ moderasi admin)
- [ ] Alamat customer (address book multi-alamat)
- [ ] Order tracking timeline (status sudah ada via Model States)
- [ ] Coupon/diskon engine (diterapkan di `CartData`)
- [ ] Banner/slider promosi di homepage
- [ ] Dashboard admin + laporan penjualan (grafik, produk terlaris, revenue)
- [ ] SEO (meta tags, sitemap, canonical)

### Fase 2 — Setara Bagisto
- [ ] Produk variasi/atribut (configurable product: ukuran/warna)
- [ ] Import/export produk (CSV)
- [ ] Role & permission hardening (sudah ada Filament Shield)
- [ ] Invoice & shipment management di admin
- [ ] Multi-kurir real via Biteship + payment real (Midtrans/Xendit)
- [ ] Multi-currency / locale

### Fase 3 — Nilai Tambah (AI, selaras `analisis_skripsi.md`)
- [ ] Rekomendasi produk (Content-Based + Collaborative Filtering)
- [ ] Cross-selling (Apriori)
- [ ] Prediksi stok (Moving Average)
- [ ] Analisis sentimen review (Naive Bayes)
- [ ] Notifikasi WhatsApp, API/PWA

## 6. Catatan Teknis

- Environment WSL ini **tidak punya binary PHP**, sehingga `php artisan`, `php artisan pint`,
  dan `php artisan test` tidak bisa dijalankan di sini. Jalankan di mesin development normal:
  ```bash
  composer dev
  php artisan migrate
  php artisan shield:generate        # daftarkan policy resource ProductReview
  php artisan shield:install --fresh # (opsional) buat role super_admin + panel_user
  php artisan pint
  php artisan test
  ```
- Setelah `shield:generate`, pastikan user admin diberi role `super_admin` agar tetap bisa akses `/back`
  (karena `canAccessPanel()` sekarang membatasi akses).
