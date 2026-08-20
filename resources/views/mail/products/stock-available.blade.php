@component('mail::message')
# Halo! 🎉

Produk yang Anda tunggu sudah **tersedia kembali**:

## {{ $product->name }}

@if ($product->getFirstMediaUrl('cover'))
![{{ $product->name }}]({{ $product->getFirstMediaUrl('cover') }})
@endif

- **Harga**: {{ \Illuminate\Support\Number::currency($product->price) }}
- **Stok**: Tersedia

Jangan sampai kehabisan lagi!

@component('mail::button', ['url' => route('product', $product->slug)])
    Lihat Produk Sekarang
@endcomponent

Terima kasih sudah menunggu. — **Riva & Co.**
@endcomponent