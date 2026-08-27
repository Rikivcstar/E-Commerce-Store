<?php

/**
 * Script: update_media_deployed.php
 *
 * Tujuan: Memperbarui gambar produk, banner, dan kategori
 *         yang kosong di environment deployed (Aiven MySQL / production).
 *
 * Cara pakai:
 *   php update_media_deployed.php
 *
 * Script ini akan:
 *  1. Koneksi langsung ke MySQL Aiven (production)
 *  2. Membuat/memperbarui Banner (dengan gambar dari Unsplash)
 *  3. Menambah gambar ke produk yang masih kosong via Spatie Media Library
 *  4. Menambah gambar ke kategori yang masih kosong
 *
 * PENTING: Jalankan script ini dari folder root project (webstore/)
 *          Pastikan koneksi internet aktif (download gambar dari Unsplash)
 */

require __DIR__ . '/vendor/autoload.php';

// ─── Konfigurasi: isi lewat environment variable atau .env.production ──────
// JANGAN hardcode kredensial di sini! Gunakan env() atau file .env terpisah.
$DB_HOST     = getenv('DB_HOST')     ?: 'mysql-xxxxxxxx-xxxx-xxxx.d.aivencloud.com';
$DB_PORT     = getenv('DB_PORT')     ?: '13227';
$DB_DATABASE = getenv('DB_DATABASE') ?: 'defaultdb';
$DB_USERNAME = getenv('DB_USERNAME') ?: 'avnadmin';
$DB_PASSWORD = getenv('DB_PASSWORD') ?: '';
// ────────────────────────────────────────────────────────────────────────────

// Set env agar Laravel bootstrap menggunakan DB Aiven
putenv("DB_CONNECTION=mysql");
putenv("DB_HOST={$DB_HOST}");
putenv("DB_PORT={$DB_PORT}");
putenv("DB_DATABASE={$DB_DATABASE}");
putenv("DB_USERNAME={$DB_USERNAME}");
putenv("DB_PASSWORD={$DB_PASSWORD}");
putenv("FILESYSTEM_DISK=public");
putenv("APP_URL=http://localhost");

$_ENV['DB_CONNECTION'] = 'mysql';
$_ENV['DB_HOST']       = $DB_HOST;
$_ENV['DB_PORT']       = $DB_PORT;
$_ENV['DB_DATABASE']   = $DB_DATABASE;
$_ENV['DB_USERNAME']   = $DB_USERNAME;
$_ENV['DB_PASSWORD']   = $DB_PASSWORD;
$_ENV['FILESYSTEM_DISK'] = 'public';
$_ENV['APP_URL']         = 'http://localhost';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

// Helper: print berwarna di terminal
function info(string $msg): void  { echo "\033[36m[INFO]\033[0m  {$msg}\n"; }
function ok(string $msg): void    { echo "\033[32m[OK]\033[0m    {$msg}\n"; }
function warn(string $msg): void  { echo "\033[33m[WARN]\033[0m  {$msg}\n"; }
function fail(string $msg): void  { echo "\033[31m[FAIL]\033[0m  {$msg}\n"; }
function section(string $msg): void {
    echo "\n\033[35m" . str_repeat('═', 60) . "\033[0m\n";
    echo "\033[35m  {$msg}\033[0m\n";
    echo "\033[35m" . str_repeat('═', 60) . "\033[0m\n";
}

section("UPDATE MEDIA PRODUK & BANNER — PRODUCTION (Aiven MySQL)");
info("DB Host  : {$DB_HOST}:{$DB_PORT}");
info("Database : {$DB_DATABASE}");
echo "\n";

// ═══════════════════════════════════════════════════════════
// 1. UPDATE / CREATE BANNERS
// ═══════════════════════════════════════════════════════════
section("1. BANNERS");

$bannersData = [
    [
        'title'        => 'Koleksi Terbaru 2026',
        'subtitle'     => 'Temukan produk pilihan terbaik kami — fashion, elektronik, dan lifestyle.',
        'link_url'     => '/catalog',
        'button_label' => 'Belanja Sekarang',
        'is_active'    => true,
        'order_column' => 1,
        'image_url'    => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=1600&q=85',
    ],
    [
        'title'        => 'Flash Sale Akhir Bulan',
        'subtitle'     => 'Diskon hingga 40% untuk produk pilihan. Stok terbatas!',
        'link_url'     => '/catalog?sort=sale',
        'button_label' => 'Lihat Promo',
        'is_active'    => true,
        'order_column' => 2,
        'image_url'    => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1600&q=85',
    ],
    [
        'title'        => 'Gratis Ongkir ke Seluruh Indonesia',
        'subtitle'     => 'Untuk pembelian di atas Rp 200.000. Berlaku setiap hari!',
        'link_url'     => '/catalog',
        'button_label' => 'Mulai Belanja',
        'is_active'    => true,
        'order_column' => 3,
        'image_url'    => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1600&q=85',
    ],
];

foreach ($bannersData as $bData) {
    $banner = Banner::where('title', $bData['title'])->first();

    if (! $banner) {
        $banner = Banner::create([
            'title'        => $bData['title'],
            'subtitle'     => $bData['subtitle'],
            'link_url'     => $bData['link_url'],
            'button_label' => $bData['button_label'],
            'is_active'    => $bData['is_active'],
            'order_column' => $bData['order_column'],
        ]);
        info("Banner baru dibuat: \"{$bData['title']}\"");
    } else {
        $banner->update([
            'subtitle'     => $bData['subtitle'],
            'link_url'     => $bData['link_url'],
            'button_label' => $bData['button_label'],
            'is_active'    => $bData['is_active'],
            'order_column' => $bData['order_column'],
        ]);
        info("Banner diperbarui : \"{$bData['title']}\"");
    }

    // Tambah gambar jika belum ada
    if ($banner->getMedia('image')->isEmpty()) {
        try {
            $banner->addMediaFromUrl($bData['image_url'])
                ->toMediaCollection('image');
            ok("  Gambar banner berhasil ditambahkan.");
        } catch (\Throwable $e) {
            fail("  Gagal menambah gambar banner: " . $e->getMessage());
        }
    } else {
        warn("  Gambar banner sudah ada, skip.");
    }
}

// ═══════════════════════════════════════════════════════════
// 2. UPDATE GAMBAR KATEGORI
// ═══════════════════════════════════════════════════════════
section("2. GAMBAR KATEGORI");

$categoryImages = [
    'fashion-apparel'      => 'https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=800&q=80',
    'electronics-gadgets'  => 'https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=800&q=80',
    'footwear-shoes'       => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80',
    'accessories-watches'  => 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=800&q=80',
    'home-living'          => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80',
    'beauty-personal-care' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=800&q=80',
];

$categories = Category::all();
foreach ($categories as $category) {
    $slug = $category->slug;

    if ($category->getMedia('image')->isEmpty()) {
        $imageUrl = $categoryImages[$slug]
            ?? 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?w=800&q=80';

        try {
            $category->addMediaFromUrl($imageUrl)
                ->toMediaCollection('image');
            ok("Gambar kategori ditambahkan: \"{$category->name}\"");
        } catch (\Throwable $e) {
            fail("Gagal menambah gambar kategori \"{$category->name}\": " . $e->getMessage());
        }
    } else {
        warn("Kategori \"{$category->name}\" sudah ada gambar, skip.");
    }
}

// ═══════════════════════════════════════════════════════════
// 3. UPDATE GAMBAR PRODUK (YANG MASIH KOSONG)
// ═══════════════════════════════════════════════════════════
section("3. GAMBAR PRODUK (yang masih kosong)");

$productImageMap = [
    // Electronics
    'wireless-noise-canceling-headphones-pro'      => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
    'smartwatch-series-9-oled-display'             => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
    'mechanical-rgb-wireless-gaming-keyboard'      => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&q=80',
    'ergonomic-precision-wireless-mouse'           => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&q=80',
    'portable-waterproof-bluetooth-speaker'        => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&q=80',
    'ultra-hd-4k-webcam-studio-pro'               => 'https://images.unsplash.com/photo-1591405351990-4726e331f141?w=800&q=80',
    'fast-charging-powerbank-20000mah-65w'        => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=800&q=80',

    // Fashion
    'minimalist-heavyweight-cotton-t-shirt'        => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=800&q=80',
    'classic-denim-trucker-jacket-modern-fit'      => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&q=80',
    'oversized-streetwear-fleece-hoodie-black'     => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80',
    'casual-wool-blend-slim-chino-pants'           => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80',
    'minimalist-linen-short-sleeve-shirt'          => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=800&q=80',
    'urban-commuter-windbreaker-jacket'            => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80',
    'premium-oxford-cotton-button-down-shirt'      => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&q=80',

    // Footwear
    'classic-heritage-leather-low-top-sneakers'   => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80',
    'ultralight-mesh-running-shoes-white'          => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80',
    'classic-leather-chelsea-boots-dark-brown'     => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=800&q=80',
    'comfort-slide-sandals-black-matte'            => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=800&q=80',
    'retro-basketball-high-top-leather-sneakers'   => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800&q=80',

    // Accessories & Watches
    'automatic-stainless-steel-chronograph-watch' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&q=80',
    'genuine-leather-bifold-slim-wallet'           => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&q=80',
    'polarized-classic-acetate-sunglasses'         => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&q=80',
    'water-resistant-city-canvas-backpack'         => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80',

    // Home & Living
    'nordic-minimalist-ceramic-desk-lamp'          => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=800&q=80',
    'stainless-steel-insulated-thermal-water-bottle' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&q=80',
    'aromatherapy-essential-oil-diffuser-500ml'    => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80',

    // Beauty & Personal Care
    'hydrating-botanical-face-serum-50ml'          => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=800&q=80',
    'gentle-cleansing-facial-foam-oat-extract'     => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=800&q=80',
];

$fallbackImages = array_values($productImageMap);
$products = Product::all();

$updated = 0;
$skipped = 0;
$failed  = 0;

foreach ($products as $product) {
    if (! $product->getMedia('cover')->isEmpty()) {
        $skipped++;
        warn("Produk \"{$product->name}\" sudah ada gambar, skip.");
        continue;
    }

    // Cari URL gambar berdasarkan slug, lalu fallback ke array urut
    $imageUrl = $productImageMap[$product->slug]
        ?? $fallbackImages[$product->id % count($fallbackImages)];

    try {
        $product->addMediaFromUrl($imageUrl)
            ->toMediaCollection('cover');
        $updated++;
        ok("Gambar ditambahkan ke produk: \"{$product->name}\"");
    } catch (\Throwable $e) {
        $failed++;
        fail("Gagal untuk \"{$product->name}\": " . $e->getMessage());
    }
}

// ═══════════════════════════════════════════════════════════
// 4. BUAT / PERBARUI PRODUK YANG MUNGKIN BELUM ADA
// ═══════════════════════════════════════════════════════════
section("4. PASTIKAN PRODUK LENGKAP (upsert jika belum ada)");

$categoriesMap = Category::pluck('id', 'slug')->toArray();

$allProducts = [
    // Electronics
    ['name' => 'Wireless Noise Canceling Headphones Pro',   'cat' => 'electronics-gadgets', 'price' => 2499000, 'stock' => 25, 'weight' => 350,
     'desc' => 'Headphone nirkabel ANC tingkat tinggi, suara bass bertenaga, baterai 30 jam.',
     'img'  => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80'],

    ['name' => 'Smartwatch Series 9 OLED Display',          'cat' => 'electronics-gadgets', 'price' => 3200000, 'stock' => 15, 'weight' => 200,
     'desc' => 'Jam tangan pintar Always-On OLED, monitor detak jantung & oksigen darah.',
     'img'  => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80'],

    ['name' => 'Mechanical RGB Wireless Gaming Keyboard',   'cat' => 'electronics-gadgets', 'price' => 1150000, 'stock' => 30, 'weight' => 850,
     'desc' => 'Keyboard mekanikal hotswap tactile, RGB dapat disesuaikan, Bluetooth multi-device.',
     'img'  => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&q=80'],

    ['name' => 'Ergonomic Precision Wireless Mouse',        'cat' => 'electronics-gadgets', 'price' => 650000,  'stock' => 45, 'weight' => 120,
     'desc' => 'Mouse ergonomis sensor optic 16.000 DPI, baterai 70 hari.',
     'img'  => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&q=80'],

    ['name' => 'Portable Waterproof Bluetooth Speaker',     'cat' => 'electronics-gadgets', 'price' => 890000,  'stock' => 20, 'weight' => 500,
     'desc' => 'Speaker portabel IPX7, suara surround 360°, 12 jam pemutaran.',
     'img'  => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&q=80'],

    ['name' => 'Ultra HD 4K Webcam Studio Pro',             'cat' => 'electronics-gadgets', 'price' => 1450000, 'stock' => 18, 'weight' => 220,
     'desc' => 'Webcam 4K 60FPS, autofocus pintar, microphone ganda peredam bising.',
     'img'  => 'https://images.unsplash.com/photo-1591405351990-4726e331f141?w=800&q=80'],

    ['name' => 'Fast Charging Powerbank 20000mAh 65W',     'cat' => 'electronics-gadgets', 'price' => 590000,  'stock' => 40, 'weight' => 410,
     'desc' => 'Powerbank Power Delivery 65W untuk laptop dan smartphone.',
     'img'  => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=800&q=80'],

    // Fashion
    ['name' => 'Minimalist Heavyweight Cotton T-Shirt',     'cat' => 'fashion-apparel',     'price' => 189000,  'stock' => 50, 'weight' => 250,
     'desc' => 'Kaos 100% Heavyweight Cotton 24s, relaxed fit, nyaman sehari-hari.',
     'img'  => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=800&q=80'],

    ['name' => 'Classic Denim Trucker Jacket Modern Fit',   'cat' => 'fashion-apparel',     'price' => 549000,  'stock' => 18, 'weight' => 800,
     'desc' => 'Jaket denim selvedge tebal, kancing logam premium, modern fit timeless.',
     'img'  => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&q=80'],

    ['name' => 'Oversized Streetwear Fleece Hoodie Black',  'cat' => 'fashion-apparel',     'price' => 399000,  'stock' => 35, 'weight' => 600,
     'desc' => 'Hoodie oversize fleece tebal & hangat, saku kangguru, hoodie berlapis.',
     'img'  => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80'],

    ['name' => 'Casual Wool Blend Slim Chino Pants',        'cat' => 'fashion-apparel',     'price' => 349000,  'stock' => 40, 'weight' => 450,
     'desc' => 'Celana chino katun twill, slim fit, formal maupun santai.',
     'img'  => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80'],

    ['name' => 'Minimalist Linen Short Sleeve Shirt',       'cat' => 'fashion-apparel',     'price' => 279000,  'stock' => 25, 'weight' => 200,
     'desc' => 'Kemeja linen alami, adem & menyerap keringat, cocok iklim tropis.',
     'img'  => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=800&q=80'],

    ['name' => 'Urban Commuter Windbreaker Jacket',         'cat' => 'fashion-apparel',     'price' => 429000,  'stock' => 22, 'weight' => 380,
     'desc' => 'Jaket windbreaker tahan angin & gerimis, inner breathable mesh.',
     'img'  => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80'],

    ['name' => 'Premium Oxford Cotton Button-Down Shirt',   'cat' => 'fashion-apparel',     'price' => 329000,  'stock' => 30, 'weight' => 300,
     'desc' => 'Kemeja Oxford katun halus, kerja kasual maupun formal.',
     'img'  => 'https://images.unsplash.com/photo-1596755094514-f87e34085b2c?w=800&q=80'],

    // Footwear
    ['name' => 'Classic Heritage Leather Low-Top Sneakers', 'cat' => 'footwear-shoes',      'price' => 899000,  'stock' => 20, 'weight' => 900,
     'desc' => 'Sneakers low-top kulit sintetis premium, sol karet vulkanisir.',
     'img'  => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80'],

    ['name' => 'Ultralight Mesh Running Shoes White',       'cat' => 'footwear-shoes',      'price' => 699000,  'stock' => 30, 'weight' => 500,
     'desc' => 'Sepatu lari breathable mesh ultra ringan, bantalan foam empuk.',
     'img'  => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80'],

    ['name' => 'Classic Leather Chelsea Boots Dark Brown',  'cat' => 'footwear-shoes',      'price' => 1250000, 'stock' => 12, 'weight' => 1200,
     'desc' => 'Chelsea boots kulit asli, panel elastis samping, gaya elegan.',
     'img'  => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=800&q=80'],

    ['name' => 'Comfort Slide Sandals Black Matte',         'cat' => 'footwear-shoes',      'price' => 199000,  'stock' => 50, 'weight' => 300,
     'desc' => 'Sandal slide EVA ergonomis, nyaman untuk aktivitas santai harian.',
     'img'  => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=800&q=80'],

    ['name' => 'Retro Basketball High-Top Leather Sneakers','cat' => 'footwear-shoes',      'price' => 1099000, 'stock' => 15, 'weight' => 1100,
     'desc' => 'Sneakers high-top retro, pergelangan empuk, sol anti slip.',
     'img'  => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800&q=80'],

    // Accessories
    ['name' => 'Automatic Stainless Steel Chronograph Watch','cat' => 'accessories-watches','price' => 2850000, 'stock' => 10, 'weight' => 180,
     'desc' => 'Jam tangan otomatis stainless steel 316L, kaca sapphire, tahan air 50m.',
     'img'  => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&q=80'],

    ['name' => 'Genuine Leather Bifold Slim Wallet',        'cat' => 'accessories-watches', 'price' => 299000,  'stock' => 40, 'weight' => 100,
     'desc' => 'Dompet kulit sapi asli, proteksi RFID blocking.',
     'img'  => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&q=80'],

    ['name' => 'Polarized Classic Acetate Sunglasses',      'cat' => 'accessories-watches', 'price' => 450000,  'stock' => 25, 'weight' => 80,
     'desc' => 'Kacamata lensa terpolarisasi UV400, bingkai acetate ringan & kokoh.',
     'img'  => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&q=80'],

    ['name' => 'Water Resistant City Canvas Backpack',      'cat' => 'accessories-watches', 'price' => 499000,  'stock' => 28, 'weight' => 750,
     'desc' => 'Ransel kanvas tahan air, kompartemen laptop 15.6 inci, slot tumbler.',
     'img'  => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80'],

    // Home & Living
    ['name' => 'Nordic Minimalist Ceramic Desk Lamp',       'cat' => 'home-living',         'price' => 389000,  'stock' => 20, 'weight' => 950,
     'desc' => 'Lampu meja keramik estetik, warm white, cocok untuk ruang belajar/tidur.',
     'img'  => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=800&q=80'],

    ['name' => 'Stainless Steel Insulated Thermal Water Bottle','cat' => 'home-living',     'price' => 229000,  'stock' => 60, 'weight' => 380,
     'desc' => 'Tumbler vakum food grade, jaga suhu dingin/panas hingga 24 jam.',
     'img'  => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&q=80'],

    ['name' => 'Aromatherapy Essential Oil Diffuser 500ml', 'cat' => 'home-living',         'price' => 319000,  'stock' => 35, 'weight' => 420,
     'desc' => 'Diffuser ultrasonik, lampu LED 7 warna, auto off saat air habis.',
     'img'  => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80'],

    // Beauty
    ['name' => 'Hydrating Botanical Face Serum 50ml',       'cat' => 'beauty-personal-care','price' => 249000,  'stock' => 50, 'weight' => 150,
     'desc' => 'Serum wajah Hyaluronic Acid + Niacinamide, kelembapan ekstra.',
     'img'  => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?w=800&q=80'],

    ['name' => 'Gentle Cleansing Facial Foam Oat Extract',  'cat' => 'beauty-personal-care','price' => 129000,  'stock' => 60, 'weight' => 180,
     'desc' => 'Pembersih wajah lembut ekstrak oatmeal alami, tidak bikin kulit kering.',
     'img'  => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=800&q=80'],
];

$createdCount = 0;
foreach ($allProducts as $pData) {
    $slug = Str::slug($pData['name']);
    $product = Product::where('slug', $slug)->first();

    if (! $product) {
        $sku = 'SKU-' . strtoupper(Str::random(6));
        $product = Product::create([
            'slug'        => $slug,
            'name'        => $pData['name'],
            'sku'         => $sku,
            'description' => $pData['desc'],
            'stock'       => $pData['stock'],
            'price'       => $pData['price'],
            'weight'      => $pData['weight'],
        ]);

        // Attach kategori
        if (isset($categoriesMap[$pData['cat']])) {
            $product->categories()->sync([$categoriesMap[$pData['cat']]]);
        }

        // Tambah gambar
        try {
            $product->addMediaFromUrl($pData['img'])->toMediaCollection('cover');
            ok("Produk baru dibuat + gambar: \"{$pData['name']}\"");
        } catch (\Throwable $e) {
            warn("Produk dibuat, GAGAL gambar \"{$pData['name']}\": " . $e->getMessage());
        }
        $createdCount++;
    }
}

// ═══════════════════════════════════════════════════════════
// SUMMARY
// ═══════════════════════════════════════════════════════════
section("RINGKASAN");

$totalBanners    = Banner::count();
$totalCategories = Category::count();
$totalProducts   = Product::count();
$withCover       = Product::whereHas('media', fn($q) => $q->where('collection_name', 'cover'))->count();
$noCover         = $totalProducts - $withCover;

echo "  Banners total      : {$totalBanners}\n";
echo "  Kategori total     : {$totalCategories}\n";
echo "  Produk total       : {$totalProducts}\n";
echo "  Produk dgn gambar  : \033[32m{$withCover}\033[0m\n";
echo "  Produk tanpa gambar: \033[33m{$noCover}\033[0m\n";
echo "  Produk baru dibuat : \033[36m{$createdCount}\033[0m\n";
echo "  Media diperbarui   : \033[32m{$updated}\033[0m\n";
echo "  Media skip         : {$skipped}\n";
echo "  Gagal              : \033[31m{$failed}\033[0m\n";

echo "\n\033[32m✅ Selesai! Refresh halaman deployed untuk melihat perubahan.\033[0m\n\n";
