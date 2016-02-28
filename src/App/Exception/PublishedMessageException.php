<?php

namespace App\Exception;

interface PublishedMessageException
{
    public function getMessage();
    public function getCode();
}
