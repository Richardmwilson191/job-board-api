<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita28d2dd85b73f2a1416312c0bf8e06c1
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita28d2dd85b73f2a1416312c0bf8e06c1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita28d2dd85b73f2a1416312c0bf8e06c1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita28d2dd85b73f2a1416312c0bf8e06c1::$classMap;

        }, null, ClassLoader::class);
    }
}
