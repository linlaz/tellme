<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\IPuser;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @param  Request $request
     * @return \App\Models\User
     */
    protected $find;
    public function __construct(Request $request)
    {
        $this->find = IPuser::where('ip_user', $request->ip())->first();
        if (is_null($this->find)) {
            $this->find = IPuser::create([
                'ip_user' => $request->ip(),
                'active' => '1'
            ]);
        }

        if ($this->find->active != '1') {
            return Redirect::to('addstoryguest')->send();
        }
    }

    public function create(array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'ip_user' => ['required'],
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        $find = IPuser::where('ip_user', $input['ip_user'])->first();
        $user = User::create([
            'name' => $input['name'],
            'password' => Hash::make($input['password']),
            'ip_user' => $find->id,
        ]);
        $user->assignRole('user');
        return $user;
    }
}
