<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StockAvailableMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Product $product
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Stok Produk Tersedia Kembali — '.$this->product->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.products.stock-available',
            with: [
                'product' => $this->product,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}