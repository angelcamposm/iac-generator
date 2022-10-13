<?php

namespace Acamposm\IacGenerator\Kubernetes\Resources;

use Acamposm\IacGenerator\Kubernetes\K8sConfigurationResource;
use Acamposm\IacGenerator\Traits\Exportable;

class Secret extends K8sConfigurationResource
{
    use Exportable;

    /**
     * ConfigMap constructor.
     */
    public function __construct()
    {
        parent::__construct(kind: 'Secret', apiVersion: 'v1');
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [];
    }
}