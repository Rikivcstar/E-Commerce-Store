<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WishlistPriceDropMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $name,
        public string $slug,
        public float $oldPrice,
        public float $newPrice,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Harga Turun! '.$this->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.products.wishlist-price-drop',
            with: [
                'name' => $this->name,
                'slug' => $this->slug,
                'oldPrice' => $this->oldPrice,
                'newPrice' => $this->newPrice,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}