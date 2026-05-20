<x-guest-layout>
    <div class="mb-4">
        <h1 class="text-2xl font-bold text-gray-900">Create your account</h1>
        <p class="mt-1 text-sm text-gray-600">Choose your role and fill only the details that belong to that role.</p>
    </div>

    <form  method="POST" action="{{ route('register') }}" x-data="{ role: '{{ old('role', 'farmer') }}' }">
        @csrf
        <div>
            <x-input-label for="role" :value="__('Register As')" />
            <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="farmer">Farmer</option>
                <option value="provider">Service Provider</option>
                <option value="manufacturer">Manufacturer</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
            </div>
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
            </div>
        </div>

        <div x-show="role === 'farmer'" class="mt-4 space-y-4">
            <div>
                <x-input-label for="farm_name" :value="__('Farm Name')" />
                <x-text-input id="farm_name" class="block mt-1 w-full" type="text" name="farm_name" :value="old('farm_name')" />
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="crop_type" :value="__('Crop Type')" />
                    <x-text-input id="crop_type" class="block mt-1 w-full" type="text" name="crop_type" :value="old('crop_type')" />
                </div>
                <div>
                    <x-input-label for="farm_size" :value="__('Farm Size')" />
                    <x-text-input id="farm_size" class="block mt-1 w-full" type="number" step="0.01" name="farm_size" :value="old('farm_size')" />
                </div>
            </div>
        </div>

        <div x-show="role !== 'farmer'" class="mt-4 space-y-4">
            <div>
                <x-input-label for="organization" :value="__('Organization Name')" />
                <x-text-input id="organization" class="block mt-1 w-full" type="text" name="organization" :value="old('organization')" />
                <x-input-error :messages="$errors->get('organization')" class="mt-2" />
            </div>
            <div x-show="role === 'provider'">
                <x-input-label for="service_area" :value="__('Service Area')" />
                <x-text-input id="service_area" class="block mt-1 w-full" type="text" name="service_area" :value="old('service_area')" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('address') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button>{{ __('Register') }}</x-primary-button>
        </div>
    </form>
</x-guest-layout>
