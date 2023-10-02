<?php

namespace AidSoul\Iiko\Cloud\Organization;

use AidSoul\Iiko\ApiProvider;

interface OrganizationInterface
{
    public function __construct(ApiProvider $apiProvider);
    public function getFirst(): string;
}
