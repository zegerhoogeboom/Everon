<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <oliwierptak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Interfaces;

use Everon\Config\Interfaces\ItemRouter;
use Everon\Interfaces;
use Everon\Exception;

interface Router
{
    /**
     * @param ItemRouter $RouteItem
     * @param Interfaces\Request $Request
     */
    function validateAndUpdateRequest(ItemRouter $RouteItem, Interfaces\Request $Request);
        
    /**
     * @param Interfaces\Request $Request
     * @return ItemRouter
     * @throws Exception\RouteNotDefined
     */
    function getRouteByRequest(Request $Request);

    /**
     * @param $route_name
     * @return ItemRouter
     * @throws Exception\Router
     */
    function getRouteByName($route_name);

    /**
     * @param $url
     * @return ItemRouter|null
     */
    function getRouteByUrl($url);

    /**
     * @param Interfaces\Config $Config
     * @return void
     */
    function setConfig(Interfaces\Config $Config);

    /**
     * @return Interfaces\Config
     */
    function getConfig();
}