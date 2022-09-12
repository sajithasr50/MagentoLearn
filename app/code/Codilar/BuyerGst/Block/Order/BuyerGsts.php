<?php

namespace Codilar\BuyerGst\Block\Order;

use Codilar\BuyerGst\Model\Data\BuyerGst;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context as TemplateContext;
use Magento\Sales\Model\Order;
use Magento\Backend\Model\UrlInterface;

class BuyerGsts extends \Magento\Framework\View\Element\Template
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * Url Interface
     *
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;


    public function __construct(
        TemplateContext $context,
        Registry $registry,
        UrlInterface $backendUrl,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->_isScopePrivate = true;
        $this->_template = 'order/view/buyergst.phtml';
        $this->_backendUrl = $backendUrl;
        parent::__construct($context, $data);
    }

    public function getOrder() : Order
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getBuyerGst(): string
    {
        return trim($this->getOrder()->getData(BuyerGst::GST_FIELD_NAME));
    }

    public function hasBuyerGst() : bool
    {
        return strlen($this->getBuyerGst()) > 0;
    }
    public function getBuyerGstHtml() : string
    {
        return nl2br($this->escapeHtml($this->getBuyerGst()));
    }
}
