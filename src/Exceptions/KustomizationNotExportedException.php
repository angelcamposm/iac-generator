<?php

namespace Acamposm\IacGenerator\Exceptions;

use RuntimeException;

class KustomizationNotExportedException extends RuntimeException
{
    public function __construct(string $filename)
    {
        parent::__construct(sprintf('Kustomization "%s" was not created', $filename));
    }
}
