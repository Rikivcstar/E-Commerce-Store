<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'name' => 'Panduan Ukuran & Perawatan Produk',
                'slug' => 'panduan-ukuran-dan-perawatan',
                'excerpt' => 'Temukan panduan memilih ukuran baju & sepatu yang pas serta tips perawatan lengkap agar pakaian favorit Anda tetap tampil prima dan tahan lama.',
                'is_active' => true,
                'is_featured' => true,
                'image_url' => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=1200&q=80',
                'context' => <<<'MARKDOWN'
# Panduan Ukuran & Perawatan Produk

Selamat datang di panduan resmi NEXORA. Kami ingin memastikan setiap produk yang Anda beli pas di badan dan memiliki daya tahan maksimal.

---

## 1. Panduan Ukuran (Size Chart)

### Pakaian Pria & Wanita (Regular & Relaxed Fit)

| Ukuran | Lingkar Dada (cm) | Lingkar Pinggang (cm) | Panjang Baju (cm) |
| :--- | :--- | :--- | :--- |
| **S** | 92 - 96 | 76 - 80 | 68 |
| **M** | 98 - 102 | 82 - 86 | 70 |
| **L** | 104 - 108 | 88 - 92 | 72 |
| **XL** | 110 - 114 | 94 - 98 | 74 |
| **XXL** | 116 - 120 | 100 - 104 | 76 |

*Tips: Jika Anda berada di antara dua ukuran, kami menyarankan untuk memilih ukuran yang lebih besar demi kenyamanan.*

### Panduan Ukuran Sepatu (Footwear)

- **EUR 39 / US 7**: Panjang Insole 24.5 cm
- **EUR 40 / US 7.5**: Panjang Insole 25.0 cm
- **EUR 41 / US 8.5**: Panjang Insole 26.0 cm
- **EUR 42 / US 9**: Panjang Insole 26.5 cm
- **EUR 43 / US 10**: Panjang Insole 27.5 cm
- **EUR 44 / US 10.5**: Panjang Insole 28.0 cm

---

## 2. Petunjuk Perawatan Produk

### Bahan Cotton & Heavyweight Fleece
- Cuci menggunakan air dingin atau hangat kuku (maksimal 30°C).
- Gunakan deterjen lembut tanpa bahan pemutih.
- Hindari menyikat terlalu keras pada area sablon/bordir.
- Jemur pakaian di tempat yang teduh dan hindari sinar matahari langsung agar warna tidak cepat pudar.

### Bahan Leather & Denim
- Jangan mencuci produk berbahan kulit asli dengan mesin cuci.
- Gunakan kain lap lembap dan kondisioner khusus kulit untuk menjaga kelembapan bahan.
- Untuk denim, cuci bagian dalam di luar (*inside out*) setelah beberapa kali pemakaian untuk mempertahankan karakter warna alami denim.

---

*Butuh bantuan memilih ukuran? Hubungi Layanan Pelanggan kami via WhatsApp atau Live Chat siap membantu 24/7.*
MARKDOWN,
            ],
            [
                'name' => 'Kebijakan Pengembalian & Garansi 15 Hari',
                'slug' => 'kebijakan-pengembalian-dan-garansi',
                'excerpt' => 'Nikmati belanja tanpa ragu dengan jaminan pengembalian & penukaran produk hingga 15 hari setelah pesanan diterima.',
                'is_active' => true,
                'is_featured' => true,
                'image_url' => 'https://images.unsplash.com/photo-1556742049-0a67568d0490?w=1200&q=80',
                'context' => <<<'MARKDOWN'
# Kebijakan Pengembalian & Garansi 15 Hari

Di NEXORA, kepuasan Anda adalah prioritas utama kami. Jika produk yang Anda terima tidak sesuai, mengalami cacat pabrik, atau ukurannya kurang pas, kami menyediakan fasilitas pengembalian dan penukaran barang yang mudah dan cepat.

---

## Ketentuan Pengembalian Barang

1. **Jangka Waktu**: Pengajuan retur dapat dilakukan dalam waktu maksimal **15 hari** sejak barang diterima oleh pembeli.
2. **Kondisi Produk**:
   - Produk dalam kondisi baru, belum pernah dipakai atau dicuci.
   - Hangtag dan label harga masih terpasang utuh.
   - Dikemas kembali rapi menggunakan kemasan asli NEXORA.
3. **Produk Cacat / Salah Kirim**: Seluruh ongkos kirim retur dan pengiriman ulang akan ditanggung penuh oleh NEXORA.
4. **Penukaran Ukuran (Size Exchange)**: Penukaran ukuran dapat dilakukan selama stok masih tersedia.

---

## Alur Pengajuan Retur

1. **Hubungi Customer Service**: Sertakan nomor pesanan (Trx ID) dan video unboxing paket.
2. **Konfirmasi CS**: Tim kami akan memverifikasi pengajuan Anda dalam waktu 1x24 jam.
3. **Kirim Produk Kembali**: Kirim produk ke alamat gudang resmi kami yang tertera pada instruksi CS.
4. **Pemeriksaan & Pengiriman Replacement**: Setelah barang sampai dan lolos QC, produk pengganti atau refund dana akan diproses dalam 2 hari kerja.

---

*Catatan: Produk dalam kategori promo Flash Sale / Final Clearance tidak dapat dikembalikan kecuali mengalami kerusakan manufaktur.*
MARKDOWN,
            ],
            [
                'name' => 'Metode Pembayaran & Keamanan Transaksi',
                'slug' => 'metode-pembayaran-dan-keamanan',
                'excerpt' => 'Berbagai opsi pembayaran aman dan fleksibel — QRIS, Transfer Bank Virtual Account, hingga Kartu Kredit dengan enkripsi tingkat tinggi.',
                'is_active' => true,
                'is_featured' => true,
                'image_url' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=1200&q=80',
                'context' => <<<'MARKDOWN'
# Metode Pembayaran & Keamanan Transaksi

NEXORA mendukung sistem pembayaran yang serba otomatis, aman, dan instan untuk memudahkan Anda berbelanja kapan saja dan di mana saja.

---

## Opsi Pembayaran Yang Tersedia

### 1. QRIS (Instant Approval)
Bayar dengan cepat menggunakan QRIS dari aplikasi GoPay, OVO, Dana, ShopeePay, LinkAja, atau Mobile Banking pilihan Anda (BCA, Mandiri, BRI, BNI).

### 2. Transfer Bank (Virtual Account)
Pengecekan otomatis tanpa perlu unggah bukti transfer:
- **BCA Virtual Account**
- **Bank Mandiri VA**
- **BRI & BNI VA**
- **Bank Permata / Danamon**

### 3. Kartu Kredit & Debit Online
Kami menerima kartu berpintu **Visa**, **Mastercard**, dan **JCB** dengan proteksi 3D Secure (OTP).

---

## Keamanan & Proteksi Data Pembeli

Sistem pembayaran NEXORA terhubung langsung dengan *Payment Gateway* terlisensi resmi yang diawasi oleh Bank Indonesia dan OJK.

- **SSL 256-bit Encryption**: Seluruh data transaksi dienkripsi dengan standar enkripsi tertinggi.
- **Privacy Assurance**: Data pribadi dan informasi kartu kredit Anda tidak pernah disimpan di server kami.

---

*Segera lakukan konfirmasi transaksi jika menggunakan transfer manual dalam kurun waktu 1x24 jam untuk menghindari pembatalan otomatis oleh sistem.*
MARKDOWN,
            ],
            [
                'name' => 'Informasi Pengiriman & Pelacakan Paket',
                'slug' => 'informasi-pengiriman-dan-pelacakan',
                'excerpt' => 'Dapatkan informasi lengkap mengenai opsi ekspedisi pengiriman, biaya ongkir, estimasi waktu tiba, dan pelacakan pesanan secara real-time.',
                'is_active' => true,
                'is_featured' => true,
                'image_url' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=1200&q=80',
                'context' => <<<'MARKDOWN'
# Informasi Pengiriman & Pelacakan Paket

Kami bekerja sama dengan penyedia jasa kurir terpercaya untuk memastikan paket Anda sampai tepat waktu, aman, dan dalam kondisi sempurna.

---

## Mitranya Ekspedisi Kami

- **Kurir Reguler**: JNE Express, J&T Express, SiCepat Ekspres, Anteraja.
- **Kurir Instant / Sameday**: GoSend, GrabExpress (Khusus area Jabodetabek).

---

## Gratis Ongkir & Estimasi Pengiriman

- **Promo Gratis Ongkos Kirim**: Nikmati potongan ongkir gratis hingga Rp 50.000 untuk minimal transaksi **Rp 500.000**.
- **Jabodetabek & Kota Besar Jawa**: 1 - 3 hari kerja.
- **Luar Pulau Jawa & Area Pelosok**: 3 - 6 hari kerja.

---

## Pelacakan Pesanan Real-Time

Setelah pembayaran dikonfirmasi, nomor resi pengiriman akan terbit secara otomatis. Anda dapat melacak posisi paket melalui:

1. Halaman **[My Orders](/account/orders)** setelah masuk ke akun Anda.
2. Link pelacakan yang dikirimkan via Email / WhatsApp notifikasi pesanan.

---

*Setiap pengiriman dijamin oleh asuransi pengiriman resmi. Jika paket hilang atau rusak selama perjalanan, kami akan mengirimkan pengganti 100% baru.*
MARKDOWN,
            ],
            [
                'name' => 'Syarat & Ketentuan Layanan',
                'slug' => 'syarat-dan-ketentuan-layanan',
                'excerpt' => 'Aturan dan ketentuan resmi penggunaan platform belanja NEXORA, pembuatan akun pengguna, serta hukum yang berlaku.',
                'is_active' => true,
                'is_featured' => false,
                'image_url' => 'https://images.unsplash.com/photo-1450133064473-71024230f91b?w=1200&q=80',
                'context' => <<<'MARKDOWN'
# Syarat & Ketentuan Layanan

Selamat datang di platform NEXORA. Dengan mengakses dan berbelanja di situs web ini, Anda dianggap telah membaca, memahami, dan menyetujui seluruh Syarat & Ketentuan yang berlaku di bawah ini.

---

## 1. Akun Pengguna & Keamanan
- Anda bertanggung jawab untuk menjaga kerahasiaan kata sandi dan informasi akun pribadi Anda.
- Informasi yang Anda daftarkan harus merupakan data yang akurat, benar, dan terkini.

## 2. Pemesanan & Pembatalan
- Pesanan yang telah dikonfirmasi dan dibayar tidak dapat dibatalkan secara sepihak kecuali stok barang habis.
- NEXORA berhak membatalkan transaksi apabila terindikasi adanya kecurangan atau pelanggaran syarat penggunaan promo.

## 3. Hak Kekayaan Intelektual
- Seluruh konten pada situs ini, termasuk nama merek NEXORA, logo, desain grafis, foto produk, dan tulisan adalah hak cipta terdaftar milik NEXORA.
- Dilarang keras menggandakan atau mengompilasi ulang materi tanpa izin tertulis dari manajemen NEXORA.

---

*Syarat dan ketentuan ini dapat diperbarui sewaktu-waktu tanpa pemberitahuan sebelumnya. Kebijakan terbaru akan selalu dipublikasikan di halaman ini.*
MARKDOWN,
            ],
        ];

        foreach ($pages as $pData) {
            $page = Page::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'name' => $pData['name'],
                    'excerpt' => $pData['excerpt'],
                    'context' => $pData['context'],
                    'is_active' => $pData['is_active'],
                    'is_featured' => $pData['is_featured'],
                ]
            );

            // Attach Cover Image using Spatie Media Library
            if ($page->getMedia('image')->isEmpty() && !empty($pData['image_url'])) {
                try {
                    $page->addMediaFromUrl($pData['image_url'])
                        ->toMediaCollection('image');
                } catch (\Throwable $e) {
                    logger()->error("Failed to download image for page {$page->slug}: " . $e->getMessage());
                }
            }
        }
    }
}
