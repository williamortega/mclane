<?php

namespace McLane\Store\Block;


use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Http\Context;
use Magento\Store\Model\StoreManagerInterface;

class Stores extends Template
{
    /**
     * @var Context
     */
    protected $httpContext;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @inheritDoc
     */
    public function __construct(
        Template\Context $context,
        Context $httpContext,
        StoreManagerInterface $storeManager,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->httpContext = $httpContext;
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
    }

    /**
     * Check if user has session.
     *
     * @return bool
     */
    public function isLoggedIn()
    {
        return (bool)$this->httpContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
    }

    /**
     * Gets all available stores.
     *
     * @return array
     */
    public function getStores()
    {
        $stores = [];

        $list = $this->_storeManager->getStores();
        foreach ($list as $store) {
            if ($store->getCode() != 'default') {
                if ($store->getIsActive()) {
                    $url = $store->getBaseUrl() . 'stores/store/switch?SID=' . $this->getSIDSession();
                    $stores[] = [
                        'name' => $store->getName(),
                        'code' => $store->getCode(),
                        'url' => $url,
                    ];
                }
            }
        }

        return $stores;
    }

    /**
     * Gets SID of current user.
     *
     * @return string
     */
    public function getSIDSession()
    {
        return $this->_customerSession->getSessionId();
    }
}