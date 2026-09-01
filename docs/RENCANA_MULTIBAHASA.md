# Rencana Multi-Bahasa (ID/EN)

Dokumen rencana fitur multi-bahasa (Indonesia & Inggris) untuk WebStore.
Status: **Disetujui — siap eksekusi**.

## Keputusan yang Disetujui
- Konten dinamis: **spatie/laravel-translatable** (kolom JSON `{"id","en"}`).
- Skema URL: **query param `?lang=`** (mempertahankan URL & route saat ini).
- Cakupan: **frontstore saja**; panel admin (UI) tidak diterjemahkan, tetapi form admin mendukung isi 2 bahasa.
- Email template & PDF invoice: **ditunda** ke fase berikutnya.

## Hasil Analisis Awal
- Belum ada folder `lang/`, middleware `SetLocale`, maupun `spatie/laravel-translatable`.
- `config/app.php` default `locale=en`, `fallback_locale=en`.
- String UI hardcoded (campuran ID/EN) di seluruh Blade: `navigation`, `footer`, `layouts/app`, dan semua view Livewire.
- Konten dinamis tersimpan satu bahasa: `Product` (name/description), `Category` (name/description), `Page` (name/excerpt/context).
- Layout sudah `lang="{{ app()->getLocale() }}"`.
- Stack sudah Spatie-heavy (media, tags, states, activitylog, data).

## Fase 0 — Fondasi Lokal
- `config/app.php`: `locale` → `env('APP_LOCALE','id')`, `fallback_locale` → `'en'`, tambah kunci `available_locales => ['id','en']`.
- Middleware `SetLocale` (urut: `?lang=` → session → cookie → `Accept-Language`) → `App::setLocale`; daftarkan di group `web`.
- `LanguageSwitcher` Livewire (navigation + footer), pertahankan URL & query saat ganti bahasa.
- `.env` → `APP_LOCALE=id`, `APP_FALLBACK_LOCALE=en`.

## Fase 1 — String Statis UI
- Buat `lang/id.json` + `lang/en.json`.
- Ganti semua string hardcoded di: `navigation`, `footer`, `layouts/app`, `global-search`, `category-menu`, `page-static`.
- Lalu per halaman Livewire: account, checkout, cart, product-detail, product-catalog, home-page, track-order, dll. (fase terbesar).

## Fase 2 — Konten Dinamis Translatable
- Install `spatie/laravel-translatable`.
- Migrasi kolom → `json`: `products.name/description`, `categories.name/description`, `pages.name/excerpt/context`.
- Migrasi data: bungkus nilai lama menjadi `{"id":"<nilai>","en":"<nilai>"}`.
- Model: `use HasTranslations` + `$translatable`.
- DTO (`ProductData` dll.): gunakan `getTranslation()` sesuai locale.

## Fase 3 — Admin Filament (setup form)
- Form `Product`/`Category`/`Page`: field `Translatable(required and locales:['id','en'])` agar admin mengisi 2 bahasa.

## Fase 4 — SEO
- `<link rel="alternate" hreflang="id/en">` di head.

## Ditunda
- Email template + invoice PDF.
