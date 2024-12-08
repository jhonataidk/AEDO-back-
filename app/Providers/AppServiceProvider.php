<?php

namespace App\Providers;


use App\Interfaces\HospitalUsuarioServiceInterface;
use App\Interfaces\UsuarioOrgaoServiceInterface;
use App\Services\HospitalUsuarioService;
use App\Services\UsuarioOrgaoService;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserServiceInterface;
use App\Services\UserService;
use App\Interfaces\EnderecoServiceInterface;
use App\Services\EnderecoService;
use App\Interfaces\OrgaoServiceInterface;
use App\Services\OrgaoService;
use App\Interfaces\HospitalServiceInterface;
use App\Services\HospitalService;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckProfile;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(EnderecoServiceInterface::class, EnderecoService::class);
        $this->app->bind(OrgaoServiceInterface::class, OrgaoService::class);
        $this->app->bind(HospitalServiceInterface::class, HospitalService::class);
        $this->app->bind(UsuarioOrgaoServiceInterface::class, UsuarioOrgaoService::class);
        $this->app->bind(HospitalUsuarioServiceInterface::class, HospitalUsuarioService::class);
    }

    public function boot()
    {
        // Registrar o middleware para rotas
        Route::aliasMiddleware('check.profile', CheckProfile::class);
    }
}
