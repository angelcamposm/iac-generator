<?php

namespace Acamposm\IacGenerator\Generators;

use Acamposm\IacGenerator\Contracts\PathGeneratorInterface;

class PathGenerator implements PathGeneratorInterface
{
    /**
     * PathGenerator constructor.
     *
     * @param string $baseDirectory
     * @param array $overlays
     * @param string $subPath
     */
    public function __construct(
        public string $baseDirectory,
        public array $overlays,
        public string $subPath = 'overlays'
    )
    { }

    /**
     * @return array
     */
    public function get(): array
    {
        if (isset($this->overlays) && count($this->overlays) > 0) {
            return $this->processOverlays();
        }

        return [];
    }

    /**
     * Process each overlay to generate an array with paths for the given overlays.
     *
     * @return array
     */
    private function processOverlays(): array
    {
        $overlays = [];

        foreach ($this->overlays as $overlay) {
            $overlays[$overlay] = [
                'environment' => $overlay,
                'path' => $this->getFullPath(strtolower($overlay)),
            ];
        }

        return $overlays;
    }

    /**
     * Generates the full path of an overlay.
     *
     * @param string $overlay
     *
     * @return string
     */
    private function getFullPath(string $overlay): string
    {
        return implode(DIRECTORY_SEPARATOR, $this->getPathItems($overlay));
    }

    /**
     * Return an array with path items.
     *
     * @param string $overlay
     *
     * @return array
     */
    private function getPathItems(string $overlay): array
    {
        return [
            $this->baseDirectory,
            $this->subPath,
            $overlay
        ];
    }
}
