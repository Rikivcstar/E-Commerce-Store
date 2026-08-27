# 📦 Dokumentasi Sistem — Riva & Co. WebStore

> **Stack:** Laravel 12 · Livewire 3 · Filament 4 · Spatie Suite · MySQL

---

## Daftar Isi

1. [Gambaran Umum](#1-gambaran-umum)
2. [Tech Stack](#2-tech-stack)
3. [Struktur Folder & Arsitektur](#3-struktur-folder--arsitektur)
4. [Layer Arsitektur (Aliran Data)](#4-layer-arsitektur-aliran-data)
5. [Model & Database](#5-model--database)
6. [Fitur Frontend (Livewire)](#6-fitur-frontend-livewire)
7. [Admin Panel (Filament)](#7-admin-panel-filament)
8. [Integrasi Eksternal](#8-integrasi-eksternal)
9. [Event & Listener](#9-event--listener)
10. [Email & Notifikasi](#10-email--notifikasi)
11. [State Mesin Order](#11-state-mesin-order)
12. [Deployment & Infrastruktur](#12-deployment--infrastruktur)
13. [Perintah Umum](#13-perintah-umum)
14. [Alur Checkout Lengkap](#14-alur-checkout-lengkap)

---

## 1. Gambaran Umum

**Riva & Co. WebStore** adalah aplikasi e-commerce berbasis Laravel 12 yang dibangun dengan arsitektur enterprise berlapis:

- **Frontstore** berbasis Livewire 3 (reactive, tanpa full-page reload)
- **Admin Panel** berbasis Filament 4.0 (diakses di `/back`)
- **Payment & Shipping** menggunakan *driver pattern* (mudah di-extend)
- **Media** dikelola Spatie Media Library (upload → konversi → serve)
- **Status Order** dikelola Spatie Model States (state machine)
- **Side-effect** (email, notifikasi) berjalan secara async via Event + queued Listener

---

## 2. Tech Stack

| Komponen | Teknologi | Versi |
|----------|-----------|-------|
| Backend Framework | Laravel | 12.x |
| PHP | PHP | 8.2+ |
| Reactive UI | Livewire | 3.x |
| Admin Panel | Filament | 4.0 |
| DTO | Spatie Laravel Data | latest |
| Media | Spatie Media Library | latest |
| Tags | Spatie Laravel Tags | latest |
| State Machine | Spatie Model States | latest |
| Activity Log | Spatie Activitylog | latest |
| Role/Permission | Spatie Permission + Filament Shield | latest |
| Webhook | Spatie Webhook Client | latest |
| Action Pattern | lorisleiva/laravel-actions | latest |
| Database | MySQL (Production: Aiven Cloud) | 8.x |
| CSS | Preline UI + Tailwind CSS | 2.x |
| Queue | Database Driver | — |
| Cache | Database Driver | — |
| Broadcast | Laravel Reverb | — |
| Payment | Moota, Xendit, Offline | — |
| Shipping | Komerce, APIKurir, Offline | — |
| OAuth | Google OAuth 2.0 | — |

---

## 3. Struktur Folder & Arsitektur

```
app/
├── Actions/           # Operasi domain sekali pakai
│   └── ValidateCartStock.php
├── Contract/          # Interface — titik abstraksi provider
│   ├── CartServiceInterface.php
│   ├── PaymentDriverInterface.php
│   └── ShippingDriverInterface.php
├── Data/              # DTO (Data Transfer Object) — tidak boleh array mentah
│   ├── CartData.php
│   ├── CartItemData.php
│   ├── CategoryData.php
│   ├── CheckoutData.php
│   ├── CouponData.php
│   ├── CustomerData.php
│   ├── PaymentData.php
│   ├── ProductCollectionData.php
│   ├── ProductData.php
│   ├── RegionData.php
│   ├── SalesOrderData.php
│   ├── SalesOrderItemData.php
│   ├── SalesPaymentData.php
│   ├── SalesShippingData.php
│   ├── ShippingData.php
│   └── ShippingServiceData.php
├── Drivers/
│   ├── Payment/       # Implementasi gateway pembayaran
│   │   ├── MootaPaymentDriver.php
│   │   ├── OfflinePaymentDriver.php
│   │   └── XenditPaymentDriver.php
│   └── Shipping/      # Implementasi kurir pengiriman
│       ├── APIKurirShippingDriver.php
│       ├── KomerceShippingDriver.php
│       └── OfflineShippingDriver.php
├── Events/            # Domain events
│   ├── ProductRestockedEvent.php
│   ├── SalesOrderCancelledEvent.php
│   ├── SalesOrderCompletedEvent.php
│   ├── SalesOrderCreatedEvent.php
│   ├── SalesOrderProgressedEvent.php
│   ├── SalesOrderProofUploadedEvent.php
│   └── ShippingReceiptNumberUpdateEvent.php
├── Listeners/         # Side-effect async (ShouldQueue)
│   ├── GeneratePaymentLinkListener.php
│   ├── NotifyAdminsNewOrderListener.php
│   ├── NotifyAdminsProofUploadedListener.php
│   ├── NotifyStockWaitlistListener.php
│   ├── SalesOrderCancelledListener.php
│   ├── SalesOrderCompletedListener.php
│   ├── SalesOrderProgressedListener.php
│   ├── SendOrderConfirmationEmailListener.php
│   └── ShippingReceiptNumberUpdatedListener.php
├── Livewire/          # Komponen frontstore (reactive UI)
│   ├── Account/       # Halaman akun user
│   ├── Auth/          # Login, register, dll
│   ├── AddToCard.php
│   ├── Cart.php
│   ├── CartCount.php
│   ├── CartRemove.php
│   ├── CategoryMenu.php
│   ├── Checkout.php
│   ├── GlobalSearch.php
│   ├── HomePage.php
│   ├── PageStatic.php
│   ├── ProductCatalog.php
│   ├── ProductDetail.php
│   ├── ProductQuestions.php
│   ├── ProductReviews.php
│   ├── SalesOrderDetail.php
│   ├── TrackOrder.php
│   ├── Wishlist.php
│   ├── WishlistCount.php
│   ├── WishlistRemove.php
│   └── WishlistToggle.php
├── Mail/              # Template email
│   ├── AbandonedCartMail.php
│   ├── SalesOrderCancelledMail.php
│   ├── SalesOrderCompletedMail.php
│   ├── SalesOrderCreatedMail.php
│   ├── SalesOrderProgressedMail.php
│   ├── ShippingReceiptNumberUpdatedMail.php
│   ├── StockAvailableMail.php
│   └── WishlistPriceDropMail.php
├── Models/            # Eloquent model (relasi, casts, scope, booted)
│   ├── Banner.php
│   ├── CartReminder.php
│   ├── Category.php
│   ├── Coupon.php
│   ├── Page.php
│   ├── Product.php
│   ├── ProductQuestion.php
│   ├── ProductReview.php
│   ├── Region.php
│   ├── SalesOrder.php
│   ├── SalesOrderItem.php
│   ├── StockWaitlist.php
│   ├── Tag.php
│   ├── User.php
│   ├── UserAddress.php
│   └── UserCartItem.php
├── Notifications/     # Notifikasi in-app & database
│   ├── LowStockAlertNotification.php
│   ├── NewSalesOrderNotification.php
│   └── ProofOfPaymentUploadedNotification.php
├── Services/          # Business logic
│   ├── CheckoutService.php
│   ├── CouponService.php
│   ├── PaymentMethodQueryService.php
│   ├── RecentViewedService.php
│   ├── RecommendationService.php
│   ├── RegionQueryService.php
│   ├── SalesOrderService.php
│   ├── SalesReportService.php
│   ├── SessionCartService.php
│   ├── ShipmentTrackingService.php
│   ├── ShippingMethodService.php
│   └── UserCartService.php
├── States/SalesOrder/ # State machine order (Spatie Model States)
└── Filament/
    ├── Resources/     # Admin CRUD resources
    │   ├── Banners/
    │   ├── Categories/
    │   ├── Coupons/
    │   ├── Pages/
    │   ├── ProductQuestions/
    │   ├── ProductReviews/
    │   ├── Products/
    │   ├── SalesOrders/
    │   └── Users/
    └── Widgets/       # Dashboard widgets
        ├── LatestOrdersWidget.php
        ├── LowStockTableWidget.php
        ├── OrderStatusChartWidget.php
        ├── RevenueChartWidget.php
        ├── SalesStatsWidget.php
        └── TopProductsWidget.php
```

---

## 4. Layer Arsitektur (Aliran Data)

```
[HTTP Request / Livewire Action]
         │
         ▼
[Livewire Component]   ← Hanya: input → validasi → panggil Service
         │
         ▼
[Service Layer]        ← Business logic, orchestration
  (Services/ & Actions/)
         │
         ├──► [DTO]    ← Data selalu lewat DTO, bukan array mentah
         │
         ├──► [Driver] ← Integrasi eksternal (Payment / Shipping)
         │     └── implements Contract/Interface
         │
         ├──► [DB::transaction() + lockForUpdate()]  ← Operasi stok/order
         │
         └──► [Event]  ← Trigger side-effect async
                │
                ▼
          [Listener (ShouldQueue)]
            ├── SendMail
            ├── GeneratePaymentLink
            └── SendNotification
```

> **Aturan penting**: Controller/Livewire **tidak boleh** berisi logic bisnis.
> Logic bisnis ada di `Services/` atau `Actions/`.

---

## 5. Model & Database

### Tabel Utama

| Model | Tabel | Keterangan |
|-------|-------|------------|
| `User` | `users` | Pelanggan + admin, support Google OAuth |
| `Product` | `products` | Katalog produk, HasMedia (cover+gallery), HasTags |
| `Category` | `categories` | Kategori produk, HasMedia (image), nested tree |
| `Banner` | `banners` | Banner/slider homepage, HasMedia (image hero) |
| `SalesOrder` | `sales_orders` | Order transaksi, memiliki state machine |
| `SalesOrderItem` | `sales_order_items` | Item dalam order, relasi ke Product via SKU |
| `UserCartItem` | `user_cart_items` | Keranjang persisten untuk user login |
| `UserAddress` | `user_addresses` | Address book user (multi-alamat) |
| `Coupon` | `coupons` | Kode diskon (percent / fixed) |
| `ProductReview` | `product_reviews` | Review+rating dari pembeli terverifikasi |
| `ProductQuestion` | `product_questions` | Tanya jawab produk |
| `StockWaitlist` | `stock_waitlists` | Notifikasi stok tersedia |
| `CartReminder` | `cart_reminders` | Pengingat keranjang abandonded |
| `Page` | `pages` | Halaman statis (About, Terms, Privacy) |
| `Region` | `regions` | Data wilayah Indonesia (kecamatan/kota) |
| `Tag` | `tags` | Tag produk (via Spatie Tags, multi-type) |

### Relasi Penting

```
Product ──M:M──► Category
Product ──M:M──► Tag
Product ──1:M──► ProductReview
Product ──1:M──► ProductQuestion
Product ──1:M──► SalesOrderItem (via sku)
Product ──M:M──► User (wishlists)

SalesOrder ──1:M──► SalesOrderItem
SalesOrder ──M:1──► User

User ──1:M──► SalesOrder
User ──1:M──► UserAddress
User ──1:M──► ProductReview
User ──1:M──► UserCartItem
```

### Media Collections

| Model | Collection | Disk | Keterangan |
|-------|-----------|------|------------|
| `Product` | `cover` | public | Foto utama (1 file, single) |
| `Product` | `gallery` | public | Galeri foto (multiple) |
| `Category` | `image` | public | Gambar kategori (1 file) |
| `Banner` | `image` | public | Gambar banner hero (1 file) |
| `Page` | `image` | public | Gambar halaman statis |

> **Penting**: Nama collection harus **sama persis** di Model, Form Filament, dan saat `getFirstMediaUrl('xxx')`.

---

## 6. Fitur Frontend (Livewire)

### Halaman Publik

| Komponen | Route | Deskripsi |
|----------|-------|-----------|
| `HomePage` | `/` | Beranda: featured, latest, popular products, banner slider |
| `ProductCatalog` | `/catalog` | Katalog: search, filter kategori/tag, sort, pagination |
| `ProductDetail` | `/products/{slug}` | Detail produk, gallery, review, Q&A, related |
| `Cart` | `/cart` | Keranjang belanja |
| `Checkout` | `/checkout` | Form checkout lengkap |
| `TrackOrder` | `/track-order` | Lacak pesanan via nomor resi |
| `PageStatic` | `/pages/{slug}` | Halaman statis (About, Terms, dll) |
| `GlobalSearch` | _(komponen)_ | Search global produk di navbar |
| `CategoryMenu` | _(komponen)_ | Menu navigasi kategori |

### Fitur Autentikasi

| Komponen | Route | Deskripsi |
|----------|-------|-----------|
| Login/Register | `/login`, `/register` | Autentikasi lokal |
| Google OAuth | `/auth/google` | Login via Google |

### Halaman Akun (Auth Required)

| Komponen | Route | Deskripsi |
|----------|-------|-----------|
| `Account\Profile` | `/account/profile` | Edit profil pengguna |
| `Account\Orders` | `/account/orders` | Riwayat pesanan |
| `Wishlist` | `/account/wishlist` | Daftar wishlist |
| `SalesOrderDetail` | `/orders/{trx_id}` | Detail pesanan + upload bukti bayar |

### Fitur Produk

- **Wishlist**: Toggle (tambah/hapus), notifikasi price drop otomatis
- **Reviews**: Form review untuk *verified buyer*, rating 1–5, moderasi admin
- **Q&A**: Tanya jawab produk, admin bisa menjawab
- **Add to Cart**: Session-based (tamu) + database (user login)
- **Stok Waitlist**: Daftar antrian notifikasi saat stok tersedia kembali

---

## 7. Admin Panel (Filament)

**URL**: `/back` | **Role**: `super_admin` atau `panel_user`

### Resources Admin

| Resource | Path | Fitur |
|----------|------|-------|
| Products | `/back/products` | CRUD + upload cover/gallery, tag, kategori, flash sale |
| Categories | `/back/categories` | CRUD + upload gambar, urutan, aktif/nonaktif |
| Banners | `/back/banners` | CRUD + upload gambar hero, link, urutan |
| Coupons | `/back/coupons` | CRUD + tipe (percent/fixed), periode, batas pemakaian |
| SalesOrders | `/back/sales-orders` | Lihat + ubah status, upload nomor resi |
| ProductReviews | `/back/product-reviews` | Moderasi (approve/reject) |
| ProductQuestions | `/back/product-questions` | Jawab pertanyaan produk |
| Pages | `/back/pages` | CRUD halaman statis |
| Users | `/back/users` | Manajemen akun pengguna |

### Dashboard Widgets

| Widget | Keterangan |
|--------|------------|
| `SalesStatsWidget` | Total revenue, order, customer hari ini/minggu/bulan |
| `RevenueChartWidget` | Grafik revenue 30 hari terakhir |
| `OrderStatusChartWidget` | Chart distribusi status order |
| `LatestOrdersWidget` | 5 order terbaru |
| `LowStockTableWidget` | Produk dengan stok ≤ 5 |
| `TopProductsWidget` | 5 produk terlaris |

---

## 8. Integrasi Eksternal

### Payment Drivers

| Driver | Class | Keterangan |
|--------|-------|------------|
| Offline | `OfflinePaymentDriver` | Transfer manual, konfirmasi admin |
| Moota | `MootaPaymentDriver` | Auto-detect mutasi bank BCA via Moota webhook |
| Xendit | `XenditPaymentDriver` | Virtual Account / QRIS via Xendit |

**Cara tambah payment baru**:
1. Buat `app/Drivers/Payment/NamaDriver.php` implements `PaymentDriverInterface`
2. Daftarkan di `PaymentMethodQueryService`

### Shipping Drivers

| Driver | Class | Keterangan |
|--------|-------|------------|
| Offline | `OfflineShippingDriver` | Ongkir tetap, tanpa API eksternal |
| Komerce | `KomerceShippingDriver` | Cek ongkir via Komerce API |
| APIKurir | `APIKurirShippingDriver` | Cek ongkir via APIKurir.id |

**Cara tambah kurir baru**:
1. Buat `app/Drivers/Shipping/NamaDriver.php` implements `ShippingDriverInterface`
2. Daftarkan di `ShippingMethodService`

### Google OAuth

- Provider: `Google`
- Callback: `GET /auth/google/callback`
- Konfigurasi: `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT_URI`

### Moota Webhook

- Endpoint: `POST /webhook/moota`
- Verifikasi: `WEBHOOK_CLIENT_SECRET` via Spatie Webhook Client
- Flow: Moota kirim mutasi → webhook receiver → `approvePaymentUsingTrxId()`

---

## 9. Event & Listener

| Event | Listener | Keterangan |
|-------|---------|------------|
| `SalesOrderCreatedEvent` | `SendOrderConfirmationEmailListener` | Email konfirmasi order ke pelanggan |
| `SalesOrderCreatedEvent` | `NotifyAdminsNewOrderListener` | Notifikasi in-app ke admin |
| `SalesOrderCreatedEvent` | `GeneratePaymentLinkListener` | Generate link pembayaran (Xendit) |
| `SalesOrderProgressedEvent` | `SalesOrderProgressedListener` | Email update status ke pelanggan |
| `SalesOrderCompletedEvent` | `SalesOrderCompletedListener` | Email pesanan selesai |
| `SalesOrderCancelledEvent` | `SalesOrderCancelledListener` | Email pembatalan + restock |
| `SalesOrderProofUploadedEvent` | `NotifyAdminsProofUploadedListener` | Notifikasi admin ada bukti bayar baru |
| `ShippingReceiptNumberUpdateEvent` | `ShippingReceiptNumberUpdatedListener` | Email nomor resi ke pelanggan |
| `ProductRestockedEvent` | `NotifyStockWaitlistListener` | Email ke semua user di waitlist |

> **Semua Listener mengimplementasikan `ShouldQueue`** — berjalan di background queue.

---

## 10. Email & Notifikasi

### Mailable

| Class | Trigger | Penerima |
|-------|---------|----------|
| `SalesOrderCreatedMail` | Order baru dibuat | Pelanggan |
| `SalesOrderProgressedMail` | Status order diperbarui | Pelanggan |
| `SalesOrderCompletedMail` | Order selesai | Pelanggan |
| `SalesOrderCancelledMail` | Order dibatalkan | Pelanggan |
| `ShippingReceiptNumberUpdatedMail` | Nomor resi diinput admin | Pelanggan |
| `StockAvailableMail` | Stok produk tersedia kembali | User waitlist |
| `WishlistPriceDropMail` | Harga produk di wishlist turun | User |
| `AbandonedCartMail` | Keranjang tidak di-checkout > X jam | Pelanggan |

### Notifikasi Database (In-App)

| Class | Target | Keterangan |
|-------|--------|------------|
| `NewSalesOrderNotification` | Admin (`super_admin`, `panel_user`) | Order baru masuk |
| `ProofOfPaymentUploadedNotification` | Admin | Bukti bayar diunggah |
| `LowStockAlertNotification` | Admin | Stok produk hampir habis |

---

## 11. State Mesin Order

Status order menggunakan **Spatie Model States** (`app/States/SalesOrder/`).

```
[PENDING]
    │
    ├── (admin konfirmasi pembayaran)
    ▼
[PROGRESSING]
    │
    ├── (admin input nomor resi)
    ▼
[SHIPPING]
    │
    ├── (kurir konfirmasi terima)
    ▼
[COMPLETED]

[PENDING / PROGRESSING]
    │
    ├── (user/admin batalkan)
    ▼
[CANCELLED]
```

---

## 12. Deployment & Infrastruktur

### Konfigurasi Production (Koyeb + Aiven MySQL)

- **Hosting**: [Koyeb.com](https://koyeb.com) — gratis, deploy via Dockerfile
- **Database**: [Aiven.io MySQL](https://aiven.io) — cloud MySQL gratis 5GB
- **Media Storage**: Storage lokal di container (sesuaikan ke S3/R2 untuk production skala besar)
- **Queue**: `database` driver (job dijalankan via `php artisan queue:work`)

### Environment Variables Penting

```ini
APP_NAME="Riva & Co."
APP_ENV=production
APP_KEY=base64:...
APP_URL=https://nama-app.koyeb.app

DB_CONNECTION=mysql
DB_HOST=mysql-xxx.aivencloud.com
DB_PORT=13227
DB_DATABASE=defaultdb
DB_USERNAME=avnadmin
DB_PASSWORD=...

FILESYSTEM_DISK=public
QUEUE_CONNECTION=database
SESSION_DRIVER=database
CACHE_STORE=database

MOOTA_ACCESS_TOKEN=...
MOOTA_ACCOUNTS='[{...}]'
KOMERCE_API_KEY=...
XENDIT_SECRET_KEY=...
XENDIT_WEBHOOK_TOKEN=...
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
```

### Dockerfile & Entrypoint

File `Dockerfile` dan `docker-entrypoint.sh` di root project mengatur:
1. Build PHP 8.2 + Nginx
2. Install Composer dependencies
3. Build Vite assets
4. Jalankan `php artisan migrate --force` saat container start
5. Jalankan `php artisan storage:link`
6. Serve di port 8080

---

## 13. Perintah Umum

```bash
# Development (server + queue + vite bersamaan)
composer dev

# Migrasi database
php artisan migrate

# Isi data awal (produk, kategori, halaman statis)
php artisan db:seed

# Isi data spesifik (produk + gambar dari Unsplash)
php artisan db:seed --class=ProductSeeder

# Format kode PHP (Pint)
php artisan pint

# Jalankan test
php artisan test

# Generate Filament Shield (roles + permissions)
php artisan shield:generate
php artisan shield:install --fresh

# Clear semua cache
php artisan optimize:clear

# Queue worker
php artisan queue:work

# Optimasi production
php artisan optimize
```

---

## 14. Alur Checkout Lengkap

```
1. User menambahkan produk ke cart
   └── AddToCard (Livewire) → UserCartService / SessionCartService

2. User membuka /checkout
   └── Checkout (Livewire) → load CartData via DTO

3. User mengisi form:
   ├── Nama, email, telepon (CustomerData)
   ├── Alamat pengiriman (cari region → RegionQueryService → RegionData)
   ├── Pilih metode pengiriman (ShippingMethodService → ShippingData)
   └── Pilih metode pembayaran (PaymentMethodQueryService → PaymentData)

4. User klik "Place Order"
   └── Checkout::placeOrder()
       ├── Validasi stok (ValidateCartStock Action)
       ├── DB::transaction() {
       │   ├── Buat SalesOrder (SalesOrderService)
       │   ├── Buat SalesOrderItem[]
       │   ├── Kurangi stok produk (lockForUpdate + decrement)
       │   └── Kosongkan cart
       │   }
       └── Fire SalesOrderCreatedEvent

5. Event: SalesOrderCreatedEvent
   ├── SendOrderConfirmationEmailListener (email ke pelanggan)
   ├── NotifyAdminsNewOrderListener (notifikasi ke admin)
   └── GeneratePaymentLinkListener (generate link Xendit jika pakai Xendit)

6. User diarahkan ke halaman konfirmasi (/orders/{trx_id})
   └── SalesOrderDetail (Livewire)
       └── Upload bukti bayar → Fire SalesOrderProofUploadedEvent
           └── NotifyAdminsProofUploadedListener

7. Admin mengkonfirmasi di panel /back/sales-orders
   └── Ubah status → PROGRESSING
   └── Input nomor resi → Fire ShippingReceiptNumberUpdateEvent
       └── ShippingReceiptNumberUpdatedListener (email nomor resi ke pelanggan)

8. Order selesai / dibatalkan
   └── Fire SalesOrderCompletedEvent / SalesOrderCancelledEvent
       └── Email notifikasi ke pelanggan
       └── (Jika cancelled) Restock stok produk
```

---

*Dokumentasi ini dibuat secara otomatis dari hasil audit kode sumber project WebStore. Perbarui dokumen ini setiap kali ada fitur baru yang ditambahkan.*
