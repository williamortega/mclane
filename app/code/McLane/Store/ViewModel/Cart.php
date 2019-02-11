<?php

namespace McLane\Store\ViewModel;


use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Checkout\Helper\Data;

class Cart implements ArgumentInterface
{
    /**
     * @var Session
     */
    protected $_session;

    /**
     * @var Data
     */
    protected $_helper;

    public function __construct(
        Session $session,
        Data $helper
    ) {
        $this->_session = $session;
        $this->_helper = $helper;
    }

    /**
     * Return a list of products of cart.
     *
     * @return string
     */
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

    /**
     * Gets a subtotal from cart.
     *
     * @return string
     */
    public function getSubtotal()
    {
        $price = $this->_session->getQuote()->getSubtotal();
        $output = [
            'hasSubtotal' => $price > 0,
            'price' => $this->_helper->formatPrice($price),
        ];

        return json_encode($output);
    }
}