@extends('filament::components.layouts.base')

@section('content')
    <div class="filament-login-container">
        <div class="filament-login-card">
            <h2 class="filament-login-heading">{{ config('app.name', 'Laravel') }}</h2>
            <h3 class="filament-login-subheading">{{ __('Sign in') }}</h3>

            <form method="POST" action="{{ url()->current() }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Email address or username') }}</label>
                    <input name="email" type="text" required class="w-full mt-1 block rounded-md border-gray-300 shadow-sm" placeholder="email@example.com or username" />
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                    <input name="password" type="password" required class="w-full mt-1 block rounded-md border-gray-300 shadow-sm" autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="form-checkbox" />
                        <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary">{{ __('Forgot your password?') }}</a>
                </div>

                <button type="submit" class="filament-button filament-button-primary w-full">{{ __('Sign in') }}</button>
            </form>
        </div>
    </div>

    <style>
        .filament-login-container { display:flex; min-height:70vh; align-items:center; justify-content:center; padding:2rem; }
        .filament-login-card { width:420px; background:var(--color-background); padding:2rem; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,.4); }
        .filament-login-heading { text-align:center; font-size:1rem; color:var(--color-muted); }
        .filament-login-subheading { text-align:center; font-size:1.5rem; margin-bottom:1rem; }
        .filament-button { padding:0.6rem 1rem; border-radius:8px; }
        .filament-button-primary { background:#f97316; color:white; }
    </style>
@endsection
