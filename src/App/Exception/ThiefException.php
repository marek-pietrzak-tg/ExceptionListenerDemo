<?php

namespace App\Exception;

class ThiefException extends \Exception implements PublishedMessageException, UserInputException
{
}
