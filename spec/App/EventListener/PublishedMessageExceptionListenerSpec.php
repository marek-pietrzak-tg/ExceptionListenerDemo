<?php

namespace spec\App\EventListener;

use App\Exception\PublishedMessageException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class PublishedMessageExceptionListenerSpec extends ObjectBehavior
{
    function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_sets_custom_response_and_logs_error_for_published_message_exception(
        GetResponseForExceptionEvent $event,
        PublishedMessageException $exception,
        LoggerInterface $logger
    ) {
        $message = 'MESSAGE';

        $event->getException()->willReturn($exception);
        $exception->getCode()->willReturn(400);
        $exception->getMessage()->willReturn($message);

        $event->setResponse(Argument::that(function($subject) {
            return $this->isJsonResponseCorrect($subject);
        }))->shouldBeCalled();
        $logger->error('MESSAGE')->shouldBeCalled();

        $this->onKernelException($event);
    }

    function it_does_not_set_response_for_exception(GetResponseForExceptionEvent $event)
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
