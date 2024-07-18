<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use App\Http\Controllers\Controller;
use App\Actions\Fortify\PasswordValidationRules;

class CustomRegisterController extends Controller
{
    use PasswordValidationRules;
    public function create (Request $request){
        
        $request->validate([
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^(\+62|62|0)8[1-9][0-9]{9,14}$/', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);
    }
}
