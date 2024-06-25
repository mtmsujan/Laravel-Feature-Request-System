<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('jQuery', function () {
            return '<?php echo "<script src=\"' . asset('assets/js/jquery-3.7.1.min.js') . '\" defer></script>"; ?>';
        });

        Blade::directive('admin', function () {
            return '<?php 
                if(auth()->user()?->is_admin){
                ?>';
        });
        Blade::directive('endadmin', function () {
            return '<?php 
                    }
                ?>';
        });
        
    }
}
