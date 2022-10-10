<?php

namespace Acamposm\IacGenerator\Openshift;

use Acamposm\IacGenerator\Kubernetes\KubernetesResource;
use Acamposm\IacGenerator\Traits\Exportable;

class DeploymentConfig extends KubernetesResource
{
    use Exportable;

    /**
     * Service Constructor.
     */
    public function __construct()
    {
        parent::__construct(kind: 'DeploymentConfig', apiVersion: 'v1');
    }

    public function toArray(): array
    {
        $resource = [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'metadata' => [
                'namespace' => $this->namespace,
            ],
            'spec' => []
        ];

        if (isset($this->annotations) && count($this->annotations) > 0) {
            $resource['metadata']['annotations'] = $this->annotations;
        }

        if (isset($this->labels) && count($this->labels) > 0) {
            $resource['metadata']['labels'] = $this->labels;
        }

        if (isset($this->selectors) && count($this->selectors) > 0) {
            $resource['spec']['selectors'] = $this->selectors;
        }

        if (isset($this->ports) && count($this->ports) > 0) {
            $resource['spec']['ports'] = $this->ports;
        }

        return $resource;
    }
}
