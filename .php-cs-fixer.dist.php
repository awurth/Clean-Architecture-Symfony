<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
    ->exclude('node_modules')
    ->exclude('config')
    ->exclude('public')
;

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'array_indentation' => true,
        'cast_spaces' => [
            'space' => 'none',
        ],
        'compact_nullable_typehint' => true,
        'declare_strict_types' => true,
        'fully_qualified_strict_types' => true,
        'native_function_invocation' => [
            'include' => ['@internal'],
        ],
        'no_superfluous_elseif' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'nullable_type_declaration_for_default_null_value' => false,
        'ordered_class_elements' => true,
        'ordered_imports' => [
            'imports_order' => [
                'class',
                'function',
                'const',
            ],
            'sort_algorithm' => 'alpha',
        ],
        'return_assignment' => true,
        'strict_param' => true,
        'trailing_comma_in_multiline' => [
            'elements' => ['arguments', 'arrays', 'match', 'parameters'],
        ],
        'void_return' => true,
        'yoda_style' => [
            'always_move_variable' => true,
        ],
    ])
    ->setFinder($finder)
;
