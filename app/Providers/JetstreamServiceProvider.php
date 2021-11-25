<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;
use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use App\Actions\AuthenticateLoginAttempt;
class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::registerView(function () {
            return redirect('registers');
        });
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('name', $request->name)->where('active','1')->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
