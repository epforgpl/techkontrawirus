<?php

namespace App\Util;

class Assert
{

    /**
     * Check if a given condition is true. If not, throw with the given message.
     *
     * @param bool $condition
     * @param string $message
     * @throws AssertionFailedException
     */
    public static function assertTrue(bool $condition, string $message = ''): void
    {
        if (!$condition) {
            throw new AssertionFailedException($message);
        }
    }
}
