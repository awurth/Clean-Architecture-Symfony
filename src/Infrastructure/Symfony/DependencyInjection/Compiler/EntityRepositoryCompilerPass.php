<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\String\UnicodeString;

final class EntityRepositoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $ids = $container->findTaggedServiceIds('app.entity_repository');
        foreach (\array_keys($ids) as $class) {
            $reflectionClass = new \ReflectionClass($class);
            $shortName = $reflectionClass->getShortName();
            foreach ($reflectionClass->getInterfaceNames() as $interface) {
                $string = new UnicodeString($interface);
                if ($string->startsWith('App\\Domain\\') && $string->endsWith($shortName.'Interface')) {
                    $container->setAlias($interface, $class);
                    break;
                }
            }
        }
    }
}
