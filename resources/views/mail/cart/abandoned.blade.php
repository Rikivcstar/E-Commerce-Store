@component('mail::message')
# Hai {{ $customerName }}! 👋

Sepertinya Anda masih ragu — keranjang belanja Anda berisi produk berikut dan masih menunggu untuk diselesaikan:

@foreach ($items as $item)
- **{{ $item->name }}** (× {{ $item->quantity }}) — {{ $item->price_formatted }}
@endforeach

Stok bisa berubah sewaktu-waktu. Selesaikan pesanan Anda sekarang sebelum kehabisan!

@component('mail::button', ['url' => route('cart')])
    Lihat Keranjang Saya
@endcomponent

Terima kasih, — **Riva & Co.**
@endcomponent
