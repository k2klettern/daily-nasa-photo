<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit074e6704d2968e7f7afa367296e352a2
{
    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 
            array (
                0 => __DIR__ . '/..' . '/composer/installers/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit074e6704d2968e7f7afa367296e352a2::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
