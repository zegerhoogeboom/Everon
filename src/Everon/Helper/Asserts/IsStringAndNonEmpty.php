<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <oliwierptak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Helper\Asserts;

trait IsStringAndNonEmpty
{
    /**
     * Verifies that the specified condition is string and non empty.
     * The assertion fails if the condition is not string or empty string.
     *
     * @static
     * @param string $value
     * @param string $message
     * @param string $exception
     * @throws \Everon\Exception\Asserts
     */
    public function assertIsStringAndNonEmpty($value, $message='%s must be a string and not empty', $exception='Asserts')
    {
        if (is_string($value) === false || strlen($value) < 1) {
            $this->throwException($exception, $message, $value);
        }
    }
}