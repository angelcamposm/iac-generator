<?php

namespace Acamposm\IacGenerator\Kubernetes;

abstract class K8sStorageResource extends K8sResource
{
    protected array $containers = [];
    protected array $initContainer = [];
}