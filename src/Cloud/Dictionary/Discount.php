<?php

namespace AidSoul\Iiko\Cloud\Dictionary;

use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\ApiProvider;

class Discount
{
    private ApiProvider $apiProvider;
    private string $organizationId;

    public function __construct(ApiProvider $apiProvider, string $organizationId)
    {
        $this->apiProvider = $apiProvider;
        $this->organizationId = $organizationId;
    }

    public function setOrganizationId(string $organizationId): void
    {
        $this->organizationId = $organizationId;
    }

    public function get(): array
    {
        return $this->apiProvider->callMethod(
            "POST",
            "/api/1/discounts",
            [
                RequestOptions::JSON => ['organizationIds' => [$this->organizationId]]
            ]
        );
    }
}
