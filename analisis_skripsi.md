# 📊 Analisis Project E-Commerce untuk Bahan Skripsi

## 1. Inventarisasi Fitur Project Saat Ini

Berdasarkan analisis kode sumber project **Laravel 12 WebStore**, berikut adalah fitur-fitur yang sudah ada:

### Tech Stack
| Komponen | Teknologi |
|----------|-----------|
| Backend Framework | Laravel 12 |
| Frontend UI | Preline UI (Tailwind CSS) |
| Reactive UI | Livewire 3 |
| Admin Panel | Filament 4.0 |
| Media Library | Spatie Media Library |
| Data Transfer Objects | Spatie Laravel Data |
| State Management | Spatie Model States |
| Tagging | Spatie Laravel Tags |
| Activity Logging | Spatie Activity Log |

### Fitur yang Sudah Ada

| No | Fitur | Detail Implementasi |
|----|-------|---------------------|
| 1 | **Homepage** | Menampilkan featured, latest, dan popular products (random query) |
| 2 | **Product Catalog** | Search by name, filter by collection/tag, sort (newest, latest, price asc/desc), pagination |
| 3 | **Single Product Page** | Detail produk dengan media/gambar |
| 4 | **Shopping Cart** | Session-based cart (add, update, remove, clear) |
| 5 | **Checkout** | Form lengkap (customer info, alamat, region, shipping, payment) |
| 6 | **Order Processing** | Generate TRX ID, stock validation & decrement, transaction-safe |
| 7 | **Order Confirmation** | Halaman konfirmasi pesanan |
| 8 | **Region/Area System** | Pencarian wilayah untuk alamat pengiriman |
| 9 | **Shipping Integration** | Driver-based architecture (saat ini: Offline Driver) |
| 10 | **Payment Integration** | Driver-based architecture (saat ini: Offline Driver) |
| 11 | **Admin Panel (Filament)** | CRUD produk dengan media upload |
| 12 | **Stock Management** | Validasi stok saat checkout, pengurangan stok otomatis |

---

## 2. Analisis Kekuatan & Kelemahan

### ✅ Kekuatan
- **Arsitektur bersih**: Menggunakan DTO (Data Transfer Objects), Services, Actions, Contract (Interface)
- **Driver Pattern**: Payment & Shipping menggunakan driver pattern, mudah di-extend
- **Modern Stack**: Laravel 12 + Livewire 3 + Filament 4 (teknologi terkini 2026)
- **Transaction Safety**: Checkout menggunakan DB transaction + lock for update

### ❌ Kelemahan / Yang Belum Ada
- **Tidak ada autentikasi pelanggan** (guest checkout only)
- **Tidak ada AI/Machine Learning** sama sekali
- **Tidak ada sistem review/rating** produk
- **Tidak ada wishlist**
- **Tidak ada rekomendasi produk** (saat ini hanya random)
- **Tidak ada chatbot/customer service**
- **Tidak ada analitik penjualan** yang cerdas
- **Tidak ada sistem notifikasi** (email/WhatsApp)
- **Payment & Shipping masih offline** (belum integrasi real API)
- **Tidak ada order tracking** yang fungsional
- **Tidak ada fitur promo/diskon/voucher**

---

## 3. Gap Analysis — Peluang untuk Skripsi

> [!IMPORTANT]
> Project ini **BISA dijadikan bahan skripsi**, tetapi perlu penambahan fitur yang menjadi **novelty (kebaruan)** agar judulnya kuat dan bisa di-ACC. Tanpa fitur tambahan, project ini hanya "toko online biasa" yang terlalu umum untuk skripsi.

### Mengapa Perlu Tambahan AI?

Dosen pembimbing umumnya mencari:
1. **Kebaruan** — apa yang membedakan dari skripsi sejenis?
2. **Metode/Algoritma** — ada penerapan ilmu yang dipelajari di kampus
3. **Kontribusi** — apa manfaat nyata bagi pengguna?

Menambahkan **AI/Machine Learning** adalah strategi **terbaik** karena:
- Sedang trend dan relevan dengan perkembangan teknologi
- Memberikan kesan "bobot akademis" yang tinggi
- Mudah diukur hasilnya (akurasi, presisi, recall, dll)

---

## 4. 🏆 Rekomendasi Judul Skripsi (Diurutkan dari Paling Mudah di-ACC)

---

### 🥇 Judul #1 (PALING DIREKOMENDASIKAN)

> **"Implementasi Sistem Rekomendasi Produk Menggunakan Metode Content-Based Filtering dan Collaborative Filtering pada Website E-Commerce Berbasis Laravel"**

| Aspek | Detail |
|-------|--------|
| **Fitur yang ditambahkan** | Sistem rekomendasi produk berbasis AI yang mempersonalisasi tampilan produk berdasarkan riwayat browsing & pembelian |
| **Algoritma** | Content-Based Filtering (kesamaan atribut produk) + Collaborative Filtering (kesamaan perilaku user) |
| **Mengapa mudah ACC?** | ✅ Topik sangat relevan (Netflix, Amazon, Tokopedia pakai ini) · ✅ Ada metode yang bisa diuji · ✅ Bisa diukur dengan metrik (Precision, Recall, F1-Score, MAE) · ✅ Banyak referensi jurnal |
| **Yang perlu ditambahkan ke project** | 1. Autentikasi user (login/register) · 2. Tabel `user_product_views` & `user_product_ratings` · 3. Service `RecommendationEngine` dengan algoritma CF & CBF · 4. Halaman "Rekomendasi Untuk Anda" |
| **Metode Penelitian** | R&D (Research and Development) atau Eksperimen |
| **Pengujian** | Black-box testing + pengujian akurasi rekomendasi |

---

### 🥈 Judul #2

> **"Penerapan Chatbot Berbasis Natural Language Processing (NLP) untuk Meningkatkan Pelayanan Pelanggan pada Platform E-Commerce Berbasis Laravel"**

| Aspek | Detail |
|-------|--------|
| **Fitur yang ditambahkan** | Chatbot AI yang bisa menjawab pertanyaan seputar produk, status pesanan, dan panduan belanja |
| **Algoritma** | Integrasi API OpenAI/Gemini + RAG (Retrieval-Augmented Generation) dengan data produk lokal |
| **Mengapa mudah ACC?** | ✅ Sangat relevan dengan era AI · ✅ Bisa demo langsung ke dosen · ✅ Measurable (response time, akurasi jawaban, user satisfaction) |
| **Yang perlu ditambahkan** | 1. Chatbot widget di frontend · 2. Backend endpoint untuk proses chat · 3. Knowledge base dari data produk · 4. Logging percakapan |
| **Metode Penelitian** | R&D atau Waterfall/Agile |
| **Pengujian** | Usability testing (SUS) + pengujian akurasi respons chatbot |

---

### 🥉 Judul #3

> **"Analisis dan Implementasi Metode Apriori untuk Fitur Cross-Selling pada Sistem E-Commerce Berbasis Laravel"**

| Aspek | Detail |
|-------|--------|
| **Fitur yang ditambahkan** | "Pelanggan yang membeli ini juga membeli..." berdasarkan analisis pola pembelian |
| **Algoritma** | Association Rule Mining — Algoritma Apriori |
| **Mengapa mudah ACC?** | ✅ Algoritma Apriori sangat populer di skripsi Informatika · ✅ Konsep data mining yang kuat · ✅ Bisa diukur dengan Support, Confidence, Lift |
| **Yang perlu ditambahkan** | 1. Tabel `order_history` yang lebih lengkap · 2. Service `AprioriEngine` · 3. Tampilan "Sering dibeli bersamaan" di halaman produk & cart · 4. Dashboard analitik di admin |
| **Metode Penelitian** | Eksperimen |
| **Pengujian** | Pengujian nilai Support & Confidence + Black-box testing |

---

### 🏅 Judul #4

> **"Rancang Bangun Sistem E-Commerce dengan Fitur Prediksi Stok Menggunakan Metode Moving Average untuk Optimalisasi Manajemen Inventori"**

| Aspek | Detail |
|-------|--------|
| **Fitur yang ditambahkan** | Dashboard prediksi stok di admin panel yang membantu pemilik toko mengetahui kapan harus restock |
| **Algoritma** | Simple Moving Average / Weighted Moving Average / Exponential Smoothing |
| **Mengapa mudah ACC?** | ✅ Aplikatif dan praktikal · ✅ Metode statistik yang jelas · ✅ Bisa diukur dengan MAPE (Mean Absolute Percentage Error) |
| **Yang perlu ditambahkan** | 1. Tabel `stock_histories` · 2. Service `StockPredictionEngine` · 3. Dashboard prediksi di Filament admin · 4. Grafik & alert restock |
| **Metode Penelitian** | R&D |
| **Pengujian** | Pengujian akurasi prediksi (MAPE) + Black-box testing |

---

### 🎖️ Judul #5

> **"Implementasi Analisis Sentimen Review Produk Menggunakan Metode Naive Bayes untuk Meningkatkan Kepercayaan Konsumen pada Platform E-Commerce Berbasis Laravel"**

| Aspek | Detail |
|-------|--------|
| **Fitur yang ditambahkan** | Sistem review/rating + analisis sentimen otomatis (positif/negatif/netral) |
| **Algoritma** | Naive Bayes Classifier untuk klasifikasi sentimen |
| **Mengapa mudah ACC?** | ✅ Topik NLP & sentiment analysis sangat populer · ✅ Banyak dataset training tersedia · ✅ Bisa diukur dengan Accuracy, Precision, Recall |
| **Yang perlu ditambahkan** | 1. Fitur review & rating produk · 2. Model `ProductReview` · 3. Service `SentimentAnalyzer` · 4. Label sentimen otomatis · 5. Dashboard sentimen di admin |
| **Metode Penelitian** | Eksperimen |
| **Pengujian** | Confusion Matrix + Accuracy Testing + Black-box testing |

---

## 5. Perbandingan Ringkas Semua Judul

| No | Judul | Tingkat Kesulitan | Peluang ACC | Waktu Pengerjaan | Kebaruan |
|----|-------|-------------------|-------------|-------------------|----------|
| 1 | Sistem Rekomendasi (CBF + CF) | ⭐⭐⭐ Sedang | 🟢 Sangat Tinggi | 2-3 bulan | ⭐⭐⭐⭐ |
| 2 | Chatbot NLP | ⭐⭐⭐ Sedang | 🟢 Sangat Tinggi | 2-3 bulan | ⭐⭐⭐⭐⭐ |
| 3 | Cross-Selling Apriori | ⭐⭐ Mudah | 🟢 Tinggi | 1-2 bulan | ⭐⭐⭐ |
| 4 | Prediksi Stok Moving Average | ⭐⭐ Mudah | 🟡 Tinggi | 1-2 bulan | ⭐⭐⭐ |
| 5 | Sentimen Naive Bayes | ⭐⭐⭐⭐ Agak Sulit | 🟢 Tinggi | 2-3 bulan | ⭐⭐⭐⭐ |

---

## 6. Rekomendasi Akhir

> [!TIP]
> **Judul #1 (Sistem Rekomendasi) atau Judul #2 (Chatbot NLP)** adalah pilihan terbaik karena:
> - Paling relevan dengan trend teknologi 2026
> - Memberikan kesan modern dan inovatif kepada dosen
> - Mudah di-demo (visual & interaktif)
> - Referensi jurnal sangat banyak
> - Project e-commerce Anda sudah cukup lengkap sebagai fondasi

> [!NOTE]
> Jika ingin yang **paling cepat selesai & paling mudah**, pilih **Judul #3 (Apriori)** — algoritma ini paling sering digunakan di skripsi dan dosen sudah sangat familiar.

---

## 7. Langkah Selanjutnya

Setelah Anda memilih judul, saya bisa langsung membantu:
1. 📝 Menyusun **BAB 1 (Pendahuluan)** — latar belakang, rumusan masalah, tujuan
2. 🏗️ Membuat **implementation plan** untuk fitur tambahan yang diperlukan
3. 💻 Mengoding fitur AI yang dipilih langsung ke dalam project ini
4. 📊 Menyiapkan **metode pengujian** dan evaluasi
