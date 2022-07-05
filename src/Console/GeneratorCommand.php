<?php

/**
 * Addy Route Generator
 *
 * @author    Sachin Kiranti <sachinkiranti@gmail.com>
 * @copyright 2022 Sachin Kiranti (https://www.raisachin.com.np)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/sachinkiranti/addy
 */

namespace SachinKiranti\Addy\Console;

use JsonException;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

/**
 * A command to generate JS routes
 *
 * @author Sachin Kiranti <sachinkiranti@gmail.com>
 */
class GeneratorCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addy:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate route for js';

    /** @var Filesystem */
    private Filesystem $files;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     */
    public function __construct( Filesystem $files )
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException|JsonException
     */
    public function handle(): void
    {
        $router = app('router');

        // Get all the route list
        $routerList = collect($router->getRoutes())
            ->flatMap(function (Route $route) {
                return [
                    $route->getName() => '/' . $route->uri()
                ];
            })
            ->reject(static function ($url, $name) {
                // get only the actions url for xhr
                return !Str::startsWith($name, 'action.');
            });

        $content = $this->files->get( realpath(__DIR__ . DIRECTORY_SEPARATOR .'stubs'.DIRECTORY_SEPARATOR  . 'route.stub') );

        $replacements = [
            '{ROUTE_LIST}' => stripslashes(
                json_encode($routerList, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
            ),
        ];

        file_put_contents(
            resource_path('js/route.js'),
            stripslashes(str_replace(array_keys($replacements), array_values($replacements), $content))
        );

        $this->info('Route is successfully generated.');
    }

}