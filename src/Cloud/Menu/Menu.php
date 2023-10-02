<?php

namespace AidSoul\Iiko\Cloud\Menu;

use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\ApiProvider;
use RuntimeException;

class Menu
{
    private ApiProvider $apiProvider;
    private array $menu = [];

    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }


    public function getMenu(): array
    {
        return $this->apiProvider->callMethod(
            'POST',
            '/api/2/menu'
        );
    }

    public function getMenuById(string $externalMenuId, array $organizationIds, string $priceCategoryId = ''): array
    {
        $fields = [
            'externalMenuId' => $externalMenuId,
            'organizationIds' => $organizationIds,
        ];
        if ($priceCategoryId) {
            $fields['priceCategoryId'] = $organizationIds;
        }
        return $this->apiProvider->callMethod(
            'POST',
            '/api/2/menu/by_id',
            [
            RequestOptions::JSON => $fields
            ]
        );
    }
}
