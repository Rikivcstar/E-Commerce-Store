<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure categories exist
        $categoriesData = [
            ['name' => 'Fashion & Apparel', 'slug' => 'fashion-apparel', 'description' => 'Pakaian modern dan stylish untuk pria & wanita.'],
            ['name' => 'Electronics & Gadgets', 'slug' => 'electronics-gadgets', 'description' => 'Perangkat elektronik & gadget canggih terkini.'],
            ['name' => 'Footwear & Shoes', 'slug' => 'footwear-shoes', 'description' => 'Alas kaki & sepatu berkualitas tinggi untuk kenyamanan harian.'],
            ['name' => 'Accessories & Watches', 'slug' => 'accessories-watches', 'description' => 'Aksesori & jam tangan eksklusif pelengkap gaya Anda.'],
            ['name' => 'Home & Living', 'slug' => 'home-living', 'description' => 'Peralatan rumah tangga & dekorasi minimalis.'],
        ];

        $categories = [];
        foreach ($categoriesData as $catData) {
            $categories[$catData['slug']] = Category::firstOrCreate(
                ['slug' => $catData['slug']],
                [
                    'name' => $catData['name'],
                    'description' => $catData['description'],
                    'is_active' => true,
                    'order_column' => 0,
                ]
            );
        }

        // 2. Sample 20 Products list
        $products = [
            // ELECTRONICS
            [
                'name' => 'Wireless Noise Canceling Headphones Pro',
                'category' => 'electronics-gadgets',
                'price' => 2499000,
                'stock' => 25,
                'weight' => 350,
                'description' => 'Headphone nirkabel dengan fitur Active Noise Cancellation (ANC) tingkat tinggi, suara bass bertenaga, dan baterai tahan hingga 30 jam.',
                'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&q=80',
            ],
            [
                'name' => 'Smartwatch Series 9 OLED Display',
                'category' => 'electronics-gadgets',
                'price' => 3200000,
                'stock' => 15,
                'weight' => 200,
                'description' => 'Jam tangan pintar layar Always-On OLED dengan pemantau detak jantung, kadar oksigen darah, dan pelacak kebugaran presisi tinggi.',
                'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&q=80',
            ],
            [
                'name' => 'Mechanical RGB Wireless Gaming Keyboard',
                'category' => 'electronics-gadgets',
                'price' => 1150000,
                'stock' => 30,
                'weight' => 850,
                'description' => 'Keyboard mekanikal dengan switch hotswap tactile, pencahayaan RGB dapat disesuaikan, dan koneksi Bluetooth multi-device.',
                'image_url' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=800&q=80',
            ],
            [
                'name' => 'Ergonomic Precision Wireless Mouse',
                'category' => 'electronics-gadgets',
                'price' => 650000,
                'stock' => 45,
                'weight' => 120,
                'description' => 'Mouse nirkabel ergonimis dengan sensor optic 16.000 DPI, scroll wheel ultra-fast, dan daya tahan baterai 70 hari.',
                'image_url' => 'https://images.unsplash.com/photo-1615663245857-ac93bb7c39e7?w=800&q=80',
            ],
            [
                'name' => 'Portable Waterproof Bluetooth Speaker',
                'category' => 'electronics-gadgets',
                'price' => 890000,
                'stock' => 20,
                'weight' => 500,
                'description' => 'Speaker portabel tahan air IPX7 dengan suara surround 360 derajat dan durasi pemutaran hingga 12 jam nonstop.',
                'image_url' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=800&q=80',
            ],

            // FASHION & APPAREL
            [
                'name' => 'Minimalist Heavyweight Cotton T-Shirt',
                'category' => 'fashion-apparel',
                'price' => 189000,
                'stock' => 50,
                'weight' => 250,
                'description' => 'Kaos polos berbahan 100% Heavyweight Cotton 24s berkualitas tinggi. Potongan relaxed fit nyaman untuk pemakaian sehari-hari.',
                'image_url' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?w=800&q=80',
            ],
            [
                'name' => 'Classic Denim Trucker Jacket Modern Fit',
                'category' => 'fashion-apparel',
                'price' => 549000,
                'stock' => 18,
                'weight' => 800,
                'description' => 'Jaket denim klasik berbahan selvedge tebal dengan kancing logam premium dan potongan modern fit yang timeless.',
                'image_url' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?w=800&q=80',
            ],
            [
                'name' => 'Oversized Streetwear Fleece Hoodie Black',
                'category' => 'fashion-apparel',
                'price' => 399000,
                'stock' => 35,
                'weight' => 600,
                'description' => 'Sweater hoodie oversize berbahan katun fleece tebal dan hangat. Dilengkapi saku kangguru dan hoodie berlapis double.',
                'image_url' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&q=80',
            ],
            [
                'name' => 'Casual Wool Blend Slim Chino Pants',
                'category' => 'fashion-apparel',
                'price' => 349000,
                'stock' => 40,
                'weight' => 450,
                'description' => 'Celana chino kasual berbahan campuran katun twill berserat rapat. Potongan slim fit fleksibel untuk suasana formal maupun santai.',
                'image_url' => 'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=800&q=80',
            ],
            [
                'name' => 'Minimalist Linen Short Sleeve Shirt',
                'category' => 'fashion-apparel',
                'price' => 279000,
                'stock' => 25,
                'weight' => 200,
                'description' => 'Kemeja lengan pendek bahan linen alami murni yang adem dan menyerap keringat, cocok untuk iklim tropis.',
                'image_url' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=800&q=80',
            ],

            // FOOTWEAR
            [
                'name' => 'Classic Heritage Leather Low-Top Sneakers',
                'category' => 'footwear-shoes',
                'price' => 899000,
                'stock' => 20,
                'weight' => 900,
                'description' => 'Sepatu sneakers low-top berbahan kulit sintetis premium dengan sol karet vulkanisir yang tahan lama.',
                'image_url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80',
            ],
            [
                'name' => 'Ultralight Mesh Running Shoes White',
                'category' => 'footwear-shoes',
                'price' => 699000,
                'stock' => 30,
                'weight' => 500,
                'description' => 'Sepatu lari berbahan breathable mesh ultra ringan dengan bantalan foam yang empuk meredam benturan.',
                'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80',
            ],
            [
                'name' => 'Classic Leather Chelsea Boots Dark Brown',
                'category' => 'footwear-shoes',
                'price' => 1250000,
                'stock' => 12,
                'weight' => 1200,
                'description' => 'Sepatu bot Chelsea berbahan kulit asli dengan panel elastis samping untuk kemudahan pemakaian dan gaya elegan.',
                'image_url' => 'https://images.unsplash.com/photo-1638247025967-b4e38f787b76?w=800&q=80',
            ],
            [
                'name' => 'Comfort Slide Sandals Black Matte',
                'category' => 'footwear-shoes',
                'price' => 199000,
                'stock' => 50,
                'weight' => 300,
                'description' => 'Sandal slide berbahan EVA contoured bed yang ergonomis, nyaman digunakan untuk aktivitas santai harian.',
                'image_url' => 'https://images.unsplash.com/photo-1603808033192-082d6919d3e1?w=800&q=80',
            ],

            // ACCESSORIES & WATCHES
            [
                'name' => 'Automatic Stainless Steel Chronograph Watch',
                'category' => 'accessories-watches',
                'price' => 2850000,
                'stock' => 10,
                'weight' => 180,
                'description' => 'Jam tangan otomatis berbahan stainless steel 316L dengan kaca sapphire anti gores dan ketahanan air hingga 50m.',
                'image_url' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&q=80',
            ],
            [
                'name' => 'Genuine Leather Bifold Slim Wallet',
                'category' => 'accessories-watches',
                'price' => 299000,
                'stock' => 40,
                'weight' => 100,
                'description' => 'Dompet pria berbahan kulit sapi asli dengan proteksi RFID blocking untuk keamanan kartu Anda.',
                'image_url' => 'https://images.unsplash.com/photo-1627123424574-724758594e93?w=800&q=80',
            ],
            [
                'name' => 'Polarized Classic Acetate Sunglasses',
                'category' => 'accessories-watches',
                'price' => 450000,
                'stock' => 25,
                'weight' => 80,
                'description' => 'Kacamata hitam dengan lensa terpolarisasi perlindungan UV400 dan bingkai acetate ringan yang kokoh.',
                'image_url' => 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?w=800&q=80',
            ],

            // HOME & LIVING
            [
                'name' => 'Nordic Minimalist Ceramic Desk Lamp',
                'category' => 'home-living',
                'price' => 389000,
                'stock' => 20,
                'weight' => 950,
                'description' => 'Lampu meja berbahan keramik estetik dengan pencahayaan hangat warm white yang cocok untuk ruang belajar/tidur.',
                'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=800&q=80',
            ],
            [
                'name' => 'Stainless Steel Insulated Thermal Water Bottle',
                'category' => 'home-living',
                'price' => 229000,
                'stock' => 60,
                'weight' => 380,
                'description' => 'Tumbler insulasi vakum berbahan stainless steel food grade yang mampu menjaga suhu dingin/panas hingga 24 jam.',
                'image_url' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?w=800&q=80',
            ],
            [
                'name' => 'Aromatherapy Essential Oil Diffuser 500ml',
                'category' => 'home-living',
                'price' => 319000,
                'stock' => 35,
                'weight' => 420,
                'description' => 'Diffuser aromaterapi ultrasonik dengan lampu LED 7 warna dan fitur otomatis mati saat air habis.',
                'image_url' => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?w=800&q=80',
            ],
        ];

        foreach ($products as $pData) {
            $slug = Str::slug($pData['name']);

            // Jangan pernah me-regenerate SKU pada update ulang — SKU dipakai
            // sebagai relasi ke sales_order_items (dashboard, report, dll).
            $product = Product::where('slug', $slug)->first();

            if (! $product) {
                $sku = 'SKU-'.strtoupper(Str::random(6));

                $product = Product::create([
                    'slug' => $slug,
                    'name' => $pData['name'],
                    'sku' => $sku,
                    'description' => $pData['description'],
                    'stock' => $pData['stock'],
                    'price' => $pData['price'],
                    'weight' => $pData['weight'],
                ]);
            } else {
                $product->update([
                    'name' => $pData['name'],
                    'description' => $pData['description'],
                    'stock' => $pData['stock'],
                    'price' => $pData['price'],
                    'weight' => $pData['weight'],
                ]);
            }

            // Attach Category
            if (isset($categories[$pData['category']])) {
                $product->categories()->sync([$categories[$pData['category']]->id]);
            }

            // Attach Cover Image using Spatie Media Library
            if ($product->getMedia('cover')->isEmpty()) {
                try {
                    $product->addMediaFromUrl($pData['image_url'])
                        ->toMediaCollection('cover');
                } catch (\Throwable $e) {
                    // Fallback log or ignore if offline/timeout
                }
            }
        }
    }
}
