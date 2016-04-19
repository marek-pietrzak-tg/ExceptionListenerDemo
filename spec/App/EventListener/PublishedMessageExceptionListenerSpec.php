<?php

namespace spec\App\EventListener;

use App\Exception\PublishedMessageException;
use App\Exception\ThiefException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class PublishedMessageExceptionListenerSpec extends ObjectBehavior
{
    function it_sets_custom_response_for_published_message_exception(
        GetResponseForExceptionEvent $event
    ) {
        $exception = new ThiefException('MESSAGE');
        $event->getException()->willReturn($exception);

        $event->setResponse(Argument::that(function($subject) {
            return $this->isJsonResponseCorrect($subject, 400);
        }))->shouldBeCalled();

        $this->onKernelException($event);
    }

    function it_does_not_set_response_for_other_exceptions(GetResponseForExceptionEvent $event)
    {
        $event->getException()->willReturn(new \Exception('foo'));

        $event->setResponse(Argument::any())->shouldNotBeCalled();

        $this->onKernelException($event);
    }

    function it_returns_code_500_for_non_user_input_exceptions(GetResponseForExceptionEvent $event, PublishedMessageException $exception)
    {
        $exception->getMessage()->willReturn('MESSAGE');
        $event->getException()->willReturn($exception);

        $event->setResponse(Argument::that(function($subject) {
            return $this->isJsonResponseCorrect($subject, 500);
        }))->shouldBeCalled();

        $this->onKernelException($event);
    }

    private function isJsonResponseCorrect($jsonResponse, $code)
    {
        if (!$jsonResponse instanceof JsonResponse) {
            return false;
        }

        $expectedResponse = '{"error":{"code":' . $code . ',"message":"MESSAGE"}}';

        return $expectedResponse === $jsonResponse->getContent()
            && $code === $jsonResponse->getStatusCode();
    }
}
