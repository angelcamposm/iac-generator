<?php

namespace Acamposm\IacGenerator\Openshift\Resources;

use Acamposm\IacGenerator\Exceptions\HostNotDefinedException;
use Acamposm\IacGenerator\Kubernetes\KubernetesResource;
use Acamposm\IacGenerator\Traits\Exportable;

class Route extends KubernetesResource
{
    use Exportable;

    protected string $host;
    protected string $path;
    protected string $service;

    /**
     * Route Constructor.
     */
    public function __construct(String|null $name = null)
    {
        parent::__construct(kind: 'Route', apiVersion: 'route.openshift.io/v1');
        if ($name !== null) {
            $this->name($name);
        }
    }

    public static function create(): self
    {
        return new static();
    }

    public function host(string $host): KubernetesResource
    {
        $this->host = $host;
        return $this;
    }

    public function path(string $path): KubernetesResource
    {
        $this->path = str_starts_with($path, '/') ? $path : '/'.$path;
        return $this;
    }

    public function toService(string $name): KubernetesResource
    {
        $this->service = $name;
        return $this;
    }

    public function toArray(): array
    {
        if (!isset($this->host)) {
            throw new HostNotDefinedException();
        }

        $resource = [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
            'metadata' => [],
            'spec' => [
                'port' => [
                    'targetPort' => 8080
                ]
            ]
        ];

        if (isset($this->annotations) && !empty($this->annotations)) {
            $resource['metadata']['annotations'] = $this->annotations;
        }

        if (isset($this->host) && !empty($this->host)) {
            $resource['spec']['host'] = $this->host;
        }

        if (isset($this->labels) && !empty($this->labels)) {
            $resource['metadata']['labels'] = $this->labels;
        }

        if (isset($this->path) && !empty($this->path)) {
            $resource['spec']['path'] = $this->path;
        }

        if (isset($this->service) && !empty($this->service)) {
            $resource['spec']['to'] = [
                'kind' => 'Service',
                'name' => $this->service
            ];
        }

        return $resource;
    }

}
