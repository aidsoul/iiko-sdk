<?php

namespace AidSoul\Iiko\Cloud\Status;

use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\ApiProvider;

class Status
{
    private ApiProvider $apiProvider;
    private string $organizationId;

    public function __construct(ApiProvider $apiProvider, string $organizationId)
    {
        $this->apiProvider = $apiProvider;
        $this->organizationId = $organizationId;
    }

    public function getStatus(string $correlationId): array
    {
        return $this->apiProvider->callMethod(
            'POST',
            '/api/1/commands/status',
            [
                RequestOptions::JSON => [
                    'organizationId' => $this->organizationId,
                    'correlationId' => $correlationId
                ]
            ]
        );
    }

    public function setOrganizationId(string $organizationId): void
    {
        $this->organizationId = $organizationId;
    }
}
