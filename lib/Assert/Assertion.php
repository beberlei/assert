<?php
/**
 * Assert
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Assert;

/**
 * Assert library
 */
class Assertion
{
    const INVALID_INTEGER = 10;
    const INVALID_DOUBLE  = 11;

    /**
     * Assert that value is a php integer'ish.
     *
     * @param mixed $value
     * @param string $message
     * @return void
     * @throws Assert\InvalidArgumentException
     */
    static public function integer($value, $message = null)
    {
        if (strval(intval($value)) != $value || is_bool($value) || is_null($value)) {
            throw new InvalidArgumentException($message, self::INVALID_INTEGER);
        }
    }
}

