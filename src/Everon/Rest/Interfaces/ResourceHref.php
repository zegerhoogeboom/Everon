<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <oliwierptak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Rest\Interfaces;

use Everon\Domain\Interfaces\Entity;
use Everon\Interfaces\Collection;


interface ResourceHref
{
    /**
     * @param string $version
     */
    public function setVersion($version);

    /**
     * @param $url
     */
    function setUrl($url);

    /**
     * @return string
     */
    function getResourceId();

    /**
     * @return string
     */
    function getResourceName();

    /**
     * @param string $versioning
     */
    function setVersioning($versioning);

    /**
     * @return string
     */
    function getVersioning();

    /**
     * @param $resource_id
     */
    function setResourceId($resource_id);

    /**
     * @return string
     */
    function getUrl();

    /**
     * @return string
     */
    public function getCollectionName();

    /**
     * @param $resource
     */
    function setResourceName($resource);

    /**
     * @param $collection
     */
    function setCollectionName($collection);

    /**
     * @return string
     * @throws \Everon\Rest\Exception\Resource
     */
    function getLink();

    /**
     * @return string
     */
    function getVersion();

    /**
     * @return string
     */
    function getRequestPath();

    /**
     * @param string $request_path
     */
    function setRequestPath($request_path);
}