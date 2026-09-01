<div>
    <x-layouts.app title="Lacak Pesanan">
        <style>
            .track-shell {
                max-width: 40rem;
                margin: 0 auto;
                padding: 3rem clamp(1rem, 4vw, 2.5rem) 5rem;
            }
            .track-eyebrow {
                font-size: 0.7rem;
                font-weight: 900;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: #8a8470;
                margin-bottom: 0.5rem;
            }
            .track-title {
                font-family: 'Syne', 'Finlandica', sans-serif;
                font-size: clamp(2.5rem, 7vw, 4.5rem);
                font-weight: 900;
                letter-spacing: -0.03em;
                text-transform: uppercase;
                color: #111111;
                line-height: 0.88;
                margin-bottom: 0.75rem;
            }
            .track-sub {
                color: #777777;
                font-size: 0.9rem;
                margin-bottom: 1.75rem;
            }
            .track-card {
                border: 1px solid #d4cec4;
                background: #ffffff;
                padding: 1.5rem;
            }
            .track-field {
                margin-bottom: 1rem;
            }
            .track-label {
                display: block;
                font-size: 0.72rem;
                font-weight: 700;
                color: #374151;
                margin-bottom: 0.35rem;
            }
            .track-input {
                width: 100%;
                border: 1.5px solid #e5e7eb;
                border-radius: 0.6rem;
                padding: 0.8rem 1rem;
                font-size: 0.875rem;
                color: #111111;
                background: #fafafa;
                outline: none;
                transition: all 0.2s;
                box-sizing: border-box;
            }
            .track-input::placeholder {
                color: #b0b7bf;
            }
            .track-input:focus {
                border-color: #111111;
                background: #ffffff;
                box-shadow: 0 0 0 3px rgba(17, 17, 17, 0.08);
            }
            .track-input.error {
                border-color: #ef4444;
            }
            .track-error {
                font-size: 0.72rem;
                color: #ef4444;
                font-weight: 600;
                margin-top: 0.3rem;
            }
            .track-btn {
                width: 100%;
                padding: 0.85rem 1rem;
                background-color: #111111;
                color: #ffffff;
                font-weight: 800;
                font-size: 0.82rem;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                border: none;
                border-radius: 0.6rem;
                cursor: pointer;
                transition: all 0.25s;
                margin-top: 0.25rem;
            }
            .track-btn:hover {
                background-color: #333333;
            }
            .track-btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }
            .track-note {
                text-align: center;
                font-size: 0.8rem;
                color: #9ca3af;
                margin-top: 1.25rem;
            }
            .track-note a {
                color: #111111;
                font-weight: 700;
                text-decoration: none;
            }
            .track-note a:hover {
                text-decoration: underline;
            }
        </style>

        <div class="track-shell">
            <p class="track-eyebrow">{{ __('Order') }}</p>
            <h1 class="track-title">{{ __('Track Order') }}<br>{{ __('Track Order') }}</h1>
            <p class="track-sub">{{ __('Enter the transaction number (TRX-...) and phone number used at checkout to see your order status.') }}</p>

            <form class="track-card" wire:submit="track">
                <div class="track-field">
                    <label class="track-label" for="track-trx">{{ __('Transaction Number') }}</label>
                    <input id="track-trx" type="text" wire:model="trx_id"
                        class="track-input @error('trx_id') error @enderror"
                        placeholder="TRX-20260816-XXXXXX" autocomplete="off">
                    @error('trx_id')
                        <p class="track-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="track-field">
                    <label class="track-label" for="track-phone">{{ __('Phone Number') }}</label>
                    <input id="track-phone" type="text" wire:model="phone"
                        class="track-input @error('phone') error @enderror"
                        placeholder="08xxxxxxxxxx" autocomplete="off">
                    @error('phone')
                        <p class="track-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled" class="track-btn">
                    <span wire:loading.remove wire:target="track">{{ __('Track order') }}</span>
                    <span wire:loading wire:target="track"
                        class="inline-flex items-center justify-center gap-2">
                        <span class="animate-spin inline-block size-4 border-2 border-current border-t-transparent rounded-full"></span>
                        <span>{{ __('Mencari...') }}</span>
                    </span>
                </button>
            </form>

            <p class="track-note">
                {{ __('Already have an account?') }} <a href="{{ route('account.orders') }}">{{ __('View in My Orders') }}</a>
            </p>
        </div>
    </x-layouts.app>
</div>