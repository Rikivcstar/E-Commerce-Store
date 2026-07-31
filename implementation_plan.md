# Rencana Implementasi Layanan Pengiriman Biteship

Dokumen ini berisi rencana teknis untuk mengintegrasikan layanan agregator ekspedisi **Biteship** ke dalam aplikasi Webstore sebagai pengganti/tambahan dari API Kurir yang bermasalah.

## User Review Required

> [!IMPORTANT]
> - **API Key Biteship**: Anda perlu mendaftar di [biteship.com](https://biteship.com) untuk mendapatkan API Key Sandbox/Production (`BITESHIP_API_KEY`).
> - **Pengaturan Origin (Pengirim)**: Biteship membutuhkan Kode Pos 5 digit atau ID Area untuk asal pengiriman (*origin*).

## Proposed Changes

---

### 1. Konfigurasi Aplikasi (`config` & `.env`)

#### [MODIFY] [shipping.php](file:///c:/laraherd/webstore/config/shipping.php)
- Menambahkan konfigurasi `biteship` (API Key & Base URL) pada array konfigurasi `config/shipping.php`.

#### [MODIFY] [.env](file:///c:/laraherd/webstore/.env)
- Menambahkan env key `BITESHIP_API_KEY` dan `BITESHIP_BASE_URL=https://api.biteship.com/v1`.

---

### 2. Driver Pengiriman (`app/Drivers/Shipping`)

#### [NEW] [BiteshipShippingDriver.php](file:///c:/laraherd/webstore/app/Drivers/Shipping/BiteshipShippingDriver.php)
- Membuat class `BiteshipShippingDriver` yang mengimplementasikan [ShippingDriverInterface](file:///c:/laraherd/webstore/app/Contract/ShippingDriverInterface.php).
- Method `getServices()`: Mendefinisikan daftar kurir dan layanan yang didukung (misal: JNE Reguler, SiCepat REG, Anteraja, J&T EZ).
- Method `getRate()`: Mengirim request `POST https://api.biteship.com/v1/rates/couriers` menggunakan Laravel `Http::withToken(...)`, menerima response ongkos kirim & estimasi waktu, lalu memetakan ke objek [ShippingData](file:///c:/laraherd/webstore/app/Data/ShippingData.php).

---

### 3. Pendaftaran Driver di Service (`app/Services`)

#### [MODIFY] [ShippingMethodService.php](file:///c:/laraherd/webstore/app/Services/ShippingMethodService.php)
- Memasukkan `new BiteshipShippingDriver()` ke dalam properti `$this->drivers` di `ShippingMethodService`.
- *(Opsional)* Menonaktifkan `APIKurirShippingDriver` agar checkout tidak tertahan oleh timeout API Kurir Sandbox.

---

## Verification Plan

### Automated Verification
- Membuat script pengujian menggunakan PHP untuk memastikan integrasi HTTP client Biteship mengembalikan data tarif ongkir (*rates*) dan estimasi pengiriman secara benar.

### Manual Verification
- Membuka halaman checkout website (`http://webstore.test/checkout`).
- Memilih wilayah pengiriman (*destination region*) dan menguji pemuatan opsi pengiriman Biteship di UI browser.
