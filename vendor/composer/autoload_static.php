<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc402be1e0a421ffe7cd5448817767d71
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'AlBeyt\\Views\\' => 13,
            'AlBeyt\\Models\\' => 14,
            'AlBeyt\\Library\\' => 15,
            'AlBeyt\\Controllers\\' => 19,
            'AlBeyt\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'AlBeyt\\Views\\' => 
        array (
            0 => __DIR__ . '/../..' . '/al-beyt/views',
        ),
        'AlBeyt\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/al-beyt/models',
        ),
        'AlBeyt\\Library\\' => 
        array (
            0 => __DIR__ . '/../..' . '/al-beyt/library',
        ),
        'AlBeyt\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/al-beyt/controllers',
        ),
        'AlBeyt\\' => 
        array (
            0 => __DIR__ . '/../..' . '/al-beyt',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc402be1e0a421ffe7cd5448817767d71::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc402be1e0a421ffe7cd5448817767d71::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc402be1e0a421ffe7cd5448817767d71::$classMap;

        }, null, ClassLoader::class);
    }
}