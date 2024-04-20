<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit508272f7abf8cf0315a4168bfdc7046c
{
    public static $prefixLengthsPsr4 = array (
        'b' => 
        array (
            'beautyStyling\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'beautyStyling\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit508272f7abf8cf0315a4168bfdc7046c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit508272f7abf8cf0315a4168bfdc7046c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit508272f7abf8cf0315a4168bfdc7046c::$classMap;

        }, null, ClassLoader::class);
    }
}
