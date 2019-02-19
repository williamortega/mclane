<?php

namespace McLane\Store\Block;


use Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Store extends Template
{
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
        StoreManagerInterface $storeManager,
        Session $customerSession,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
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
    protected function getSIDSession()
    {
        return $this->_customerSession->getSessionId();
    }
}