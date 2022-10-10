<?php

namespace Acamposm\IacGenerator\Exceptions;

use RuntimeException;

class HostNotDefinedException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Host not defined.', 0);
    }
}
