<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class GreeterController
{
    public function greetAction($name)
    {
        return new JsonResponse(['message' => sprintf('Hello %s', $name)]);
    }
}
