<div>
    <style>
        .qa-card {
            border: 1px solid #e5e2d7;
            background: rgba(255,255,255,.88);
            border-radius: 1.45rem;
            box-shadow: 0 18px 45px rgba(32,34,27,.06);
        }
        .qa-section-title {
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #20221b;
            font-family: Finlandica, Inter, sans-serif;
            font-size: clamp(1.4rem, 2.4vw, 1.9rem);
            font-weight: 900;
            text-transform: uppercase;
        }
        .qa-item {
            border-bottom: 1px dashed #e5e2d7;
            padding: 1.1rem 1.35rem;
        }
        .qa-item:last-child {
            border-bottom: none;
        }
        .qa-q {
            color: #20221b;
            font-weight: 800;
            font-size: .92rem;
        }
        .qa-meta {
            margin-top: .25rem;
            color: #8b8f82;
            font-size: .72rem;
            font-weight: 700;
        }
        .qa-a {
            margin-top: .7rem;
            display: flex;
            gap: .55rem;
            align-items: flex-start;
            background: #f2f3ed;
            border-radius: .8rem;
            padding: .75rem .9rem;
        }
        .qa-a-badge {
            flex-shrink: 0;
            background: #555a42;
            color: #fff;
            border-radius: .45rem;
            font-size: .62rem;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: .25rem .5rem;
            margin-top: .15rem;
        }
        .qa-a-text {
            color: #44483a;
            font-size: .85rem;
            white-space: pre-line;
        }
        .qa-input {
            width: 100%;
            border: 1px solid #e5e2d7;
            border-radius: .8rem;
            background: #fff;
            padding: .65rem .9rem;
            font-size: .88rem;
            outline: none;
            transition: border-color .2s;
        }
        .qa-input:focus {
            border-color: #555a42;
        }
        .qa-error {
            margin-top: .3rem;
            color: #dc2626;
            font-size: .75rem;
            font-weight: 700;
        }
    </style>

    <section class="mt-10" aria-label="Product questions">
        <h2 class="qa-section-title">Tanya Jawab Produk</h2>

        {{-- Daftar pertanyaan yang sudah dipublikasikan --}}
        <div class="qa-card mb-6">
            @forelse ($questions as $q)
                <div class="qa-item">
                    <p class="qa-q">Q: {{ $q->question }}</p>
                    <p class="qa-meta">{{ $q->user?->name ?? $q->name ?? 'Pembeli' }}</p>
                    @if ($q->answer)
                        <div class="qa-a">
                            <span class="qa-a-badge">Jawaban</span>
                            <p class="qa-a-text">{{ $q->answer }}</p>
                        </div>
                    @else
                        <div class="qa-a">
                            <span class="qa-a-badge" style="background:#8c9082;">Belum</span>
                            <p class="qa-a-text text-[#8c9082] italic">Menunggu jawaban dari toko.</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="qa-item text-center py-8">
                    <p class="text-sm font-bold text-[#20221b]">Belum ada pertanyaan.</p>
                    <p class="text-xs text-[#8b8f82] mt-1">Jadilah yang pertama bertanya tentang produk ini.</p>
                </div>
            @endforelse
        </div>

        {{-- Form ajukan pertanyaan --}}
        <form wire:submit="submit" class="qa-card p-5 space-y-3">
            <h3 class="text-sm font-black uppercase tracking-wider text-[#20221b]">Ajukan Pertanyaan</h3>

            @guest
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <input type="text" wire:model="form.name" placeholder="Nama Anda" class="qa-input">
                        @error('form.name') <p class="qa-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <input type="email" wire:model="form.email" placeholder="Email Anda" class="qa-input">
                        @error('form.email') <p class="qa-error">{{ $message }}</p> @enderror
                    </div>
                </div>
            @endguest

            <div>
                <textarea wire:model="form.question" rows="3" placeholder="Tulis pertanyaan Anda tentang produk ini..."
                    class="qa-input resize-y"></textarea>
                @error('form.question') <p class="qa-error">{{ $message }}</p> @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center rounded-xl bg-[#20221b] px-6 py-2.5 text-xs font-black uppercase tracking-wider text-white hover:bg-black transition disabled:opacity-60">
                Kirim Pertanyaan
            </button>
        </form>
    </section>
</div>