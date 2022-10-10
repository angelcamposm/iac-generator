<?php

namespace Acamposm\IacGenerator\Kubernetes;

use stdClass;

abstract class KubernetesResource
{
    protected array $annotations = [];
    protected array $labels = [];
    protected string $name;
    protected string $namespace = '';
    protected array $selectors = [];

    /**
     * KubernetesResource constructor.
     *
     * @param string $kind
     * @param string $apiVersion
     */
    public function __construct(
        public string $kind,
        public string $apiVersion,
    )
    { }

    public function name(string $name): KubernetesResource
    {
        $this->name = $name;
        return $this;
    }

    public function namespace(string $namespace): KubernetesResource
    {
        $this->namespace = $namespace;
        return $this;
    }

    public function addAnnotation(string $key, string $value): KubernetesResource
    {
        $this->annotations[$key] = $value;
        return $this;
    }

    public function addAnnotations(array $annotationPairs): KubernetesResource
    {
        foreach ($annotationPairs as $key => $value) {
            $this->annotations[$key] = $value;
        }
        return $this;
    }

    public function addLabel(string $key, string $value): KubernetesResource
    {
        $this->labels[$key] = $value;
        return $this;
    }

    public function addLabels(array $labelPairs): KubernetesResource
    {
        foreach ($labelPairs as $key => $value) {
            $this->labels[$key] = $value;
        }
        return $this;
    }


}
