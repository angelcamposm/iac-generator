<?php

namespace Acamposm\IacGenerator\Contracts;

interface PathGeneratorInterface
{
    /**
     * Return an array with the paths for the given overlays.
     *
     * @return array
     */
    public function get(): array;
}
