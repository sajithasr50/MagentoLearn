<?php
declare(strict_types=1);

/**
 * ViewModel OTP Login
 *
 * OTP Login ViewModel
 *
 * @author Shibin VR
 * @package Litmus7_ViewModel
 */

namespace Litmus7\OTPLogin\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\UrlInterface;   
use Magento\Framework\Registry;

/**
 * Class OTPFormData
 */
class OTPFormData implements ArgumentInterface
{

    protected $_urlInterface;

    protected $_coreRegistry;

    public function __construct(
        UrlInterface $urlInterface,
        Registry $coreRegistry
    ){
        $this->_urlInterface = $urlInterface;
        $this->_coreRegistry = $coreRegistry;
    }
    /**
     * get OTP Login link
     *
     * @return string
     */
    public function getOTPLoginLink(){
        $this->_urlInterface->getUrl('otplogin/otplogin/index/');
    }
    /**
     * get Post Action URL
     *
     * @return string
     */
    public function getButtonName(){
        return __("OTP Login");
    }
    /**
     * get Post Email
     *
     * @return string
     */
    public function getEmail(){
        return $this->_coreRegistry->registry('email');
    }
}    