<?php
namespace Codilar\BuyerGst\Model\Data;

use Codilar\BuyerGst\Api\Data\BuyerGstInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class BuyerGst extends AbstractSimpleObject implements BuyerGstInterface
{
    const GST_FIELD_NAME = 'buyer_gst';
    
    /**
     * @return string|null
     */
    public function getBuyerGst()
    {
        return $this->_get(static::GST_FIELD_NAME);
    }

    /**
     * @param string $buyergst
     * @return $this
     */
    public function setBuyerGst($buyergst)
    {
        return $this->setData(static::GST_FIELD_NAME, $buyergst);
    }
}