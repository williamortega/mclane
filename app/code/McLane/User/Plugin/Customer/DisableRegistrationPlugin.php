<?php

namespace McLane\User\Plugin\Customer;


use Magento\Customer\Model\Registration;

class DisableRegistrationPlugin
{
    /**
     * Remove registration form to users.
     *
     * @param Registration $subject
     * @param $result
     * @return bool
     */
    public function afterIsAllowed(Registration $subject, $result)
    {
        return false;
    }
}