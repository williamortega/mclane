<?php

namespace McLane\Store\Block;


use Magento\Framework\View\Element\Template;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

class Store extends Template
{
    /**
     * Code to default store view
     */
    const DEFAULT_STORE = 'default';

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @inheritDoc
     */
    public function __construct(
        Template\Context $context,
        Session $customerSession,
        LoggerInterface $logger,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->logger = $logger;
        parent::__construct($context, $data);
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
                // Remove current and default store view code
                if (!in_array($store->getCode(), [self::DEFAULT_STORE, $currentStoreCode])) {
                    if ($store->getIsActive()) {
                        /*$url = $this->getUrl('stores/store/switch', [
                            'SID' => $this->_customerSession->getSessionId(),
                            '___store' => $store->getCode(),
                            '___from_store' => $currentStoreCode,
                        ]);*/
                        $url = $store->getBaseUrl() . "stores/store/switch?___SID={$this->customerSession->getSessionId()}&___from_store={$currentStoreCode}";
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
            $this->logger->critical($e->getMessage());
            $storeCode = null;
        }

        return $storeCode;
    }
}
