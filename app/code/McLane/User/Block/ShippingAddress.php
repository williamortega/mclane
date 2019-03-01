<?php

namespace McLane\User\Block;


use Magento\Framework\View\Element\Template;
use Magento\Customer\Helper\Session\CurrentCustomer;

class ShippingAddress extends Template
{
    /**
     * @var CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @inheritDoc
     */
    public function __construct(
        CurrentCustomer $currentCustomer,
        Template\Context $context,
        array $data = []
    ) {
        $this->currentCustomer = $currentCustomer;
        parent::__construct($context, $data);
    }

    /**
     * Gets all addresses from use
     *
     * @return \Magento\Customer\Api\Data\AddressInterface[]|null
     */
    public function getShippingAddresses()
    {
        return $this->currentCustomer->getCustomer()->getAddresses();
    }
}
