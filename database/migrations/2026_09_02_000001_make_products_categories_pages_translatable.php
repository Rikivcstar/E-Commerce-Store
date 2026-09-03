<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Mengonversi kolom name/description/excerpt/context
     * menjadi format JSON {"id":"...","en":"..."} agar
     * trait Spatie HasTranslations dapat membaca per-locale.
     */
    public function up(): void
    {
        DB::transaction(function () {
            foreach (Product::query()->get() as $product) {
                $name = $product->getOriginal('name');
                $description = $product->getOriginal('description');

                Model::withoutEvents(function () use ($product, $name, $description) {
                    $product->fill([
                        'name' => ['id' => $name, 'en' => $name],
                        'description' => $description !== null
                            ? ['id' => $description, 'en' => $description]
                            : null,
                    ]);
                    $product->save();
                });
            }

            foreach (Category::query()->get() as $category) {
                $name = $category->getOriginal('name');
                $description = $category->getOriginal('description');

                Model::withoutEvents(function () use ($category, $name, $description) {
                    $category->fill([
                        'name' => ['id' => $name, 'en' => $name],
                        'description' => $description !== null
                            ? ['id' => $description, 'en' => $description]
                            : null,
                    ]);
                    $category->save();
                });
            }

            foreach (Page::query()->get() as $page) {
                $name = $page->getOriginal('name');
                $excerpt = $page->getOriginal('excerpt');
                $context = $page->getOriginal('context');

                Model::withoutEvents(function () use ($page, $name, $excerpt, $context) {
                    $page->fill([
                        'name' => ['id' => $name, 'en' => $name],
                        'excerpt' => $excerpt !== null
                            ? ['id' => $excerpt, 'en' => $excerpt]
                            : null,
                        'context' => $context !== null
                            ? ['id' => $context, 'en' => $context]
                            : null,
                    ]);
                    $page->save();
                });
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * Mengembalikan kolom ke bentuk string biasa
     * (mengambil nilai locale "id" dari JSON).
     */
    public function down(): void
    {
        DB::transaction(function () {
            foreach (Product::query()->get() as $product) {
                $name = json_decode($product->getAttributes()['name'] ?? '', true)['id'] ?? null;
                $description = json_decode($product->getAttributes()['description'] ?? '', true)['id'] ?? null;

                Model::withoutEvents(function () use ($product, $name, $description) {
                    $product->setRawAttributes([
                        'name' => $name,
                        'description' => $description,
                    ], false);
                    $product->save();
                });
            }

            foreach (Category::query()->get() as $category) {
                $name = json_decode($category->getAttributes()['name'] ?? '', true)['id'] ?? null;
                $description = json_decode($category->getAttributes()['description'] ?? '', true)['id'] ?? null;

                Model::withoutEvents(function () use ($category, $name, $description) {
                    $category->setRawAttributes([
                        'name' => $name,
                        'description' => $description,
                    ], false);
                    $category->save();
                });
            }

            foreach (Page::query()->get() as $page) {
                $name = json_decode($page->getAttributes()['name'] ?? '', true)['id'] ?? null;
                $excerpt = json_decode($page->getAttributes()['excerpt'] ?? '', true)['id'] ?? null;
                $context = json_decode($page->getAttributes()['context'] ?? '', true)['id'] ?? null;

                Model::withoutEvents(function () use ($page, $name, $excerpt, $context) {
                    $page->setRawAttributes([
                        'name' => $name,
                        'excerpt' => $excerpt,
                        'context' => $context,
                    ], false);
                    $page->save();
                });
            }
        });
    }
};