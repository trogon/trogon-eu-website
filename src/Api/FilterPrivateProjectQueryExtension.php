<?php

namespace App\Api;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;

use ApiPlatform\Metadata\Operation;

use App\Entity\Project;

use Doctrine\ORM\QueryBuilder;

class FilterPrivateProjectQueryExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        if (Project::class === $resourceClass) {
            $queryBuilder->andWhere(sprintf("%s.is_private = 'false'", $queryBuilder->getRootAliases()[0]));
        }
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []): void
    {
        if (Project::class === $resourceClass) {
            $queryBuilder->andWhere(sprintf("%s.is_private = 'false'", $queryBuilder->getRootAliases()[0]));
        }
    }
}
