<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit677f689d07c67e0b5f630e45e3f2f8be
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit677f689d07c67e0b5f630e45e3f2f8be', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit677f689d07c67e0b5f630e45e3f2f8be', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit677f689d07c67e0b5f630e45e3f2f8be::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
