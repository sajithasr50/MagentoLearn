<?php

namespace DollsKill\CustomerBlackList\Plugin\Checkout\CustomerData;

class Message
{
    public function afterGetSectionData(\Magento\Checkout\CustomerData\Cart $subject, $result)
    {
        $result['message'] = 'My Cart';
        return $result;
    }
}