<?php
namespace Litmus7\OTPLogin\Block\frontend\button;
use Magento\Framework\View\Element\Template;


class OTPConfirm extends Template
{
    protected $formKey;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \Magento\Framework\Registry $coreRegistry,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }
    /**
     * get OTP Login link
     *
     * @return string
     */
    public function getOTPLoginLink(){
        return $this->getUrl("otplogin/otplogin/index/");
    }
    /**
     * get form key
     *
     * @return string
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
    /**
     * get Post Action URL
     *
     * @return string
     */
    public function getPostActionUrl(){
        return $this->getUrl("otplogin/otplogin/verifyotp/"); 
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