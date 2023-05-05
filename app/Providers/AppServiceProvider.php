<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Builder::macro(
            'whereLike',
            function (string $attribute, string $searchTerm) {
                return $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
            }
        );

        Builder::macro(
            'pick',
            function (int $limit = 0) {
                if ($limit)
                    return $this->take($limit)->get();
                return $this->get();
            }
        );
    }
}