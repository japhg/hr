<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit30597d0b90f98c163cf61df5885ad85f
{
    public static $prefixLengthsPsr4 = array (
        'y' => 
        array (
            'yidas\\' => 6,
        ),
        'V' => 
        array (
            'Vaites\\ApacheTika\\' => 18,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'yidas\\' => 
        array (
            0 => __DIR__ . '/..' . '/yidas/pagination/src',
        ),
        'Vaites\\ApacheTika\\' => 
        array (
            0 => __DIR__ . '/..' . '/vaites/php-apache-tika/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit30597d0b90f98c163cf61df5885ad85f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit30597d0b90f98c163cf61df5885ad85f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit30597d0b90f98c163cf61df5885ad85f::$classMap;

        }, null, ClassLoader::class);
    }
}
