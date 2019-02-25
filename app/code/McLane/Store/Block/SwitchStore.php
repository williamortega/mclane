<?php

namespace McLane\Store\Block;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Psr\Log\LoggerInterface;

class SwitchStore extends Template
{
    /**
     * @var LoggerInterface
     */
    protected $log;

    /**
     * {@inheritdoc}
     */
    public function __construct(
        Template\Context $context,
        LoggerInterface $logger,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->log = $logger;
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
}
