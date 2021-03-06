<?php

namespace McLane\Store\Controller\Index;


use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Customer\Model\Session;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Session $customerSession
    ) {
        $this->customerSession = $customerSession;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return $this->_redirect('/');
        }

        return $this->pageFactory->create();
    }
}
