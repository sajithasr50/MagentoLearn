<?php

namespace Moduletest\VendorTest\Block;


class DispData extends \Magento\Framework\View\Element\Template
{

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    )
    {        
        $this->marginalPrice = 20;
        parent::__construct($context, $data);
    }


    public function getWelcomeText()
    {


        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

        $registry = $objectManager->get('\Magento\Framework\Registry');

        $currentProduct = $registry->registry('current_product');

        $getCurrentPrice =  $currentProduct->getPrice();
        
        $tenplatePrice =  ($this->marginalPrice > $getCurrentPrice)?'lower price than marginal':'higher price than marginal';
        
        return $tenplatePrice;
    }
}