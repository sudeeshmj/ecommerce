<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SubCategoryRepository;
use App\Repositories\BookFormatRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\TagRepository;
use App\Repositories\BookTagRepository;
use App\Repositories\BookSubCategoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BookRepository::class, function ($app) {
            return new BookRepository();
        });

        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository();
        });

        $this->app->singleton(SubCategoryRepository::class, function ($app) {
            return new SubCategoryRepository();
        });

        $this->app->singleton(BookFormatRepository::class, function ($app) {
            return new BookFormatRepository();
        });

        $this->app->singleton(AuthorRepository::class, function ($app) {
            return new AuthorRepository();
        });

        $this->app->singleton(LanguageRepository::class, function ($app) {
            return new LanguageRepository();
        });

        $this->app->singleton(PublisherRepository::class, function ($app) {
            return new PublisherRepository();
        });

        $this->app->singleton(TagRepository::class, function ($app) {
            return new TagRepository();
        });

        $this->app->singleton(BookTagRepository::class, function ($app) {
            return new BookTagRepository();
        });
        
        $this->app->singleton(BookSubCategoryRepository::class, function ($app) {
            return new BookSubCategoryRepository();
        });
      

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
