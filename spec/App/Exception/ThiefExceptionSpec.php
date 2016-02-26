<?php

namespace spec\App\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThiefExceptionSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldBeAnInstanceOf('\Exception');
    }
}
