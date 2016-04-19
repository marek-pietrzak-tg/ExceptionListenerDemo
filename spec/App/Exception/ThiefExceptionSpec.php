<?php

namespace spec\App\Exception;

use App\Exception\PublishedMessageException;
use App\Exception\UserInputException;
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

    function it_is_a_user_input_exception()
    {
        $this->shouldImplement(UserInputException::class);
    }
}
