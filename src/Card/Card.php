<?php

declare(strict_types=1);

namespace AidSoul\Iiko\Card;

use AidSoul\Iiko\CardApiProvider;
use AidSoul\Iiko\Card\Authorization\Registration;
use AidSoul\Iiko\Card\Organization\Organization;

class Card
{
    /**
     * @var Registration
     */
    public Registration $registration;
    /**
     * @var Organization
     */
    private Organization $organization;

    public function __construct(CardApiProvider $provider)
    {
        $this->organization = new Organization($provider);
        $this->registration = new Registration($provider, $this->organization->firstOrganization);
    }
}
