<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInited45785f71b7e9b5ad1b1fa9fcb7411c
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\Whistleblower\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\Whistleblower\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Grav\\Plugin\\WhistleblowerPlugin' => __DIR__ . '/../..' . '/whistleblower.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInited45785f71b7e9b5ad1b1fa9fcb7411c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInited45785f71b7e9b5ad1b1fa9fcb7411c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInited45785f71b7e9b5ad1b1fa9fcb7411c::$classMap;

        }, null, ClassLoader::class);
    }
}
