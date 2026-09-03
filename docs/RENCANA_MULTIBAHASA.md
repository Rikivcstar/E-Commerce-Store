# Rencana Multi-Bahasa (ID/EN)

Dokumen rencana fitur multi-bahasa (Indonesia & Inggris) untuk WebStore.
Status: **Phase 0 & 1 selesai | Phase 2 selesai | Phase 3–4 tertunda**.

> **Catatan**: PHP tidak tersedia di WSL (`/mnt/c/laraherd/webstore`). User menjalankan `composer`, `php artisan`, `pint`, `test` di Windows (`PS C:\laraherd\webstore>`).

## Keputusan yang Disetujui
- Konten dinamis: **spatie/laravel-translatable** (kolom JSON `{"id","en"}`).
- Skema URL: **query param `?lang=`** (mempertahankan URL & route saat ini).
- Cakupan: **frontstore saja**; panel admin (UI) tidak diterjemahkan, tetapi form admin mendukung isi 2 bahasa.
- Email template & PDF invoice: **ditunda** ke fase berikutnya.

## Hasil Analisis Awal
- ✅ Fase 0 & 1 selesai: `config/app.php` locale=id/fallback=en, middleware `SetLocale`, `LanguageSwitcher`, helper `LocaleUrl`, hreflang, `lang/id.json` + `lang/en.json` (336 keys masing-masing).
- ✅ Fase 2 selesai: `spatie/laravel-translatable` v6.11.4 sudah terinstall; migrasi kolom `products`/`categories`/`pages` ke format JSON `{"id","en"}` via migrasi `2026_09_02_000001`; model `Product`, `Category`, `Page` pakai trait `HasTranslations`; DTO tidak perlu diubah (trait return string via attribute access).
- ⏳ Fase 3–4: menunggu user — form admin `Translatable` field (Phase 3), hreflang/structured data (Phase 4).

## Fase 0 — Fondasi Lokal
- `config/app.php`: `locale` → `env('APP_LOCALE','id')`, `fallback_locale` → `'en'`, tambah kunci `available_locales => ['id','en']`.
- Middleware `SetLocale` (urut: `?lang=` → session → cookie → `Accept-Language`) → `App::setLocale`; daftarkan di group `web`.
- `LanguageSwitcher` Livewire (navigation + footer), pertahankan URL & query saat ganti bahasa.
- `.env` → `APP_LOCALE=id`, `APP_FALLBACK_LOCALE=en`.

## Fase 1 — String Statis UI ✅ Selesai
- Buat `lang/id.json` + `lang/en.json` (**336 keys** masing-masing).
- Ganti semua string hardcoded di: `navigation`, `footer`, `layouts/app`, `global-search`, `category-menu`, `page-static`.
- Lalu per halaman Livewire: account, checkout, cart, product-detail, product-catalog, home-page, track-order, dll. (fase terbesar).
- **Fix**: label `validationAttributes` di `CustomerLogin`, `CustomerRegister`, `ProductCatalog` kini pakai `__()`; kunci baru `'Email'`, `'Name'`, `'Category'`, `'Collection'`, `'Password confirmation'` ditambahkan ke kedua file.
- Validasi wrapping home page & semua view: bersih (tidak ada `__('')` kosong, double-paren, atau string English keras yang tersisa).

## Fase 2 — Konten Dinamis Translatable ✅ Selesai
- `spatie/laravel-translatable` v6.11.4 sudah terinstall (siap pakai).
- Migrasi `2026_09_02_000001_make_products_categories_pages_translatable`: konversi data `name`/`description` (products, categories) dan `name`/`excerpt`/`context` (pages) ke format JSON `{"id":"...","en":"..."}` menggunakan Eloquent `updateQuietly` + `withoutEvents`.
- Model `Product`, `Category`, `Page`: tambah `use HasTranslations` + `$translatable = ['name', 'description']` (masing-masing).
- DTO (`ProductData`, `CategoryData`): **tidak perlu diubah** — trait mengembalikan string via attribute access, DTO menerima string.
- Kolom `slug` TIDAK translatable (tetap single identifier untuk URL).
- Kolom `name` tetap `VARCHAR(255)`; JSON string muat untuk data saat ini (nama produk < 60 karakter → JSON ~90 char < 255).

> **Catatan**: Migrasi data menggunakan `Model::withoutEvents` agar `Product::booted()` hook (cek stok) tidak terpicu. Menggunakan `getOriginal()` untuk membaca nilai string mentah sebelum trait memproses.

## Fase 3 — Admin Filament (setup form)
- Form `Product`/`Category`/`Page`: field `Translatable(required and locales:['id','en'])` agar admin mengisi 2 bahasa.

## Fase 4 — SEO
- Form `Product`/`Category`/`Page`: field `Translatable(required and locales:['id','en'])` agar admin mengisi 2 bahasa.

## Fase 4 — SEO
- `<link rel="alternate" hreflang="id/en">` di head.

## Ditunda
- Email template + invoice PDF.
