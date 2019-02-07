<?php

namespace McLane\Store\Block;


use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Cart as CustomerCart;

class Items extends Template
{
    /**
     * @var CustomerCart
     */
    protected $cart;

    /**
     * @inheritDoc
     */
    public function __construct(
        Template\Context $context,
        CustomerCart $cart,
        array $data = []
    )  {
        parent::__construct($context, $data);
        $this->cart = $cart;
    }

    /**
     * Return a list of products of cart.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->cart->getQuote()->getAllItems();
    }

    /**
     * Gets a subtotal from cart.
     *
     * @return float
     */
    public function getSubTotal()
    {
        return $this->cart->getQuote()->getSubtotal();
    }
}