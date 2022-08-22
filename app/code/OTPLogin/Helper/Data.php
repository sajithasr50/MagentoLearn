<?php
declare(strict_types=1);

/**
 * Helper OTP Login
 *
 * OTP Login Helper
 *
 * @author Shibin VR
 * @package Litmus7_OTPLogin
 */

namespace Litmus7\OTPLogin\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Litmus7\OTPLogin\Model\OTPLogin;


/**
 * Class Data
 */
class Data extends AbstractHelper
{
    protected $transportBuilder;
    protected $storeManager;
    protected $inlineTranslation;
    protected $otpLogin;

    const EXPIRE_TIME = 'otplogin/general/expire_time';

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        StateInterface $state,
        OTPLogin $otpLogin
    )
    {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->inlineTranslation = $state;
        $this->otpLogin = $otpLogin;
        parent::__construct($context);
    }

    public function sendOTPLoginEmail($to)
    {
        // this is an example and you can change template id,fromEmail,toEmail,etc as per your need.
        $templateId = 'otp_login_email_template'; // template id
        $fromEmail = 'magecodez@gmail.com';  // sender Email id
        $fromName = 'Magecodez';             // sender Name
        $toEmail = $to; // receiver email id
        $otp = $this->generateOTP();
        $saved = $this->otpLogin->saveAttributes($to,$otp);
        if(!$saved){
            return $saved;
        }
        try {
            // template variables pass here
            $templateVars = [
                'otp' => $otp
            ];

            $storeId = $this->storeManager->getStore()->getId();

            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();

            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            return true;
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
            return false;
        }
    }
    public function generateOTP()
    {
        $length = $strength = 8;
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) 
        {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) 
        {
            $vowels .= "AEUY";
        }
        if ($strength & 4) 
        {
            $consonants .= '234567890';
        }
        if ($strength & 8) 
        {
            $consonants .= '@#$%*(&)^=+-';
        }
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) 
        {
            if ($alt == 1) 
            {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } 
            else 
            {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }
    public function expireTime(){
        return $this->getConfig(self::EXPIRE_TIME);
    }
    public function getConfig($config_path)
    {
        return $this->scopeConfig->getValue(
                $config_path,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                );
    }
}