<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;
use Session;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {   
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();
           // dd($providerUser);
        if ($account) {
            session::put('emailid', $providerUser->email);
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password'=> '',
                ]);
            }

            $account->user()->associate($user);
            $account->save();
             session::put('emailid', $providerUser->email);
            return $user;

        }

    }
}