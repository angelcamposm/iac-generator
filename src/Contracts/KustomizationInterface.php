<?php

namespace Acamposm\IacGenerator\Contracts;

interface KustomizationInterface
{
    /**
     * Return a Kustomization resource as an array
     *
     * @return array
     */
    public function toArray(): array;
}
