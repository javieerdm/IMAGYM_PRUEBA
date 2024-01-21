<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit73fe1109d0287077849de08e4a3036cd
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Shieldon\\Security\\' => 18,
            'Shieldon\\Psr7\\' => 14,
            'Shieldon\\Psr17\\' => 15,
            'Shieldon\\Psr15\\' => 15,
            'Shieldon\\Messenger\\' => 19,
            'Shieldon\\Firewall\\' => 18,
            'Shieldon\\Event\\' => 15,
        ),
        'P' => 
        array (
            'Psr\\Http\\Server\\' => 16,
            'Psr\\Http\\Message\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Shieldon\\Security\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/web-security/src/Security',
        ),
        'Shieldon\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/psr-http/src/Psr7',
        ),
        'Shieldon\\Psr17\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/psr-http/src/Psr17',
        ),
        'Shieldon\\Psr15\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/psr-http/src/Psr15',
        ),
        'Shieldon\\Messenger\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/messenger/src/Messenger',
        ),
        'Shieldon\\Firewall\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/shieldon/src/Firewall',
        ),
        'Shieldon\\Event\\' => 
        array (
            0 => __DIR__ . '/..' . '/shieldon/event-dispatcher/src/Event',
        ),
        'Psr\\Http\\Server\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-server-handler/src',
            1 => __DIR__ . '/..' . '/psr/http-server-middleware/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit73fe1109d0287077849de08e4a3036cd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit73fe1109d0287077849de08e4a3036cd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit73fe1109d0287077849de08e4a3036cd::$classMap;

        }, null, ClassLoader::class);
    }
}
