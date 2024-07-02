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
    ->exclude([
        'bootstrap/cache',
        'vendor',
        'node_modules',
        'storage',
    ])
    ->notPath([
        '*.blade.php',
    ]);

$config = new Config();

return $config
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
