<?php 
declare(strict_types=1);

/**
 * Save OTP attributes value
 *
 * Creates otp login custom attribute
 *
 * @author Shibin VR
 * @package Litmus7_OTPLogin
 */

namespace Litmus7\OTPLogin\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\CustomerFactory;

/**
 * Class OTPLogin
 */
class OTPLogin 
{

    const LOGIN_OTP = "login_otp";

    const CREATED_OTP = "login_otp_created";

    /**
     * @var CustomerRepositoryInterface
     */
    private $_customerRepository;

    /**
     * @var TimezoneInterface
     */
    private $_timezoneInterface;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var Data
     */
    private $helper;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        TimezoneInterface $timezoneInterface,
        Session $customerSession,
        CustomerFactory $customerFactory
    ){
        $this->_customerRepository = $customerRepository;
        $this->_timezoneInterface = $timezoneInterface;
        $this->customerSession = $customerSession;
        $this->customerFactory = $customerFactory;
    }
    public function saveAttributes($email,$otp){
        if($email){
            $customer = $this->_customerRepository->get($email);
            $currentDateTime = $this->_timezoneInterface->date()->format('Y-m-d H:i:s');
            $customer->setCustomAttribute(self::LOGIN_OTP, $otp);
            $customer->setCustomAttribute(self::CREATED_OTP, $currentDateTime);
            $this->_customerRepository->save($customer);
            return true;
        }else{
            return false;
        }
    }
    public function validateOTP($email,$otp){
        $customer = $this->_customerRepository->get($email);
        $savedOTP = $customer->getCustomAttribute(self::LOGIN_OTP) ? $customer->getCustomAttribute(self::LOGIN_OTP)->getValue() : "";
        $createdAt = $customer->getCustomAttribute(self::CREATED_OTP) ? $customer->getCustomAttribute(self::CREATED_OTP)->getValue() : "";
        $currentDateTime = $this->_timezoneInterface->date()->format('Y-m-d H:i:s');
        $limitTime = 3000;
        if(empty($savedOTP) && empty($createdTime)){
            return false;
        }else{
            $expire = strtotime($createdAt.' + '.$limitTime.' seconds');
            $now = strtotime($currentDateTime);
            if($now >= $expire){
                $this->clearOtp($customer);
                return false;
            }else{
                if($otp == $savedOTP){
                   return $this->otpLogin($customer);
                }
            }
            $this->clearOtp($customer);
            return false;
        }
    }
    public function otpLogin($customerRepo)
    {
         $customer = $this->customerFactory->create()->load($customerRepo->getId());
         $this->customerSession->setCustomerAsLoggedIn($customer);
         $this->clearOtp($customerRepo);
         return true;
    }
    public function clearOtp($customerRepo)
    {
        $customerRepo->setCustomAttribute(self::LOGIN_OTP, NULL);
        $customerRepo->setCustomAttribute(self::CREATED_OTP, NULL);
        $this->_customerRepository->save($customerRepo);
    }
}