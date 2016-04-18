<?php

namespace spec\App\EventListener;

use App\Exception\PublishedMessageException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class PublishedMessageExceptionListenerSpec extends ObjectBehavior
{
    function it_sets_custom_response_for_published_message_exception(
        GetResponseForExceptionEvent $event,
        PublishedMessageException $exception
    ) {
        $event->getException()->willReturn($exception);
        $exception->getCode()->willReturn(400);
        $exception->getMessage()->willReturn('MESSAGE');

        $event->setResponse(Argument::that(function($subject) {
            return $this->isJsonResponseCorrect($subject);
        }))->shouldBeCalled();

        $this->onKernelException($event);
    }

    function it_does_not_set_response_for_other_exceptions(GetResponseForExceptionEvent $event)
    {
        $event->getException()->willReturn(new \Exception('foo'));

        $event->setResponse(Argument::any())->shouldNotBeCalled();

        $this->onKernelException($event);
    }

    private function isJsonResponseCorrect($jsonResponse)
    {
        if (!$jsonResponse instanceof JsonResponse) {
            return false;
        }

        $expectedResponse = '{"error":{"code":400,"message":"MESSAGE"}}';

        return $expectedResponse === $jsonResponse->getContent();
    }
}
