<?php

/**
 * Assert
 *
 * LICENSE
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

namespace Assert;

class LazyAssertionException extends InvalidArgumentException
{
    /**
     * @var InvalidArgumentException[]
     */
    private $errors = array();

    /**
     * @param InvalidArgumentException[] $errors
     *
     * @return self
     */
    public static function fromErrors(array $errors)
    {
        $message = \sprintf('The following %d assertions failed:', \count($errors)) . "\n";

        $i = 1;
        foreach ($errors as $error) {
            $message .= \sprintf("%d) %s: %s\n", $i++, $error->getPropertyPath(), $error->getMessage());
        }

        return new static($message, $errors);
    }

    public function __construct($message, array $errors)
    {
        parent::__construct($message, 0, null, null);

        $this->errors = $errors;
    }

    public function getErrorExceptions()
    {
        return $this->errors;
    }
}
