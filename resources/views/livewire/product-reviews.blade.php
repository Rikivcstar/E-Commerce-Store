<div>
    <style>
        .pxr { margin-top: .25rem; }
        .pxr-grid {
            display: grid;
            gap: 1.2rem;
            align-items: start;
        }
        .pxr-summary {
            padding: 1.35rem;
            border: 1px solid #e5e2d7;
            background: rgba(255,255,255,.9);
            border-radius: 1.45rem;
        }
        .pxr-score {
            color: #111;
            font-size: clamp(3.2rem, 7vw, 5.5rem);
            font-weight: 500;
            line-height: .9;
        }
        .pxr-score small { color: #8b8f82; font-size: 1rem; }
        .pxr-caption {
            margin-top: .5rem;
            color: #8b8f82;
            font-size: .8rem;
            font-weight: 800;
        }
        .pxr-bars { margin-top: 1.1rem; display: grid; gap: .55rem; }
        .pxr-bar {
            display: grid;
            grid-template-columns: 1.4rem 1fr 1.4rem;
            gap: .6rem;
            align-items: center;
            color: #777c62;
            font-size: .78rem;
            font-weight: 900;
        }
        .pxr-track { height: .42rem; overflow: hidden; border-radius: 999px; background: #ecede6; }
        .pxr-fill { display: block; height: 100%; border-radius: inherit; background: #20221b; }
        .pxr-count { text-align: right; color: #9a9d91; }
        .pxr-list {
            display: grid;
            gap: .9rem;
        }
        .pxr-card {
            padding: 1rem 1.15rem;
            border: 1px solid #e5e2d7;
            background: rgba(255,255,255,.9);
            border-radius: 1.15rem;
        }
        .pxr-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .pxr-name { color: #20221b; font-size: .95rem; font-weight: 900; }
        .pxr-stars {
            color: #c9a24b;
            font-size: .85rem;
            letter-spacing: .12em;
        }
        .pxr-stars .pxr-dim { color: #dcd6c8; }
        .pxr-title {
            margin-top: .5rem;
            color: #20221b;
            font-size: .9rem;
            font-weight: 800;
        }
        .pxr-text {
            margin-top: .55rem;
            color: #74786b;
            font-size: .86rem;
            line-height: 1.65;
        }
        .pxr-date {
            display: inline-block;
            margin-top: .6rem;
            color: #a09a8a;
            font-size: .72rem;
            font-weight: 800;
        }
        .pxr-empty {
            padding: 1.5rem;
            border: 1px dashed #d7cfbf;
            border-radius: 1.15rem;
            color: #8b8f82;
            font-size: .88rem;
            text-align: center;
        }
        .pxr-note {
            margin-top: 1rem;
            color: #8b8f82;
            font-size: .85rem;
            font-weight: 700;
        }
        .pxr-form {
            margin-top: 1.25rem;
            display: grid;
            gap: .85rem;
            padding: 1.25rem;
            border: 1px solid #e5e2d7;
            border-radius: 1.15rem;
            background: rgba(255,255,255,.9);
        }
        .pxr-form label {
            display: grid;
            gap: .35rem;
            color: #555a42;
            font-size: .75rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
        }
        .pxr-form input.pxr-input,
        .pxr-form select.pxr-input,
        .pxr-form textarea.pxr-input {
            width: 100%;
            border: 1px solid #dfd8c9;
            border-radius: .75rem;
            background: #fffaf2;
            padding: .6rem .8rem;
            color: #20221b;
            font-size: .9rem;
            outline: none;
        }
        .pxr-form textarea.pxr-input { min-height: 6rem; resize: vertical; }
        .pxr-submit {
            justify-self: start;
            padding: .7rem 1.4rem;
            border: 1px solid #4d4634;
            border-radius: 999px;
            background: #4d4634;
            color: #fffaf2;
            font-size: .78rem;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            transition: background .2s ease;
        }
        .pxr-submit:hover { background: #2f2a20; }
        .pxr-error { color: #b42318; font-size: .72rem; font-weight: 800; text-transform: uppercase; }
        @media (min-width: 720px) {
            .pxr-grid { grid-template-columns: minmax(13rem, .7fr) minmax(20rem, 1.3fr); }
        }
    </style>

    <div class="pxr">
        <div class="pxr-grid">
            <div class="pxr-summary">
                <div>
                    <div class="pxr-score">{{ number_format($averageRating, 1) }}<small>/5</small></div>
                    <p class="pxr-caption">Berdasarkan {{ $reviews->count() }} ulasan</p>
                </div>
                <div class="pxr-bars">
                    @foreach ([5, 4, 3, 2, 1] as $star)
                        @php
                            $total = $reviews->count();
                            $count = $distribution[$star] ?? 0;
                            $pct = $total ? round($count / $total * 100) : 0;
                        @endphp
                        <div class="pxr-bar">
                            <span>{{ $star }} &#9733;</span>
                            <span class="pxr-track"><span class="pxr-fill" style="width: {{ $pct }}%"></span></span>
                            <span class="pxr-count">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pxr-list">
                @forelse ($reviews as $review)
                    <article class="pxr-card">
                        <div class="pxr-head">
                            <p class="pxr-name">{{ $review->user->name }}</p>
                            <span class="pxr-stars">
                                {{ str_repeat('&#9733;', $review->rating) }}<span class="pxr-dim">{{ str_repeat('&#9733;', 5 - $review->rating) }}</span>
                            </span>
                        </div>
                        @if ($review->title)
                            <p class="pxr-title">{{ $review->title }}</p>
                        @endif
                        <p class="pxr-text">{{ $review->body }}</p>
                        <span class="pxr-date">{{ $review->created_at->translatedFormat('d F Y') }} &middot; Pembeli terverifikasi</span>
                    </article>
                @empty
                    <p class="pxr-empty">Belum ada ulasan untuk produk ini. Jadilah yang pertama!</p>
                @endforelse
            </div>
        </div>

        @if (Auth::check())
            @if ($hasReviewed)
                <p class="pxr-note">Terima kasih, ulasan Anda sudah kami terima dan sedang ditinjau admin.</p>
            @elseif ($canReview)
                <form wire:submit="submit" class="pxr-form">
                    <label>Rating
                        <select wire:model="form.rating" class="pxr-input">
                            <option value="5">5 - Sangat Baik</option>
                            <option value="4">4 - Baik</option>
                            <option value="3">3 - Cukup</option>
                            <option value="2">2 - Kurang</option>
                            <option value="1">1 - Buruk</option>
                        </select>
                    </label>
                    <label>Judul (opsional)
                        <input wire:model="form.title" type="text" class="pxr-input" placeholder="Ringkasan singkat...">
                    </label>
                    <label>Ulasan
                        <textarea wire:model="form.body" class="pxr-input" placeholder="Bagaimana pengalaman Anda dengan produk ini?"></textarea>
                    </label>
                    @error('form.body')
                        <span class="pxr-error">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="pxr-submit">Kirim Ulasan</button>
                </form>
            @else
                <p class="pxr-note">Anda harus masuk dan sudah pernah membeli produk ini agar dapat menulis ulasan.</p>
            @endif
        @else
            <p class="pxr-note">
                <a href="{{ route('login') }}" class="underline font-black">Masuk</a> untuk menulis ulasan.
            </p>
        @endif
    </div>
</div>