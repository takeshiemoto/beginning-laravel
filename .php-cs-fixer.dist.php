<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->exclude('vendor')
    ->exclude('storage')
    ->exclude('node_modules');

$config = new Config();

return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
