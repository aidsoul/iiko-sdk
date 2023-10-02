<?php

namespace AidSoul\Iiko\Sdk\IIKOCloud;

use AidSoul\Iiko\ApiProvider;
use AidSoul\Iiko\Cloud\Address\Address;
use AidSoul\Iiko\Cloud\Authorization\Authorization;
use AidSoul\Iiko\Cloud\Dictionary\Dictionary;
use AidSoul\Iiko\Cloud\Loyalty\Loyalty;
use AidSoul\Iiko\Cloud\Order\Delivery;
use AidSoul\Iiko\Cloud\Order\Order;
use AidSoul\Iiko\Cloud\Organization\Organization;
use AidSoul\Iiko\Cloud\Nomenclature\Nomenclature;
use AidSoul\Iiko\Cloud\Status\Status;
use AidSoul\Iiko\Cloud\TerminalGroup\TerminalGroup;

class Cloud implements IIKOCloudInterface
{
    /**
     * @var ApiProvider
     */
    private ApiProvider $provider;
    public Nomenclature $nomenclature;
    public Organization $organization;
    public Address $address;
    public Order $order;
    public TerminalGroup $terminalGroup;
    public Status $status;
    public Dictionary $dictionary;
    public Loyalty $loyalty;
    public Authorization $authorization;
    public Delivery $delivery;

    public function __construct(ApiProvider $provider)
    {
        $this->provider = $provider;
        $this->organization = new Organization($provider);
        $this->authorization = new Authorization($provider, $this->organization->firstOrganization);
        $this->loyalty = new Loyalty($provider, $this->organization->firstOrganization);
        $this->terminalGroup = new TerminalGroup($provider, $this->organization->firstOrganization);
        $this->order = new Order($provider, $this->organization->firstOrganization);
        $this->delivery = new Delivery($provider, $this->organization->firstOrganization);
        $this->nomenclature = new Nomenclature($provider, $this->organization->firstOrganization);
        $this->address = new Address($provider, $this->organization->firstOrganization);
        $this->status = new Status($provider, $this->organization->firstOrganization);
        $this->dictionary = new Dictionary($provider, $this->organization->firstOrganization);
    }
}
