<?php

namespace Acamposm\IacGenerator\Kubernetes\Resources;

use Acamposm\IacGenerator\Kubernetes\KubernetesResource;
use Acamposm\IacGenerator\Traits\Exportable;

class Service extends KubernetesResource
{
    use Exportable;

    protected array $ports = [];
    
    /**
     * Service Contructor.
     */
    public function __construct(String|null $name = null)
    {
        parent::__construct(kind: 'Service', apiVersion: 'v1');
        if ($name !== null) {
            $this->name($name);
        }
    }

    public function toArray(): array
    {
        $resource = [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'metadata' => [],
            'spec' => []
        ];

        if (isset($this->name) && !empty($this->name)) {
            $resource['metadata']['name'] = $this->name;
        }

        if (isset($this->namespace) && !empty($this->namespace)) {
            $resource['metadata']['namespace'] = $this->namespace;
        }

        if (isset($this->annotations) && !empty($this->annotations)) {
            $resource['metadata']['annotations'] = $this->annotations;
        }

        if (isset($this->labels) && !empty($this->labels)) {
            $resource['metadata']['labels'] = $this->labels;
        }

        if (isset($this->selectors) && !empty($this->selectors)) {
            $resource['spec']['selectors'] = $this->selectors;
        }

        if (isset($this->ports) && !empty($this->ports)) {
            $resource['spec']['ports'] = $this->ports;
        }

        return $resource;
    }
}
