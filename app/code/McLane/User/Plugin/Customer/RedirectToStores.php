<?php

namespace McLane\User\Plugin\Customer;


use Magento\Customer\Controller\Account\LoginPost;

class RedirectToStores
{
    /**
     * It will go to Home page.
     *
     * @param LoginPost $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(LoginPost $subject, $result)
    {
        $result->setPath('store');
        return $result;
    }
}