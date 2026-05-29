<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FarmerProfile;
use App\Models\ManufacturerProfile;
use App\Models\ProviderProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'in:farmer,provider,manufacturer'],
            'phone' => ['nullable', 'string', 'max:30'],
            'location' => ['required', 'string', 'max:255'],
            'crop_type' => ['nullable', 'string', 'max:255'],
            'farm_name' => ['nullable', 'string', 'max:255'],
            'farm_size' => ['nullable', 'numeric', 'min:0'],
            'organization' => ['nullable', 'required_unless:role,farmer', 'string', 'max:255'],
            'service_area' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($validated): User {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'is_verified' => true,
                'password' => Hash::make($validated['password']),
            ]);

            match ($validated['role']) {
                'farmer' => FarmerProfile::create([
                    'user_id' => $user->id,
                    'farm_name' => $validated['farm_name'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'location' => $validated['location'],
                    'crop_type' => $validated['crop_type'] ?? null,
                    'farm_size' => $validated['farm_size'] ?? null,
                    'address' => $validated['address'] ?? null,
                ]),
                'provider' => ProviderProfile::create([
                    'user_id' => $user->id,
                    'organization' => $validated['organization'],
                    'phone' => $validated['phone'] ?? null,
                    'location' => $validated['location'],
                    'service_area' => $validated['service_area'] ?? null,
                    'address' => $validated['address'] ?? null,
                ]),
                'manufacturer' => ManufacturerProfile::create([
                    'user_id' => $user->id,
                    'organization' => $validated['organization'],
                    'phone' => $validated['phone'] ?? null,
                    'location' => $validated['location'],
                    'address' => $validated['address'] ?? null,
                ]),
            };

            return $user;
        });

        event(new Registered($user));

        return redirect(route('login', absolute: false))
            ->with('status', 'Registration successful. Please log in to continue.');
    }
}

