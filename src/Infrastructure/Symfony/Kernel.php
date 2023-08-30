<?php

namespace App\Infrastructure\Symfony;

use App\Infrastructure\Symfony\DependencyInjection\Compiler\EntityRepositoryCompilerPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new EntityRepositoryCompilerPass());
    }
}
