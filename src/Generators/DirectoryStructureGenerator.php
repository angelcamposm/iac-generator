<?php

namespace Acamposm\IacGenerator\Generators;

use Acamposm\IacGenerator\Exceptions\DirectoryNotCreatedException;

class DirectoryStructureGenerator
{
    /**
     *
     *
     * @param String $baseDirectory
     * @param array $overlays
     *
     * @return void
     */
    public static function create(String $baseDirectory, array $overlays = []): void
    {
        self::initializeBaseOverlay($baseDirectory);
        self::initializeEnvironmentOverlays($baseDirectory, $overlays);
        self::initializeConfigDirectory($baseDirectory, $overlays);
    }

    /**
     *
     *
     * @param String $baseDirectory
     *
     * @return void
     */
    private static function initializeBaseOverlay(String $baseDirectory): void
    {
        $path = $baseDirectory.DIRECTORY_SEPARATOR.'base';

        self::createDirectory($path);
    }

    /**
     * Create config directory to store generated kubernetes resources.
     *
     * @param string $baseDirectory
     * @param array $overlays
     *
     * @return void
     */
    private static function initializeConfigDirectory(string $baseDirectory, array $overlays): void
    {
        $path = $baseDirectory.DIRECTORY_SEPARATOR.'config';

        if (!empty($overlays)) {
            self::createDirectoryFromOverlays($path, $overlays);
        }
    }

    /**
     * Create overlays directory and if supplied $overlays create each overlay.
     *
     * @param  String  $baseDirectory  Base directory.
     * @param  array   $overlays       Overlays to be created.
     *
     * @return void
     */
    private static function initializeEnvironmentOverlays(String $baseDirectory, array $overlays): void
    {
        $path = $baseDirectory.DIRECTORY_SEPARATOR.'overlays';

        self::createDirectory($path);

        if (!empty($overlays)) {
            self::createDirectoryFromOverlays($path, $overlays);
        }
    }

    /**
     * Create a directory.
     *
     * @param  string  $path
     * @param  int     $permissions
     * @param  bool    $recursive
     *
     * @return void
     */
    private static function createDirectory(string $path, int $permissions = 0777, bool $recursive = true): void
    {
        if (is_dir($path)) {
            return;
        }

        if (!mkdir($path, $permissions, $recursive) && !is_dir($path)) {
            throw new DirectoryNotCreatedException($path);
        }
    }

    /**
     * Create each overlay under $basePath.
     *
     * @param  string  $basePath  Base path where create overlays.
     * @param  array   $overlays  Overlays to be created.
     *
     * @return void
     */
    private static function createDirectoryFromOverlays(string $basePath, array $overlays): void
    {
        foreach ($overlays as $overlay) {
            self::createDirectory($basePath.DIRECTORY_SEPARATOR.strtolower($overlay));
        }
    }
}
