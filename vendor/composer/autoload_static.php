<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7747baa0934714169a1aa2fb065d115b
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7747baa0934714169a1aa2fb065d115b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7747baa0934714169a1aa2fb065d115b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7747baa0934714169a1aa2fb065d115b::$classMap;

        }, null, ClassLoader::class);
    }
}
