<?php
declare(strict_types=1);

namespace Litmus7\OTPLogin\Observer\Cart;
 
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
 
class AddToCart implements ObserverInterface
{

    protected $_logger;

    public function __construct(
        \Psr\Log\LoggerInterface $logger
    ){
        $this->_logger = $logger;
    } 
    public function execute(Observer $observer){
        $this->_logger->info('Triggering add to cart observer');
    }
}