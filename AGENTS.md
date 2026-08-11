# Panduan Pengembangan WebStore

Dokumen ini adalah aturan baku (convention) yang wajib diikuti saat menambah atau mengubah fitur,
agar arsitektur tetap konsisten, mudah di-maintain, dan mudah di-extend ke depan.

## Tech Stack

- Backend: Laravel 12 (PHP 8.2+)
- Reactive UI: Livewire 3 (frontstore) + Filament 4.0 (admin panel)
- DTO: Spatie Laravel Data
- Media: Spatie Media Library
- Tags: Spatie Laravel Tags
- State: Spatie Model States
- Activity Log: Spatie Activitylog
- Role/Permission: Spatie Permission + Filament Shield (super_admin / panel_user)
- Webhook: Spatie Webhook Client
- Action Pattern: lorisleiva/laravel-actions

## Struktur Folder

```
app/
├── Actions/       # Operasi domain sekali pakai (contoh: ValidateCartStock)
├── Contract/      # Interface (Cart, Payment, Shipping) — titik abstraksi provider
├── Data/          # DTO — tidak boleh mengirim array mentah ke view/controller
├── Drivers/       # Implementasi nyata Payment & Shipping (Offline, Moota, Komerce)
├── Events/        # Event domain (SalesOrderCreated, dsb.)
├── Listeners/     # Efek samping async (email, generate payment link)
├── Livewire/      # Komponen frontstore
├── Mail/          # Email template
├── Models/        # Eloquent model
├── Services/      # Business logic (Checkout, Cart, SalesOrder, resolver)
├── States/        # Status transaksi via Spatie Model States
├── Validators/    # Validasi khusus (Moota signature)
└── Filament/
    ├── Resources/<Nama>/
    │   ├── XResource.php
    │   ├── Pages/     (List, Create, Edit, View)
    │   ├── Schemas/   (XForm)
    │   └── Tables/    (XTable)
```

## Aturan Wajib

1. **Layer yang benar**
   - Controller/Livewire hanya mengumpulkan input → validasi → panggil Service. Tidak berisi logic bisnis.
   - Logic bisnis → `app/Services/` atau `app/Actions/`.
   - Kirim data antar layer memakai **DTO**, bukan array mentah.
   - Model hanya berisi relasi, casts, scope, booted — tidak berisi logic transaksional.

2. **Integrasi eksternal (payment/shipping)**
   - Buat class baru di `app/Drivers/...` yang `implements` contract terkait
     (`PaymentDriverInterface` / `ShippingDriverInterface`).
   - Daftarkan driver baru di resolver Service (`PaymentMethodQueryService` / `ShippingMethodService`).

3. **Efek samping (email, notifikasi, proses pembayaran)**
   - Trigger lewat **Event**, proses di **Listener** yang `ShouldQueue`.
   - Jangan panggil Mail/HTTP langsung di dalam Service utama.

4. **Transaksi & konsistensi data**
   - Operasi yang menyentuh stok / order wajib `DB::transaction()`.
   - Saat baca stok untuk diubah, selalu `lockForUpdate()` dan beri `where` yang spesifik
     (jangan pernah update tanpa kondisi).
   - `Product::where('sku', ...)->increment('stock', ...)` untuk menambah stok, bukan overwrite.

5. **Media Library**
   - Setiap model `HasMedia` WAJIB mendeklarasikan `registerMediaCollections()`.
   - Nama collection harus sama persis antara model, Filament form, dan tempat baca (`getFirstMediaUrl`).

6. **Filament Resource** — selalu gunakan pola `Resource + Pages + Schemas + Tables`.

7. **Penamaan**
   - Method/properti/class: English.
   - Label user-facing & komentar: bahasa Indonesia.
   - Route `snake_case`, model `StudlyCase`, DTO `XxxData`.

8. **Validation** — validasi input di Livewire `rules()` / `FormRequest`. Untuk hash (shipping/payment)
   gunakan rule khusus (`ValidShippingHash`, `ValidPaymentMethodHash`).

9. **Keamanan**
   - Halaman panel admin: pastikan role (`super_admin`/`panel_user`) sebelum akses.
   - Halaman akun/detail order yang sensitif: cek kepemilikan (`Auth::id() === $model->user_id`).

## Command yang Biasa Dipakai

```bash
composer dev                 # server + queue + vite bersamaan
php artisan make:migration   # buat migrasi
php artisan make:filament-resource Nama --generate
php artisan pint             # format kode
php artisan test             # jalankan test
```

## Checklist Fitur Baru

- [ ] Data domain dalam DTO (`app/Data/`)
- [ ] Logic di Service/Action, bukan di Livewire/Controller
- [ ] Side-effect lewat Event + queued Listener
- [ ] Migrasi + relasi model lengkap
- [ ] Filament Resource (kalau perlu dikelola admin) mengikuti pola Pages/Schemas/Tables
- [ ] Collection media dideklarasikan di model (kalau pakai gambar)
- [ ] Validasi input di Livewire
- [ ] Jalankan `php artisan pint` sebelum commit
