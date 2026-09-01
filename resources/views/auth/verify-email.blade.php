<x-layouts.app>
    <div class="mx-auto max-w-md px-6 py-20 text-center">
        <div
            class="mx-auto mb-6 flex size-16 items-center justify-center rounded-2xl bg-[#20221b] text-white shadow-md">
            <svg class="size-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10.5V17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-5" />
                <path d="M4 4h16a2 2 0 0 1 2 2v1.5" />
                <path d="m22 6-10 7L2 6" />
            </svg>
        </div>

        <h1 class="font-display text-2xl font-black uppercase tracking-tight text-[#20221b]">
            Verifikasi Email Anda
        </h1>

        <p class="mt-3 text-sm leading-relaxed text-[#8c9082]">
            {{ __('Kami telah mengirim tautan verifikasi ke') }}
            <strong class="text-[#20221b]">{{ auth()->user()->email }}</strong>.
            {{ __('Klik tautan tersebut untuk mengaktifkan akun Anda.') }}
        </p>

        @if (session('status') === 'verification-link-sent')
            <p class="mt-4 rounded-xl bg-emerald-50 px-4 py-2.5 text-xs font-bold text-emerald-700">
                {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
            </p>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf
            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-xl bg-[#20221b] px-6 py-3 text-xs font-black uppercase tracking-wider text-white transition hover:bg-black">
                {{ __('Kirim Ulang Email Verifikasi') }}
            </button>
        </form>

        <div class="mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xs font-bold text-[#8c9082] underline hover:text-[#20221b]">
                    Keluar
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>
