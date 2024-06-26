<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4350b927551f3964d99d1102c21bc915
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\src\\' => 8,
            'App\\config\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4350b927551f3964d99d1102c21bc915::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4350b927551f3964d99d1102c21bc915::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4350b927551f3964d99d1102c21bc915::$classMap;

        }, null, ClassLoader::class);
    }
}
