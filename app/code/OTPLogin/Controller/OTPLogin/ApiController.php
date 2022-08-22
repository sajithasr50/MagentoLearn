<?php
declare(strict_types=1);
/**
 * ApiController
 *
 * Creates ApiController
 *
 * @author Shibin VR
 * @package Litmus7_OTPLogin
 */
namespace Litmus7\OTPLogin\Controller\OTPLogin;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\CsrfAwareActionInterface;

abstract class ApiController extends Action implements CsrfAwareActionInterface
{
 
    public function __construct(
        \Magento\Framework\App\Action\Context $context 
    ){
        parent::__construct($context);
    } 
    /** * @inheritDoc */ 
    public function createCsrfValidationException(RequestInterface $request ): ?       InvalidRequestException { 
         return null; 
    } 
     /** * @inheritDoc */ 
    public function validateForCsrf(RequestInterface $request): ?bool {     
        return true; 
   }
}
