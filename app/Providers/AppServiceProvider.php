<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\MovieList;
use App\Http\Policies\ReviewPolicy;
use App\Http\Policies\MovieListPolicy;


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
        Model::preventLazyLoading(!app()->isProduction());
        Model::shouldBeStrict(!app()->isProduction());
        \Iluminate\Support\Facades\Gate::policy(Review::class, ReviewPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(MovieList::class, MovieListPolicy::class);
    }
}
