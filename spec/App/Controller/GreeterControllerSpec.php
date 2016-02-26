<?php

namespace spec\App\Controller;

use App\Greeter\Greeter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\JsonResponse;

class GreeterControllerSpec extends ObjectBehavior
{
    function let(Greeter $greeter)
    {
        $this->beConstructedWith($greeter);
    }

    function it_greets_a_concrete_name(Greeter $greeter)
    {
        $greeter->greet('Marek')->willReturn('Hello Marek');

        $greetingResponse = $this->greetAction('Marek');

        $greetingResponse->shouldHaveType(JsonResponse::class);
        $greetingResponse->shouldHaveJsonResponseWithKey('message', 'Hello Marek');
    }

    public function getMatchers()
    {
        return [
            'haveJsonResponseWithKey' => function (JsonResponse $subject, $key, $message) {
                $content = json_decode($subject->getContent(), true);

                return is_array($content)
                    && array_key_exists($key, $content)
                    && $content[$key] === $message;
            }
        ];
    }
}
