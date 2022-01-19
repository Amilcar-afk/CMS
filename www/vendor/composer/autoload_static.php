<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb0a5c328335314324813c9a14dec0c85
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb0a5c328335314324813c9a14dec0c85::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb0a5c328335314324813c9a14dec0c85::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb0a5c328335314324813c9a14dec0c85::$classMap;

        }, null, ClassLoader::class);
    }
}
