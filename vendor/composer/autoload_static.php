<?php

// autoload_static.php @generated by Composer
namespace Composer\Autoload;

class ComposerStaticInitc98c8f4e3b424ccbb64c73a72cb3595e
{
    public static $prefixesPsr0 = array (
        'Y' => 
        array (
            'Yandex\\Geo' => 
            array (
                0 => __DIR__ . '/..' . '/yandex/geo/source',
            ),
        ),
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitc98c8f4e3b424ccbb64c73a72cb3595e::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
