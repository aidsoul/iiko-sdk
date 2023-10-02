<?php

namespace AidSoul\Iiko\Cloud\Nomenclature;

use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\ApiProvider;
use RuntimeException;

class Nomenclature implements NomenclatureInterface
{
    private ApiProvider $apiProvider;
    private string $organizationId;
    private array $products;
    private array $groups;
    private array $productCategories;
    private array $sizes;
    private int $revision;

    public function __construct(ApiProvider $apiProvider, string $organizationId)
    {
        if (empty($organizationId)) {
            throw new RuntimeException('Organization id is required');
        }
        $this->apiProvider = $apiProvider;
        $this->organizationId = $organizationId;
    }

    public function setOrganizationId(string $organizationId): Nomenclature
    {
        $this->organizationId = $organizationId;
        
        return $this;
    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function getProductCategories(): array
    {
        return $this->productCategories;
    }

    public function getProducts(array $fields = [], array $validation = []): array
    {
        return $this->products;
    }

    public function linkProductsWithGroups(): array
    {
        $groupsData = [];
        $newProducts = [];
        $products = $this->products;
        $groups = $this->groups;
        foreach ($groups as $group) {
            $groupsData[$group['id']] = $group['name'];
            $d[$group['name']] = $group['id'];
        }

        foreach ($products as $product) {
            $groupId = $product['parentGroup'];
            if (isset($groupsData[$groupId])) {
                $groupName = $groupsData[$groupId];
                $product['groupName'] = $groupName;
            } else {
                $product['groupName'] = 'Неизвестно';
            }
            unset($products['groupId']);
            $newProducts[] = $product;
        }
        return $newProducts;
    }

    public function getRevision(): int
    {
        return $this->revision;
    }

    public function getSizes(): array
    {
        return $this->sizes;
    }

    public function getNomenclature(): Nomenclature
    {
        $nomenclature = $this->apiProvider->callMethod(
            'POST',
            '/api/1/nomenclature',
            [
                RequestOptions::JSON => [
                    'organizationId' => $this->organizationId,
                ]
            ]
        );
        $this->groups = $nomenclature['groups'];
        $this->productCategories = $nomenclature['productCategories'];
        $this->products = $nomenclature['products'];
        $this->revision = $nomenclature['revision'];
        $this->sizes = $nomenclature['sizes'];

        return $this;
    }
}
