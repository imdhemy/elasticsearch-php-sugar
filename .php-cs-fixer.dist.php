<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    // Aliases
    '@PSR12' => true,
    'no_mixed_echo_print' => ['use' => 'echo'],
    'modernize_strpos' => true,
    'random_api_migration' => true,
    // Array notation
    'array_syntax' => ['syntax' => 'short'],
    'normalize_index_brace' => true,
    'trim_array_spaces' => true,
    'whitespace_after_comma_in_array' => true,
    // Basic
    'braces' => [
        'allow_single_line_anonymous_class_with_empty_body' => true,
        'allow_single_line_closure' => true,
    ],
    // Casing
    // ..
    // Cast notation
    'cast_spaces' => false,
    'modernize_types_casting' => true,
    'no_short_bool_cast' => true,
    'short_scalar_cast' => true,
    // Class notation
    'protected_to_private' => true,
    'self_accessor' => true,
    'self_static_accessor' => true,
    'single_trait_insert_per_statement' => true,
    // Class usage
    // ..
    // Comment
    'no_empty_comment' => true,
    'no_trailing_whitespace_in_comment' => true,
    'single_line_comment_spacing' => true,
    // Constant notation
    // ..
    // Control structure
    'control_structure_braces' => false,
    'no_useless_else' => true,
    'simplified_if_return' => true,
    // Imports
    'ordered_imports' => ['sort_algorithm' => 'alpha'],
];

$dirs = [
    __DIR__ . '/src',
    __DIR__ . '/tests',
];

$finder = Finder::create()
    ->in($dirs)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();
$config->setRules($rules);
$config->setFinder($finder);
$config->setCacheFile(__DIR__ . '/.php_cs.cache');

return $config;
