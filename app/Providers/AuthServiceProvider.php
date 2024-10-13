<?php

// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Models\transkrip;
use App\Policies\TranskripPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        transkrip::class => TranskripPolicy::class, // Daftarkan policy di sini
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
