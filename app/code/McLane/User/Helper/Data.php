<?php

namespace McLane\User\Helper;


use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @inheritDoc
     */
    public function __construct(Context $context, Session $customerSession)
    {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    /**
     * Check if user has logged in.
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }
}
