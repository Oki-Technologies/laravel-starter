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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'first_name'    => ['required', 'string', 'max:32'],
            'last_name'     => ['required', 'string', 'max:32'],
            'username'      => ['required', 'string', 'max:16', 'unique:users'],
            'phone'         => ['required', 'string', 'max:32', 'unique:users'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => $this->passwordRules(),
            'terms'         => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::firstOrCreate([
            'username'      => $input['username'],
            'phone'         => $input['phone'],
            'email'         => $input['email'],
        ], [
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'password'      => Hash::make($input['password']),
        ]);
    }
}
