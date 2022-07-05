<?php

/**
 * Addy Routes Filter Interface
 *
 * @author    Sachin Kiranti <sachinkiranti@gmail.com>
 * @copyright 2022 Sachin Kiranti (https://www.raisachin.com.np)
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/sachinkiranti/addy
 */

namespace SachinKiranti\Addy\Filters;

use Illuminate\Support\Collection;

interface RouteFilterInterface
{

    public function __invoke(Collection $collection);

}