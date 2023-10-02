<?php

namespace AidSoul\Iiko\Cloud\Organization;

use GuzzleHttp\RequestOptions;
use AidSoul\Iiko\ApiProvider;

class Organization implements OrganizationInterface
{
    private ApiProvider $apiProvider;
    public array $organizations;
    public string $firstOrganization;

    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
        $this->organizations = $this->getOrganizations();
        $this->firstOrganization = $this->getFirst();
    }

    public function getFirst(): string
    {
        return array_key_first($this->organizations);
    }

    private function getOrganizations(): array
    {
        $response = $this->apiProvider->callMethod('POST', '/api/1/organizations', [
            RequestOptions::JSON => [
                'returnAdditionalInfo' => true,
                'includeDisabled' => true
            ]
        ]);
        return  $response['organizations'];
    }

    public function beautifyOrganization(): array
    {
        $cleanOrganizations = [];
        foreach ($this->organizations as $organization) {
            /** @var string $organizationName */
            $organizationName = $organization['name'];
            /** @var string $organizationId */
            $organizationId = $organization['id'];
            $cleanOrganizations[$organizationId] = $organizationName;
        }
        return $cleanOrganizations;
    }
}
