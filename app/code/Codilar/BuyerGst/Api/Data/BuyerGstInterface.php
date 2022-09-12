<?php
namespace Codilar\BuyerGst\Api\Data;

interface BuyerGstInterface
{
    /**
     * @return string|null
     */
    public function getBuyerGst();

    /**
     * @param string $buyergst
     * @return null
     */
    public function setBuyerGst($buyergst);
}