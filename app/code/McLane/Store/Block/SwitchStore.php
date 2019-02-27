<?php

namespace McLane\Store\Block;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Psr\Log\LoggerInterface;

class SwitchStore extends Template
{
    /**
     * @var Store
     */
    protected $store;

    /**
     * @var LoggerInterface
     */
    protected $log;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        Template\Context $context,
        Store $store,
        LoggerInterface $logger,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->log = $logger;
        $this->store = $store;
    }

    /**
     * Gets current store name
     *
     * @return string
     */
    public function getCurrentStore()
    {
        $store = '';
        try {
            $store = $this->_storeManager->getStore()->getName();
        } catch (NoSuchEntityException $e) {
            $this->log->notice($e->getMessage());
        }
        return $store;
    }

    /**
     * Get stores based on Store block
     *
     * @return array
     */
    public function getStores()
    {
        return $this->store->getStores();
    }
}
