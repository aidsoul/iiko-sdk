<?php

namespace AidSoul\Iiko\Cloud;

use AidSoul\Iiko\ApiProvider;

interface CloudInterface
{
    public function __construct(ApiProvider $provider);
}
