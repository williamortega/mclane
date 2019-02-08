<?php

namespace McLane\Store\ViewModel;


use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Checkout\Helper\Data;
use Psr\Log\LoggerInterface;

class CartItems implements ArgumentInterface
{
    /**
     * @var Session
     */
    protected $_session;

    /**
     * @var Data
     */
    protected $_helper;

    /**
     * @var LoggerInterface
     */
    protected $_log;

    public function __construct(
        Session $session,
        Data $helper,
        LoggerInterface $log
    ) {
        $this->_session = $session;
        $this->_helper = $helper;
        $this->_log = $log;
    }

    public function getItems()
    {
        $result = [];
        foreach ($this->_session->getQuote()->getAllItems() as $item) {
            $result[$item->getItemId()] = [
                'name' => $item->getName(),
                'qty' => $item->getQty(),
                'price' => $this->_helper->formatPrice($item->getPrice()),
            ];
        }

        return json_encode($result);
    }
}