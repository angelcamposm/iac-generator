<?php

namespace Acamposm\IacGenerator\Traits;

use Acamposm\IacGenerator\Exceptions\KustomizationNotExportedException;
use Acamposm\IacGenerator\Helpers\Yaml;

trait Exportable
{
    /**
     * Dump the resource as Yaml.
     *
     * @return string
     */
    public function toYaml(): string
    {
        $yaml = Yaml::dump($this->toArray());

        $searchString = ['/-\n\s+/', "/'\[/", "/]'/"];

        $replaceString = ['- ', '[', ']'];

        return preg_replace($searchString, $replaceString, $yaml);
    }

    /**
     * Writes the resource to a file.
     *
     * @param string $path
     *
     * @return bool
     */
    public function toFile(string $path): bool
    {
        $filename = $path.DIRECTORY_SEPARATOR.'kustomization.yaml';

        if (file_put_contents($filename, $this->toYaml()) === false) {
            throw new KustomizationNotExportedException($filename);
        }

        return is_file($filename);
    }
}
