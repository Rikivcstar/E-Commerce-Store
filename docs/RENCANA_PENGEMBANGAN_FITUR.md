# Rencana Pengembangan Fitur WebStore

Dokumen rencana fitur baru & penyesuaian sistem WebStore (Riva & Co.).
Status: **Usulan — belum dieksekusi**.

> Semua fitur baru wajib mengikuti aturan `AGENTS.md`:
> DTO (`app/Data/`), logic di Service/Action, side-effect lewat Event + queued Listener,
> transaksi stok dengan `lockForUpdate()`, Filament mengikuti pola `Resource + Pages + Schemas + Tables`,
> dan string UI baru ditambahkan ke `lang/id.json` + `lang/en.json` (fitur multi-bahasa sedang berjalan).

---

## Peta Fitur Saat Ini (hasil audit)

Sudah ada:

- **Authentication**: register/login Livewire, Google OAuth, verifikasi email, role (`super_admin`/`panel_user`/`Staff`).
- **Produk & katalog**: search, filter kategori/collection, sort (newest/latest/price/popular), flash sale, discount,
  wishlist + notifikasi price-drop, stock waitlist, recently viewed, recommendation (related/FBT/popular).
- **Review & Q&A**: rating 1–5 + moderasi, verifikasi "hanya pembeli", tanya jawab produk (admin menjawab & publish).
- **Cart**: session (tamu) + database (user), abandoned cart reminder.
- **Checkout**: region Indonesia, multi-alamat, kupon (percent/fixed), shipping driver (Komerce/APIKurir/Offline),
  payment driver (Xendit/Moota/Offline), upload bukti bayar.
- **Order**: state machine (Pending→Progress→Completed/Cancel), track order by nomor resi, invoice HTML, batalkan & beli lagi.
- **Admin (Filament)**: 9 resource + 6 dashboard widget, laporan penjualan.
- **Webhook**: Moota + Xendit (signature validation).
- **Email/Notifikasi**: 8+ mailable, schedule command (low stock, overdue order, abandoned cart, price-drop, retry invoice).
- **SEO**: sitemap, robots.txt, hreflang (in progress), Multi-bahasa ID/EN (in progress).

## Celah yang Ditemukan (analisis)

1. Tidak ada halaman edit profil user (nama, no. HP, password, avatar) — tabel `users` bahkan belum punya kolom `phone`.
2. Tidak ada kolom **catatan untuk penjual** pada order (umum di e-commerce Indonesia).
3. Filter katalog belum support **rentang harga**, **hanya stok tersedia**, **hanya diskon**.
4. Pertanyaan produk yang sudah dijawab **tidak mengirim notifikasi/email ke penanya**.
5. Review belum mendukung **foto**; tidak ada **reminder minta review** setelah order selesai.
6. Kupon hanya tipe `percent`/`fixed` — belum ada **gratis ongkir** maupun **free-shipping threshold**.
7. Flash sale field sudah ada di produk tapi **belum ada countdown timer / halaman flash sale khusus**.
8. Admin **belum bisa export CSV/Excel** (order, produk, laporan); belum ada **bulk actions**.
9. Phase multi-bahasa (spatie/laravel-translatable) **belum selesai** — kolom konten produk/kategori/halaman belum JSON.
10. **Belum ada structured data** (JSON-LD Product) & Open Graph tag untuk SEO sosial.
11. Dokumen `docs/SISTEM_DOKUMENTASI.md` sudah **tidak sinkron** dengan route & fitur aktual.

---

## Batch yang Diusulkan (prioritas tinggi → rendah)

### Batch 1 — UX & Data Pelanggan (quick win)

| ID | Fitur | File/komponen utama |
|----|-------|---------------------|
| F-01 | **Profil lengkap user**: tambah kolom `phone` (+ migrasi), halaman `Account\Profile` Livewire (nama/HP/password/avatar). Riwayat ganti password diaudit activitylog | migrasi `add_phone_to_users`, `app/Livewire/Account/Profile.php`, view baru, `app/Data/ProfileData.php` |
| F-02 | **Catatan untuk penjual** pada checkout → tersimpan di `SalesOrder` (`customer_note`), tampil di detail order user & admin | migrasi `add_customer_note_to_sales_orders`, update `CheckoutData`/`SalesOrderData`, tabel admin |
| F-03 | **Filter katalog**: rentang harga, `stok tersedia`, `sedang diskon` | `ProductCatalog.php` + query scope `Product` + view |

### Batch 2 — Konversi & Marketing

| ID | Fitur | File/komponen utama |
|----|-------|---------------------|
| F-04 | **Notifikasi jawaban Q&A**: saat admin menjawab, event + listener kirim email ke penanya | `app/Events/QuestionAnsweredEvent.php`, `app/Listeners/NotifyQuestionerListener.php`, `app/Mail/QuestionAnsweredMail.php` |
| F-05 | **Foto review** (collection media `review_photos`) + **reminder review** saat order Completed (scheduled command + email) | migrasi (review media), `ProductReview` `HasMedia`, `app/Console/Commands/SendReviewReminderCommand.php` |
| F-06 | **Kupon gratis ongkir** (type `free_shipping`) + **batas gratis ongkir** via kupon threshold di checkout | `CouponService::discount`/`isValid` + `CouponData` + Form admin |
| F-07 | **Flash sale countdown** di homepage & halaman khusus `/flash-sale` | `app/Livewire/FlashSale.php`, view countdown (Blade + JS), sitemap entry |

### Batch 3 — Admin & Operasional

| ID | Fitur | File/komponen utama |
|----|-------|---------------------|
| F-08 | **Export CSV/Excel** order & produk (pakai `spatie/simple-excel` atau `ExportAction` Filament) + **bulk actions** (ubah status, aktif/nonaktif produk) | Filament resource `Tables/*Table.php` + `Import/Export` component |
| F-09 | **Log aktivitas** (activitylog) terlihat di panel & halaman detail order; unclear reason: gunakan daftar activity yang sudah ada | `app/Filament/Resources/SalesOrders/.../ViewSalesOrder` tune-up, widget |
| F-10 | **Rekap produk habis + riwayat stok** (scope low-stock sudah ada; lengkapi audit via activitylog `stock`) | `Product` `getActivitylogOptions()` tambah attribute `stock` |

### Batch 4 — Kepercayaan, SEO & Skala

| ID | Fitur | File/komponen utama |
|----|-------|---------------------|
| F-11 | **JSON-LD Product schema + Open Graph** di `ProductDetail` & `HomePage` | layout `layouts/app.blade.php` + view `product-detail` |
| F-12 | **Permintaan retur/refund** dari user (state baru `ReturnRequested` opsional atau tabel `return_requests` + event/listener) | migrasi, `app/Models/ReturnRequest.php`, Filament resource |
| F-13 | **Cache katalog & banner** (`Cache::remember` / `rememberForever` + invalidate saat update) | `ProductCatalog::render`, service |
| F-14 | **Konsolidasi docs**: sinkronkan `docs/SISTEM_DOKUMENTASI.md` & `docs/RENCANA_MULTIBAHASA.md` | dokumen |

---

## Aturan Implementasi (wajib tiap fitur)

1. Fitur menyentuh stok/order → `DB::transaction()` + `lockForUpdate()` + `where` spesifik.
2. Integrasi eksternal → buat/ubah driver yang `implements` contract, daftarkan di resolver Service.
3. Side-effect (email/notifikasi) → Event + Listener `ShouldQueue`, bukan dipanggil di Service.
4. Data antar layer → DTO baru di `app/Data/`. Nama method English, label user-facing Indonesia (+ key `lang/*.json`).
5. Filament Resource mengikuti pola `Resource/Pages/Schemas/Tables`.
6. Model `HasMedia` wajib deklarasi `registerMediaCollections()`; nama collection konsisten.
7. Setiap fitur yang menambah kolom → migrasi baru (jangan ubah migrasi yang sudah pernah jalan).
8. Sebelum selesai: `php artisan pint` (perlu dijalankan user di Windows).

## Urutan Eksekusi yang Disarankan

1. **Selesaikan dulu Phase 2–4 multi-bahasa** (translatable konten + form admin) karena menyentuh model yang sama
   (Product/Category/Page) dan mengubah struktur kolom — lebih murah dikerjakan sebelum Batch feat lain.
2. Lalu **Batch 1** (F-01, F-02, F-03) — low risk, langsung terasa.
3. **Batch 2** (F-04 … F-07) — membantu konversi.
4. **Batch 3 & 4** — operasional & skala.

> Catatan: verifikasi lintas batch — string UI baru harus ikut masuk key terjemahan `lang/*.json`
> supaya tidak rusak saat dikerjakan paralel dengan fitur multi-bahasa.