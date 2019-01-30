<?php

namespace McLane\Multistore\Block;


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
     * @inheritDoc
     */
    public function __construct(
        Template\Context $context,
        Context $httpContext,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->httpContext = $httpContext;
        $this->_storeManager = $storeManager;
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
                $stores[] = [
                    'name' => $store->getName(),
                    'code' => $store->getCode(),
                    'url' => $store->getBaseUrl(),
                ];
            }
        }

        return $stores;
    }
}