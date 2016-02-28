<?php

namespace spec\App\Exception;

use App\Exception\PublishedMessageException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ThiefExceptionSpec extends ObjectBehavior
{
    function it_is_an_exception()
    {
        $this->shouldBeAnInstanceOf('\Exception');
    }

    function it_publishes_a_message()
    {
        $this->shouldImplement(PublishedMessageException::class);
    }

    function it_has_a_code_400()
    {
        $this->getCode()->shouldReturn(400);
    }
}
