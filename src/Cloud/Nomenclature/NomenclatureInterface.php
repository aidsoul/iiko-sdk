<?php

namespace AidSoul\Iiko\Cloud\Nomenclature;

use AidSoul\Iiko\ApiProvider;

interface NomenclatureInterface
{
    public function __construct(ApiProvider $apiProvider, string $organizationId);
    public function setOrganizationId(string $organizationId): Nomenclature;
    public function getGroups(): array;
    public function getProducts(array $fields): array;
}
