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
use Illuminate\Support\Facades\Auth;
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
        $request->validate([
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'is_verified' => false,
            'password' => Hash::make($request->password),
        ]);

        match ($request->role) {
            'farmer' => FarmerProfile::create([
                'user_id' => $user->id,
                'farm_name' => $request->farm_name,
                'phone' => $request->phone,
                'location' => $request->location,
                'crop_type' => $request->crop_type,
                'farm_size' => $request->farm_size,
                'address' => $request->address,
            ]),
            'provider' => ProviderProfile::create([
                'user_id' => $user->id,
                'organization' => $request->organization,
                'phone' => $request->phone,
                'location' => $request->location,
                'service_area' => $request->service_area,
                'address' => $request->address,
            ]),
            'manufacturer' => ManufacturerProfile::create([
                'user_id' => $user->id,
                'organization' => $request->organization,
                'phone' => $request->phone,
                'location' => $request->location,
                'address' => $request->address,
            ]),
        };

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}

