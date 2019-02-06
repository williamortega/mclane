<?php

namespace McLane\Store\Block;


use Magento\Framework\View\Element\Template;

class Cart extends Template
{
    /**
     * @inheritDoc
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function showCart()
    {
        return false;
    }
}