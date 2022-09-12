<?php
namespace Codilar\BuyerGst\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;

class GuestBuyerGstManagement implements \Codilar\BuyerGst\Api\GuestBuyerGstManagementInterface
{

    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var \Codilar\BuyerGst\Api\BuyerGstManagementInterface
     */
    protected $orderBuyerGst;
    
    /**
     * GuestBuyerGstManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param \Codilar\BuyerGst\Api\BuyerGstManagementInterface $orderBuyerGst
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        \Codilar\BuyerGst\Api\BuyerGstManagementInterface $orderBuyerGst
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderBuyerGst = $orderBuyerGst;
    }
    /**
     * {@inheritDoc}
     */
    public function saveBuyerGst(
        $cartId,
        \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyergst
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($cartId, 'masked_id');
        return $this->orderBuyerGst->saveBuyerGst($quoteIdMask->getQuoteId(), $buyergst);
    }
}
