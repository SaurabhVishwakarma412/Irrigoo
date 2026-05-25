<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-emerald-700">Welcome back</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-950">Log in to your account</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600">Choose your role and continue to your irrigation dashboard.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="role" :value="__('Log in As')" />
            <select id="role" name="role" class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500" required>
                <option value="farmer" @selected(old('role') === 'farmer')>Farmer</option>
                <option value="provider" @selected(old('role') === 'provider')>Service Provider</option>
                <option value="manufacturer" @selected(old('role') === 'manufacturer')>Manufacturer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:ring-emerald-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-emerald-700 transition hover:text-emerald-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 text-sm">{{ __('Log in') }}</x-primary-button>
        </div>

        <p class="text-center text-sm text-slate-600">
            {{ __("Don't have an account?") }}
            <a class="font-semibold text-emerald-700 transition hover:text-emerald-900" href="{{ route('register') }}">
                {{ __('Create one') }}
            </a>
        </p>
    </form>
</x-guest-layout>
