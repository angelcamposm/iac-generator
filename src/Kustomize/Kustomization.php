<?php

namespace Acamposm\IacGenerator\Kustomize;

use Acamposm\IacGenerator\Contracts\KustomizationInterface;
use Acamposm\IacGenerator\Kubernetes\KubernetesResource;
use Acamposm\IacGenerator\Traits\Exportable;

class Kustomization extends KubernetesResource implements KustomizationInterface
{
    use Exportable;

    public const MANAGED_BY_LABEL = 'managedByLabel';
    public const ORIGIN_ANNOTATIONS = 'originAnnotations';
    public const TRANSFORMER_ANNOTATIONS = 'transformerAnnotations';

    protected string $buildMetadata;
    protected array $commonAnnotations = [];
    protected array $commonLabels = [];
    protected string $nameSuffix;
    protected string $namePrefix;
    protected array $patches = [];
    protected array $replicas = [];
    protected array $resources = [];

    public function __construct()
    {
        parent::__construct(kind: 'Kustomization', apiVersion: 'kustomize.config.k8s.io/v1beta1');
        $this->initialize();
    }

    /**
     * Set default values to Kustomization.
     *
     * @return void
     */
    private function initialize(): void
    {
        $this->buildMetadata = '['.self::MANAGED_BY_LABEL.']';
    }

    /**
     * Will override the existing namespace if it is set on a resource, or add
     * it if it is not set on a resource.
     *
     * @param string $namespace
     *
     * @return Kustomization
     */
    public function namespace(string $namespace): Kustomization
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * It helps to add prefix to resource names in the defined yaml files.
     *
     * @param string $prefix
     *
     * @return Kustomization
     */
    public function prefix(string $prefix): Kustomization
    {
        $this->namePrefix = $prefix;
        return $this;
    }

    /**
     * It helps to add suffix to resource names in the defined yaml files.
     *
     * @param string $suffix
     *
     * @return Kustomization
     */
    public function suffix(string $suffix): Kustomization
    {
        $this->nameSuffix = $suffix;
        return $this;
    }

    /**
     * Add a path to a file, or a path (or URL) referring to another
     * kustomization directory.
     *
     * @param string $resource
     *
     * @return Kustomization
     */
    public function addResource(string $resource): Kustomization
    {
        $this->resources[] = $resource;
        return $this;
    }

    /**
     * Add a list of paths to files, or a list of path (or URLs)
     * referring to another kustomization directories.
     *
     * @param array $resources
     *
     * @return Kustomization
     */
    public function addResources(array $resources): Kustomization
    {
        $this->resources = (count($this->resources) > 0)
            ? array_merge($this->resources, $resources)
            : $resources;

        return $this;
    }

    /**
     * Specify the number of replicas for a resource.
     *
     * @param string $deployment Name of the deployment or deploymentConfig
     * @param int $replicas
     *
     * @return Kustomization
     */
    public function addReplica(string $deployment, int $replicas): Kustomization
    {
        $this->replicas[] = [
            'name' => $deployment,
            'count' => $replicas,
        ];

        return $this;
    }

    /**
     * Return a Kustomization resource as an array
     *
     * @return array
     */
    public function toArray(): array
    {
        $resource = [
            'apiVersion' => $this->apiVersion,
            'kind' => $this->kind,
        ];

        if (isset($this->namespace) && $this->namespace !== '') {
            $resource['namespace'] = $this->namespace;
        }

        if (isset($this->namePrefix) && $this->namePrefix !== '') {
            $resource['namePrefix'] = $this->namePrefix;
        }

        if (isset($this->nameSuffix) && $this->nameSuffix !== '') {
            $resource['nameSuffix'] = $this->nameSuffix;
        }

        if (isset($this->buildMetadata) && $this->buildMetadata !== '') {
            $resource['buildMetadata'] = $this->buildMetadata;
        }

        if (isset($this->replicas) && count($this->replicas) > 0) {
            $resource['replicas'] = $this->replicas;
        }

        if (isset($this->resources) && count($this->resources) > 0) {
            $resource['resources'] = $this->resources;
        }

        return $resource;
    }
}
