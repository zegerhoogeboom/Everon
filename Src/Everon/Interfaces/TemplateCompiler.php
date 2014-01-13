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

interface TemplateCompiler
{
    /**
     * @param $scope_name
     * @param $template_content
     * @param array $data
     * @return TemplateCompilerScope
     */    
    function compile($scope_name, $template_content, array $data);
}