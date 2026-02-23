<?php

namespace App\Providers;

use App\Models\ContactPerson;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share site-wide footer data with all views
        View::composer('*', function ($view) {
            static $shared = false;
            if (!$shared) {
                $shared = true;
                try {
                    View::share('siteSettings', SiteSetting::instance());
                    View::share('footerContacts', ContactPerson::where('is_active', true)->orderBy('order')->get());
                } catch (\Throwable) {
                    // Gracefully skip if tables don't exist yet (e.g., during migrations)
                    View::share('siteSettings', new SiteSetting());
                    View::share('footerContacts', collect());
                }
            }
        });
    }
}
