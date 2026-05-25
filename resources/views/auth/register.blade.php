<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-emerald-700">Get started</p>
        <h1 class="mt-2 text-3xl font-bold text-slate-950">Create your account</h1>
        <p class="mt-2 text-sm leading-6 text-slate-600">Choose your role and add the details needed to set up your workspace.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" x-data="{ role: '{{ old('role', 'farmer') }}' }" class="space-y-5">
        @csrf
        <div>
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" x-model="role" class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-emerald-500 focus:ring-emerald-500" required>
                <option value="farmer">Farmer</option>
                <option value="provider">Service Provider</option>
                <option value="manufacturer">Manufacturer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="mt-2 block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2 block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="mt-2 block w-full" type="text" name="phone" :value="old('phone')" autocomplete="tel" />
            </div>
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" class="mt-2 block w-full" type="text" name="location" :value="old('location')" required autocomplete="address-level2" />
            </div>
        </div>

        <div x-show="role === 'farmer'" class="space-y-4 rounded-2xl border border-emerald-100 bg-emerald-50/60 p-4">
            <div>
                <x-input-label for="farm_name" :value="__('Farm Name')" />
                <x-text-input id="farm_name" class="mt-2 block w-full" type="text" name="farm_name" :value="old('farm_name')" />
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div>
                    <x-input-label for="crop_type" :value="__('Crop Type')" />
                    <x-text-input id="crop_type" class="mt-2 block w-full" type="text" name="crop_type" :value="old('crop_type')" />
                </div>
                <div>
                    <x-input-label for="farm_size" :value="__('Farm Size')" />
                    <x-text-input id="farm_size" class="mt-2 block w-full" type="number" step="0.01" name="farm_size" :value="old('farm_size')" />
                </div>
            </div>
        </div>

        <div x-show="role !== 'farmer'" class="space-y-4 rounded-2xl border border-teal-100 bg-teal-50/60 p-4">
            <div>
                <x-input-label for="organization" :value="__('Organization Name')" />
                <x-text-input id="organization" class="mt-2 block w-full" type="text" name="organization" :value="old('organization')" autocomplete="organization" />
                <x-input-error :messages="$errors->get('organization')" class="mt-2" />
            </div>
            <div x-show="role === 'provider'">
                <x-input-label for="service_area" :value="__('Service Area')" />
                <x-text-input id="service_area" class="mt-2 block w-full" type="text" name="service_area" :value="old('service_area')" />
            </div>
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="3" class="mt-2 block w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm shadow-sm transition placeholder:text-slate-400 focus:border-emerald-500 focus:ring-emerald-500">{{ old('address') }}</textarea>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-2 block w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="mt-2 block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full justify-center py-3 text-sm">{{ __('Register') }}</x-primary-button>
        </div>

        <p class="text-center text-sm text-slate-600">
            {{ __('Already registered?') }}
            <a class="font-semibold text-emerald-700 transition hover:text-emerald-900" href="{{ route('login') }}">
                {{ __('Log in') }}
            </a>
        </p>
    </form>
</x-guest-layout>
