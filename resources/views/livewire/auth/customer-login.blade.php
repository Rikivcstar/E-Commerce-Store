<div>
    <style>
        /* ── Auth Split Layout ── */
        .auth-split {
            min-height: 100vh;
            display: flex;
            background: #ffffff;
        }

        /* LEFT PANEL — Full Cover Image with Navbar Clearance */
        .auth-panel-left {
            display: none;
            position: relative;
            flex: 0 0 50%;
            overflow: hidden;
            background: #e8e6f0;
            padding: 7rem;
        }

        @media (min-width: 900px) {
            .auth-panel-left {
                display: flex;
                flex-direction: column;
            }
        }

        .auth-panel-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
        }

        /* Top gradient overlay to keep logo readable */
        .auth-panel-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 8rem;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.75) 0%, rgba(255, 255, 255, 0) 100%);
            z-index: 1;
            pointer-events: none;
        }

        .auth-panel-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            height: 100%;
            padding: 2rem 2.5rem;
        }

        /* Top logo */
        .auth-panel-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .auth-panel-logo-icon {
            width: 2.25rem;
            height: 2.25rem;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-panel-logo-text {
            font-size: 1.1rem;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #111111;
        }

        /* Bottom Glass Card Overlay */
        .auth-panel-glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1.25rem;
            padding: 1.5rem;
            color: #ffffff;
            max-width: 28rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .auth-panel-glass-title {
            font-size: 1.25rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .auth-panel-glass-desc {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.5;
        }

        .auth-panel-footer-text {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 1rem;
        }

        /* RIGHT PANEL — form */
        .auth-panel-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem clamp(1.5rem, 5vw, 4rem);
            background: #ffffff;
            min-height: 100vh;
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 24rem;
        }

        .auth-form-eyebrow {
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: #555a42;
            margin-bottom: 0.6rem;
        }

        .auth-form-title {
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            font-weight: 900;
            letter-spacing: -0.035em;
            color: #111111;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .auth-form-subtitle {
            font-size: 0.85rem;
            color: #777777;
            margin-bottom: 2rem;
        }

        /* Inputs */
        .auth-input-group {
            position: relative;
            margin-bottom: 0.25rem;
        }

        .auth-input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            display: flex;
            align-items: center;
        }

        .auth-input-icon i[data-lucide] {
            width: 1rem;
            height: 1rem;
        }

        .auth-input-field {
            width: 100%;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.6rem;
            padding: 0.8rem 1rem 0.8rem 2.6rem;
            font-size: 0.875rem;
            color: #111111;
            background: #fafafa;
            transition: all 0.2s;
            outline: none;
            box-sizing: border-box;
        }

        .auth-input-field::placeholder {
            color: #b0b7bf;
        }

        .auth-input-field:focus {
            border-color: #111111;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(17, 17, 17, 0.08);
        }

        .auth-input-field.error {
            border-color: #ef4444;
        }

        .auth-input-error {
            font-size: 0.72rem;
            color: #ef4444;
            font-weight: 600;
            margin-top: 0.3rem;
            padding-left: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .auth-input-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: #374151;
            margin-bottom: 0.35rem;
            letter-spacing: 0.02em;
        }

        .auth-field {
            margin-bottom: 1rem;
        }

        /* Remember */
        .auth-remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .auth-remember input[type="checkbox"] {
            accent-color: #111111;
            width: 1rem;
            height: 1rem;
        }

        .auth-remember label {
            font-size: 0.8rem;
            color: #555555;
            font-weight: 500;
            cursor: pointer;
        }

        /* OR Divider */
        .auth-or {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.25rem 0;
        }

        .auth-or-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .auth-or-text {
            font-size: 0.72rem;
            color: #9ca3af;
            font-weight: 600;
            letter-spacing: 0.08em;
        }

        /* Google Button */
        .auth-btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            padding: 0.8rem 1rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.6rem;
            background: #ffffff;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .auth-btn-google:hover {
            border-color: #111111;
            background: #fafafa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .auth-btn-google svg.google-icon {
            width: 1.1rem;
            height: 1.1rem;
            flex-shrink: 0;
        }

        /* Submit Button */
        .auth-btn-submit {
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
            position: relative;
            overflow: hidden;
        }

        .auth-btn-submit:hover {
            background-color: #333333;
        }

        .auth-btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .auth-btn-submit>span {
            position: relative;
            z-index: 1;
        }

        /* Footer text */
        .auth-form-footer {
            text-align: center;
            font-size: 0.8rem;
            color: #9ca3af;
            margin-top: 1.5rem;
        }

        .auth-form-footer a {
            color: #111111;
            font-weight: 700;
            text-decoration: none;
        }

        .auth-form-footer a:hover {
            text-decoration: underline;
        }

        /* Mobile logo */
        .auth-mobile-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            margin-bottom: 2rem;
            text-decoration: none;
        }

        @media (min-width: 900px) {
            .auth-mobile-logo {
                display: none;
            }
        }

        .auth-mobile-logo-icon {
            width: 2rem;
            height: 2rem;
            background: #111111;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .auth-mobile-logo-icon i[data-lucide] {
            width: 1rem;
            height: 1rem;
            color: #fff;
        }

        .auth-mobile-logo-text {
            font-size: 1.1rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #111;
        }
    </style>

    <div class="auth-split">
        {{-- LEFT PANEL --}}
        <div class="auth-panel-left">
            <img src="{{ asset('images/final-image-ilus.png') }}" class="auth-panel-img" alt="Illustration">
        </div>

        {{-- RIGHT PANEL — Form --}}
        <div class="auth-panel-right">
            <div class="auth-form-wrap">
                {{-- Mobile Logo --}}
                <a href="{{ url('/') }}" class="auth-mobile-logo">
                    <img src="{{ asset('images/logo.png') }}" class="size-8 object-contain rounded-full bg-white p-0.5 shadow-sm border border-amber-900/10" alt="{{ config('app.name') }}">
                    <span class="auth-mobile-logo-text">{{ config('app.name') }}</span>
                </a>

                <p class="auth-form-eyebrow">{{ __('Customer Account') }}</p>
                <h1 class="auth-form-title">{{ __('Sign In') }}</h1>
                <p class="auth-form-subtitle">{{ __('Masuk dengan email atau akun Google Anda.') }}</p>

                {{-- Google Login --}}
                <a href="{{ route('auth.google') }}" class="auth-btn-google">
                    <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335" />
                    </svg>
                    {{ __('Lanjutkan dengan Google') }}
                </a>

                <div class="auth-or">
                    <div class="auth-or-line"></div>
                    <span class="auth-or-text">{{ __('atau') }}</span>
                    <div class="auth-or-line"></div>
                </div>

                {{-- Email --}}
                <div class="auth-field">
                    <label class="auth-input-label" for="login-email">{{ __('Email Address') }}</label>
                    <div class="auth-input-group">
                        <span class="auth-input-icon"><i data-lucide="mail"></i></span>
                        <input id="login-email" type="email" wire:model="email"
                            class="auth-input-field @error('email') error @enderror" placeholder="your@email.com"
                            autocomplete="email">
                    </div>
                    @error('email')
                        <p class="auth-input-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="auth-field">
                    <label class="auth-input-label" for="login-password">{{ __('Password') }}</label>
                    <div class="auth-input-group">
                        <span class="auth-input-icon"><i data-lucide="lock"></i></span>
                        <input id="login-password" type="password" wire:model="password"
                            class="auth-input-field @error('password') error @enderror" placeholder="••••••••"
                            autocomplete="current-password">
                    </div>
                    @error('password')
                        <p class="auth-input-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="auth-remember">
                    <input type="checkbox" id="login-remember" wire:model="remember">
                    <label for="login-remember">{{ __('Ingat saya') }}</label>
                </div>

                {{-- Submit --}}
                <button type="button" id="btn-login" wire:click="login" wire:loading.attr="disabled"
                    class="auth-btn-submit">
                    <span wire:loading.remove wire:target="login">{{ __('Masuk Sekarang') }}</span>
                    <span wire:loading.inline-flex wire:target="login" class="items-center justify-center gap-2">
                        <span
                            class="animate-spin inline-block size-4 border-2 border-current border-t-transparent rounded-full"></span>
                        <span>{{ __('Signing in...') }}</span>
                    </span>
                </button>

                <p class="auth-form-footer">
                    {{ __('Belum punya akun?') }}
                    <a href="{{ route('register') }}">{{ __('Daftar sekarang') }}</a>
                </p>
            </div>
        </div>
    </div>

    @push('head')
        <style>
            main {
                padding-top: 0 !important;
            }
        </style>
    @endpush
</div>
