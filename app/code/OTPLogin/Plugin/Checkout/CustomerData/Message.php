<?php
class Message
{
    public function afterGetSectionData(\Magento\Checkout\CustomerData\Cart $subject, $result)
    {
        $result['message'] = 'My Cart';
        return $result;
    }
}