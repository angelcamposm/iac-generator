<?php

namespace Acamposm\IacGenerator\Exceptions;

use RuntimeException;

class DirectoryNotCreatedException extends RuntimeException
{
    public function __construct(string $directory)
    {
        parent::__construct(sprintf('Directory "%s" was not created', $directory));
    }
}
