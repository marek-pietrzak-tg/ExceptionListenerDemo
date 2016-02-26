<?php

namespace App\Greeter;

use App\Exception\ThiefException;

final class SimpleGreeter implements Greeter
{
    /**
     * {@inheritdoc}
     */
    public function greet($name)
    {
        if ('Thief' === $name) {
            throw new ThiefException();
        }

        return sprintf('Hello %s', $name);
    }
}
