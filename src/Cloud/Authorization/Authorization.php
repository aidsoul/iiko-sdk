<?php

namespace AidSoul\Iiko\Cloud\Authorization;

use AidSoul\Iiko\ApiProvider;

class Authorization
{
    public Login $login;

    public function __construct(ApiProvider $apiProvider, string $organizationId){
        $this->login = new Login($apiProvider, $organizationId);
    }

}