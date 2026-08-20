@component('mail::message')
# Harga Turun! 🎉

Produk wishlist Anda **{{ $name }}** kini lebih murah:

- **Harga Sekarang**: {{ \Illuminate\Support\Number::currency($newPrice) }}
- **Harga Sebelumnya**: <s>{{ \Illuminate\Support\Number::currency($oldPrice) }}</s>

Ini saat yang tepat untuk membelinya!

@component('mail::button', ['url' => route('product', $slug)])
    Lihat Produk
@endcomponent

Terima kasih, — **Riva & Co.**
@endcomponent