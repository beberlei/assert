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

class AssertionFailedException extends \InvalidArgumentException
{
    private $propertyPath;

    public function __construct($message, $code, $propertyPath = null)
    {
        parent::__construct($message, $code);
        $this->propertyPath = $propertyPath;
    }

    /**
     * User controlled way to define a sub-property causing
     * the failure of a currently asserted objects.
     *
     * Useful to transport information about the nature of the error
     * back to higher layers.
     *
     * @return string
     */
    public function getPropertyPath()
    {
        return $this->propertyPath;
    }
}

