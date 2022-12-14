<?php

namespace Acamposm\IacGenerator\Kubernetes\Resources;

use Acamposm\IacGenerator\Kubernetes\K8sResource;
use Acamposm\IacGenerator\Traits\Exportable;

/**
 * A ReplicaSet's purpose is to maintain a stable set of replica Pods running
 * at any given time. As such, it is often used to guarantee the availability
 * of a specified number of identical Pods.
 */
final class ReplicaSet extends K8sResource
{
    use Exportable;

    /**
     * ReplicaSet constructor.
     */
    public function __construct()
    {
        parent::__construct(kind: 'ReplicaSet', apiVersion: 'apps/v1');
    }

    /**
     * Return an array as a definition of the resource.
     *
     * @return array
     */
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
        return [];
    }
}