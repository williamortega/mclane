<?php

namespace McLane\Multistore\Helper;


use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Session
     */
    protected $_session;

    /**
     * @inheritDoc
     */
    public function __construct(Context $context, Session $session)
    {
        parent::__construct($context);
        $this->_session = $session;
    }

    /**
     * Check if user has logged in.
     *
     * @return bool
     */
    public function isCustomerLoggedIn()
    {
        return $this->_session->isLoggedIn();
    }
}