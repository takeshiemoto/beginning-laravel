<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->notPath(['
        .phpstorm.meta.php',
        '_ide_helper.php'
    ])
    ->exclude([
        'storage',
        'vendor',
        'bootstrap/cache',
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
    ])
    ->setFinder($finder);
