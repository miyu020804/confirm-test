<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends
ServiceProvider
{
    public function boot()
    {
        //　ログイン処理

        Fortify::authenticateUsing(function ($request) {
            $user = User::where(
                'email',
                $request->email
            )->first();

            if (
                $user &&
                Hash::check(
                    $request->password,
                    $user->password
                )
            ) {
                return $user;
            }

            return null;
        });
    }
}
