<?php
namespace Codilar\BuyerGst\Model;

use Codilar\BuyerGst\Model\Data\BuyerGst;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\ValidatorException;

class BuyerGstManagement implements \Codilar\BuyerGst\Api\BuyerGstManagementInterface
{
    /**
     * Quote repository.
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     *
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository Quote repository.
     */
    public function __construct(
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param int $cartId
     * @param \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyerGst
     * @return null|string
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function saveBuyerGst(
        $cartId,
        \Codilar\BuyerGst\Api\Data\BuyerGstInterface $buyerGst
    ) {
        $quote = $this->quoteRepository->getActive($cartId);
        if (!$quote->getItemsCount()) {
            throw new NoSuchEntityException(__('Cart %1 doesn\'t contain products', $cartId));
        }
        $buyergst = $buyerGst->getBuyerGst();
        try {
            $quote->setData(BuyerGst::GST_FIELD_NAME, strip_tags($buyergst));
            $this->quoteRepository->save($quote);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('The order buyer gst could not be saved'));
        }

        return $buyergst;
    }
}
