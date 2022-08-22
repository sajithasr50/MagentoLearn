<?php
namespace Litmus7\OTPLogin\Plugin\Model\Checkout;
 
 
use Magento\Framework\Exception\LocalizedException;
 
class Cart
{
    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    } 
    public function beforeAddProduct(
        \Magento\Checkout\Model\Cart $subject, 
        $productInfo, 
        $requestInfo = null
    ){
 
        try {
            $this->_logger->info('Triggering add to cart plugin');
            
        } catch (\Exception $e) {
            throw new LocalizedException(__($e->getMessage()));
        }
 
        return [$productInfo, $requestInfo];
    }
}