<?php
namespace Codilar\BuyerGst\Api;
/**
 * Interface for saving the checkout comment to the quote for guest orders
 */
interface GuestBuyerGstManagementInterface
{
    /**
     * @param string $cartId
     * @param \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyergst
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveBuyerGst(
        $cartId,
        \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyergst
    );
}