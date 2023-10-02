<?php

namespace AidSoul\Iiko\Cloud\TerminalGroup;

use AidSoul\Iiko\ApiProvider;

interface TerminalGroupInterface
{
    public function __construct(ApiProvider $apiProvider, string $organizationId = '');
    public function getTerminalGroups(string $organizationId, bool $includeDisabled = false): array;
}