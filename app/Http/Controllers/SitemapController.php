<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $products = Product::query()
            ->select('slug', 'updated_at')
            ->orderByDesc('updated_at')
            ->limit(5000)
            ->get();

        $pages = Page::query()
            ->active()
            ->select('slug', 'updated_at')
            ->get();

        return response()
            ->view('sitemap', [
                'products' => $products,
                'pages' => $pages,
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}