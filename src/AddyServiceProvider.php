<?php

/**
 * Addy Service Provider
 *
 * @author    Sachin Kiranti <sachinkiranti@gmail.com>
 * @copyright 2022 Sachin Kiranti (https://www.raisachin.com.np)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/sachinkiranti/addy
 */

namespace SachinKiranti\Addy;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use SachinKiranti\Addy\Console\GeneratorCommand;

class AddyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        // Add macro
        Collection::macro('filterRoutes', function (...$filters): Collection {
            collect($filters)->each(function ($filter)  {
                $this->tap(new $filter);
            });
            return $this;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        // Register the commands
        $this->commands([
            GeneratorCommand::class,
        ]);
    }

}