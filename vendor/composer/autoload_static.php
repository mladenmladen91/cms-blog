<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita11f48c2f6a79ed5c14470a6d6de9ed1
{
    public static $files = array (
        '3109cb1a231dcd04bee1f9f620d46975' => __DIR__ . '/..' . '/paragonie/sodium_compat/autoload.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pusher\\' => 7,
            'Psr\\Log\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pusher\\' => 
        array (
            0 => __DIR__ . '/..' . '/pusher/pusher-php-server/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita11f48c2f6a79ed5c14470a6d6de9ed1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita11f48c2f6a79ed5c14470a6d6de9ed1::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
