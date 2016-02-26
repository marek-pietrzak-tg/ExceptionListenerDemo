<?php

namespace App\Controller;

use App\Greeter\Greeter;
use Symfony\Component\HttpFoundation\JsonResponse;

class GreeterController
{
    /**
     * @var Greeter
     */
    private $greeter;

    /**
     * @param Greeter $greeter
     */
    public function __construct(Greeter $greeter)
    {
        $this->greeter = $greeter;
    }

    /**
     * @param string $name
     *
     * @return JsonResponse
     */
    public function greetAction($name)
    {
        return new JsonResponse(['message' => $this->greeter->greet($name)]);
    }
}
