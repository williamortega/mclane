<?php

namespace McLane\Store\Block;


use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Main extends Template
{
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        Template\Context $context,
        StoreManagerInterface $storeManager,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->storeManager = $storeManager;
        $this->customerSession = $customerSession;
    }

    /**
     * Check if user have been logged in.
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        return $this->customerSession->isLoggedIn();
    }
}