<?php

namespace McLane\User\Block;


use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Customer\Block\Form\Login as CustomerLogin;

/**
 * Class Login that emulate all method from CustomerLogin
 *
 * @package McLane\User\Block
 */
class Login extends Template
{
    /**
     * @var CustomerLogin
     */
    protected $_login;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * Login constructor.
     *
     * @param Template\Context $context
     * @param Session $customerSession
     * @param CustomerLogin $login
     * @param LoggerInterface $log
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        Session $customerSession,
        CustomerLogin $login,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_login = $login;
        $this->_customerSession = $customerSession;
    }

    /**
     * Remove default text to login form
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set('');
        return parent::_prepareLayout();
    }

    /**
     * Gets all public method from Login
     *
     * @return CustomerLogin
     */
    public function getBlockLogin()
    {
        return $this->_login;
    }

    /**
     * Check if user has logged in
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->_customerSession->isLoggedIn();
    }
}
