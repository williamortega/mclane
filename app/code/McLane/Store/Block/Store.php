<?php

namespace McLane\Store\Block;


use Magento\Customer\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Psr\Log\LoggerInterface;

class Store extends Template
{
    /**
     * @var Session
     */
    protected $_customerSession;

    /**
     * @var LoggerInterface
     */
    protected $_log;

    /**
     * @inheritDoc
     */
    public function __construct(
        Template\Context $context,
        Session $customerSession,
        LoggerInterface $log,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession;
        $this->_log = $log;
    }

    /**
     * Gets all available stores.
     *
     * @return array
     */
    public function getStores()
    {
        $stores = [];

        if ($currentStoreCode = $this->getCurrentStore()) {
            $list = $this->_storeManager->getStores();
            foreach ($list as $store) {
                /** @var \Magento\Store\Api\Data\StoreInterface $store */
                if ($store->getCode() !== $currentStoreCode) {
                    if ($store->getIsActive()) {
                        /*$url = $this->getUrl('stores/store/switch', [
                            'SID' => $this->_customerSession->getSessionId(),
                            '___store' => $store->getCode(),
                            '___from_store' => $currentStoreCode,
                        ]);*/
                        $url = $store->getBaseUrl() . "stores/store/switch?___SID={$this->_customerSession->getSessionId()}&___from_store={$currentStoreCode}";
                        $stores[] = [
                            'name' => $store->getName(),
                            'url' => $url,
                        ];
                    }
                }
            }
        }

        return $stores;
    }

    /**
     * Gets current store
     *
     * @return null|string
     */
    protected function getCurrentStore()
    {
        try {
            $storeCode = $this->_storeManager->getStore()->getCode();
        }
        catch (NoSuchEntityException $e) {
            $this->_log->critical($e->getMessage());
            $storeCode = null;
        }

        return $storeCode;
    }
}
