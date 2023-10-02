<?php

declare(strict_types=1);


namespace AidSoul\Iiko\Card\Authorization;


use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\CardApiProvider;

class Registration
{
    private CardApiProvider $apiProvider;
    private string $organizationId;

    public function __construct(CardApiProvider $apiProvider, string $organizationId)
    {
        $this->apiProvider = $apiProvider;
        $this->organizationId = $organizationId;
    }

    public function setOrganizationId(string $organizationId): void
    {
        $this->organizationId = $organizationId;
    }

    public function registration(CustomerForImport $customerForImport): string
    {
        $userId = $this->apiProvider->callMethod(
                'POST',
                '/api/0/customers/create_or_update',
                [
                    'for_query' => [
                        'organization' => $this->organizationId,
                    ],
                    RequestOptions::JSON => [
                        'customer' => $customerForImport->getCustomer(),
                    ]
                ]
            );
        return $userId;
    }

}