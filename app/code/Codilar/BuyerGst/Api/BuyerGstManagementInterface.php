<?php
namespace Codilar\BuyerGst\Api;
/**
 * Interface for saving the checkout comment to the quote for orders of logged in users
 * @api
 */
interface BuyerGstManagementInterface
{
    /**
     * @param int $cartId
     * @param \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyergst
     * @return string
     */
    public function saveBuyerGst(
        $cartId,
        \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyergst
    );
}