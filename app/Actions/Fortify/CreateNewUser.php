<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{8,14}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // Handle photo upload (if uploaded)
        $photoPath = null;
        if (isset($input['photo']) && $input['photo']->isValid()) {
            $photoPath = $input['photo']->store('user-photos', 'private'); // Stores in 'user-photos' directory under 'public' storage
        }

        return User::create([
            'photo' => $photoPath, 
            'name' => $input['name'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
