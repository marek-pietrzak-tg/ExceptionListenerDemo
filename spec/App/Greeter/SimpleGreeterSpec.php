<?php

namespace spec\App\Greeter;

use App\Exception\ThiefException;
use App\Greeter\Greeter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleGreeterSpec extends ObjectBehavior
{
    function it_is_a_greeter()
    {
        $this->shouldImplement(Greeter::class);
    }

    function it_says_hello()
    {
        $this->greet('Marek')->shouldReturn('Hello Marek');
    }

    function it_throws_thief_exception_instead_of_greeting_a_thief()
    {
        $this->shouldThrow(ThiefException::class)->duringGreet('Thief');
    }
}
