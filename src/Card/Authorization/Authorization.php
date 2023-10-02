<?php

declare(strict_types=1);


namespace AidSoul\Iiko\Card\Authorization;

use AidSoul\Iiko\CardApiProvider;

class Authorization
{
    public Registration $registration;

    public function __construct(CardApiProvider $apiProvider, string $organizationId){
        $this->registration = new Registration($apiProvider, $organizationId);
    }

}