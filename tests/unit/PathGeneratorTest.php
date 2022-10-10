<?php

declare(strict_types=1);

namespace unit;

use Acamposm\IacGenerator\Generators\PathGenerator;
use ArgumentCountError;
use PHPUnit\Framework\TestCase;

/**
 * @testdox PathGenerator test
 */
class PathGeneratorTest extends TestCase
{
    private const PATH = __DIR__.DIRECTORY_SEPARATOR.'target';

    /**
     * @testdox It can't create an instance without parameters
     *
     * @return void
     */
    public function testItCantCreateWithoutParameters(): void
    {
        $this->expectException(ArgumentCountError::class);

        $pg = new PathGenerator();
    }

    public function testItCanCreateWithEmptyOverlays(): void
    {
        $pg = new PathGenerator(self::PATH, []);

        $this->assertEmpty($pg->get());
    }

    public function testItCanCreateWithParameters(): PathGenerator
    {
        $pg = new PathGenerator(self::PATH, ['DEV']);

        $this->assertInstanceOf(PathGenerator::class, $pg);

        return $pg;
    }

    public function testItCanCreateWithSubpath(): void
    {
        $subpath = 'overlays';

        $pg = new PathGenerator(self::PATH, ['DEV'], $subpath);

        $paths = $pg->get();

        $this->assertStringContainsString($subpath, $paths['DEV']['path']);
    }

    /**
     * @depends testItCanCreateWithParameters
     * @param PathGenerator $pathGenerator
     * @return void
     */
    public function testItReturnsGeneratedPaths(PathGenerator $pathGenerator): void
    {
        $paths = $pathGenerator->get();

        $this->assertIsArray($paths);
    }

}
