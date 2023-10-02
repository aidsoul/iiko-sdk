<?php

namespace AidSoul\Iiko\Card\Organization;

use AidSoul\Iiko\CardApiProvider;

interface OrganizationInterface
{
    public function __construct(CardApiProvider $apiProvider);
    public function getFirst(): string;
}
