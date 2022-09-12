<?php
namespace Codilar\BuyerGst\Plugin\Block\Adminhtml;

use Codilar\BuyerGst\Model\Data\BuyerGst;
use Magento\Backend\Model\UrlInterface;

class SalesOrderViewInfo
{

    /**
     * Url Interface
     *
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;
    
    /**
     * Url Interface
     *
     * @var \Codilar\BuyerGst\Model\Source\Purchaseoption
     */
    protected $_purchaseOPtion;

    /**
     * @param \Magento\Sales\Block\Adminhtml\Order\View\Info $subject
     * @param \Magento\Backend\Model\UrlInterface
     * @param \Codilar\BuyerGst\Model\Source\Purchaseoption
     * @param string $result
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        UrlInterface $backendUrl
    ) {
        $this->_backendUrl = $backendUrl;
    }
    public function afterToHtml(
        \Magento\Sales\Block\Adminhtml\Order\View\Info $subject,
        $result
    ) {
        $commentBlock = $subject->getLayout()->getBlock('codilar_buyer_gst');
        if ($commentBlock !== false && $subject->getNameInLayout() == 'order_info') {
            $commentBlock->setBuyerGst($subject->getOrder()->getData(BuyerGst::GST_FIELD_NAME));
            $commentBlock->setAjaxUrl($this->_backendUrl->getUrl('buyergst/buyergst/index',['_nosid' => true]));
            $commentBlock->setAjaxOrder($subject->getOrder()->getData('entity_id'));
            $result = $result . $commentBlock->toHtml();
        }
        return $result;
    }
}
