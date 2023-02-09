<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7a8597ebc90d7a7e80683cce84115957
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7a8597ebc90d7a7e80683cce84115957::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7a8597ebc90d7a7e80683cce84115957::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7a8597ebc90d7a7e80683cce84115957::$classMap;

        }, null, ClassLoader::class);
    }
}
