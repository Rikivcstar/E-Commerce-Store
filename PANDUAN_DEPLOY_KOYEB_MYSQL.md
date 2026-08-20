# 🚀 Panduan Deployment WebStore ke Koyeb (Menggunakan MySQL)

Dokumen ini berisi panduan langkah demi langkah untuk meng-host aplikasi **Laravel 12 + Livewire 3 + Filament 4 (WebStore)** secara **100% GRATIS** menggunakan **Koyeb** dan database **MySQL Cloud (Aiven.io)**.

---

## 🛠️ Prasyarat & Persiapan

1. **Akun GitHub**: Repositori kode proyek `webstore` sudah di-push ke GitHub.
2. **Akun Aiven.io**: Untuk database MySQL gratis 5 GB (tanpa kartu kredit).
3. **Akun Koyeb.com**: Untuk hosting aplikasi web Laravel secara gratis.

---

## 📌 Langkah 1: Buat Database MySQL Gratis di Aiven.io

1. Buka [https://aiven.io/](https://aiven.io/) dan **Sign Up** menggunakan akun GitHub/Email.
2. Pada Dashboard Aiven, klik **Create Service**.
3. Pilih service **MySQL**.
4. Pilih Cloud Provider (misal: AWS / GCP) dan pilih region terdekat (misal: Singapore / Frankfurt).
5. Pilih Plan **Free Tier** ($0/mo).
6. Tentukan nama service (misal: `webstore-mysql-db`) lalu klik **Create Service**.
7. Tunggu hingga status service berubah menjadi **Running** (sekitar 2-3 menit).
8. Salin informasi **Connection Details** dari dashboard Aiven:
   - **Host / Hostname**: `mysql-xxxx-xxxx.aivencloud.com`
   - **Port**: *(contoh: `24602` atau port acak yang diberikan)*
   - **User**: `avnadmin`
   - **Password**: *(Password rahasia dari Aiven)*
   - **Database Name**: `defaultdb`

> [!TIP]
> Anda bisa membuat database baru bernama `webstore` di Aiven, atau langsung menggunakan nama database bawaan `defaultdb`.

---

## 📌 Langkah 2: Unggah File Deployment ke GitHub

Pastikan file berikut sudah ada di root proyek Anda (file ini sudah otomatis dibuatkan):
- [`Dockerfile`](file:///c:/laraherd/webstore/Dockerfile)
- [`docker-entrypoint.sh`](file:///c:/laraherd/webstore/docker-entrypoint.sh)
- [`.dockerignore`](file:///c:/laraherd/webstore/.dockerignore)

Jalankan perintah berikut di terminal lokal Anda untuk mengirimkan file ke GitHub:

```bash
git add Dockerfile docker-entrypoint.sh .dockerignore PANDUAN_DEPLOY_KOYEB_MYSQL.md
git commit -m "Add Koyeb deployment files with MySQL configuration"
git push origin main
```

---

## 📌 Langkah 3: Membuat App & Service di Koyeb

1. Buka [https://app.koyeb.com/](https://app.koyeb.com/) dan login.
2. Klik tombol **Create Service** (atau **Create App**).
3. Pilih metode deployment: **GitHub**.
4. Hubungkan akun GitHub Anda dan pilih repositori `webstore`, lalu pilih branch `main`.
5. Pada bagian **Builder**:
   - Pilih **Dockerfile** *(Koyeb akan mendeteksi Dockerfile di repositori)*.
6. Pada bagian **Exposed Ports**:
   - Ubah/pastikan Port terisi: **`8000`** dengan protokol **HTTP**.
7. Scroll ke bagian **Environment Variables** untuk memasukkan konfigurasi aplikasi.

---

## 📌 Langkah 4: Pengaturan Environment Variables (ENV)

Tambahkan daftar Environment Variables berikut di dashboard Koyeb:

| Key | Value / Contoh | Keterangan |
| :--- | :--- | :--- |
| `APP_NAME` | `WebStore` | Nama aplikasi |
| `APP_ENV` | `production` | Mode produksi |
| `APP_DEBUG` | `false` | Matikan mode debug |
| `APP_KEY` | `base64:xxxxxxxxxxxxxxxxxxxx` | Salin dari `.env` lokal Anda |
| `APP_URL` | `https://<nama-app-anda>.koyeb.app` | URL domain Koyeb Anda |
| `DB_CONNECTION` | `mysql` | Menggunakan MySQL |
| `DB_HOST` | `mysql-xxxx.aivencloud.com` | Host dari Aiven |
| `DB_PORT` | `24602` | Port khusus dari Aiven |
| `DB_DATABASE` | `defaultdb` | Nama database di Aiven |
| `DB_USERNAME` | `avnadmin` | Username MySQL Aiven |
| `DB_PASSWORD` | `xxxxxxxxxxxx` | Password MySQL Aiven |
| `QUEUE_CONNECTION` | `sync` | Antrean langsung diproses |
| `SESSION_DRIVER` | `database` | Sesi disimpan di database |
| `CACHE_STORE` | `database` | Cache disimpan di database |
| `FILESYSTEM_DISK` | `local` | Storage default |

Setelah semua variabel diisi, klik tombol **Deploy**.

---

## 📌 Langkah 5: Otomatisasi Migrasi & Server Start

Saat Koyeb selesai meng-compile Docker Image, script `docker-entrypoint.sh` akan otomatis:
1. Menjalankan `php artisan config:cache`, `route:cache`, `view:cache`.
2. Menjalankan migrasi database otomatis ke MySQL Aiven (`php artisan migrate --force`).
3. Menjalankan `php artisan storage:link`.
4. Menjalankan server Laravel di port 8000.

---

## 💡 Opsional: Menjalankan Seeder (Mengisi Data Awal Produk & Admin)

Jika Anda ingin mengisi data awal (kategori, produk, user admin) ke database MySQL Aiven:

1. Ubah file `.env` lokal Anda sementara agar terhubung ke Aiven:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=mysql-xxxx.aivencloud.com
   DB_PORT=24602
   DB_DATABASE=defaultdb
   DB_USERNAME=avnadmin
   DB_PASSWORD=password_aiven_anda
   ```
2. Jalankan perintah seeder dari komputer lokal Anda:
   ```bash
   php artisan db:seed
   ```
3. Kembalikan `.env` lokal Anda ke konfigurasi semula (`DB_HOST=127.0.0.1` / `sqlite`).

---

## ✅ Selesai!

Web E-Commerce Anda sekarang sudah aktif secara gratis di `https://<nama-app-anda>.koyeb.app` menggunakan database MySQL Cloud! 🎉
