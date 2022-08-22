<?php
declare(strict_types=1);

/**
 * Verify OTP controller
 *
 * verify otp 
 *
 * @author Shibin VR
 * @package Litmus7_OTPLogin
 */
namespace Litmus7\OTPLogin\Controller\OTPLogin;

use Magento\Framework\Controller\ResultFactory;
use Litmus7\OTPLogin\Controller\OTPLogin\ApiController;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Validator\EmailAddress as EmailValidator;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Framework\Message\ManagerInterface;
use Litmus7\OTPLogin\Helper\Data as EmailHelper;
use Litmus7\OTPLogin\Model\OTPLogin;

class VerifyOtp extends ApiController implements HttpPostActionInterface{
  
        /**
     * @var Session
     */
    protected $session;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var EmailValidator
     */
    protected $isEmailAvailable;

    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * @var AccountManagementInterface
     */
    private $accountManagement;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var EmailHelper
     */
    protected $emailHelper;

    /**
     * @var OTPLogin
     */
    protected $otpLogin;

    public function __construct(
        Context $context,
        Session $customerSession,
        EmailValidator $isEmailAvailable,
        ResultFactory $resultFactory,
        AccountManagementInterface $accountManagement,
        ManagerInterface $messageManager,
        EmailHelper $emailHelper,
        OTPLogin $otpLogin
    ) {
        $this->session = $customerSession;
        $this->isEmailAvailable = $isEmailAvailable;
        $this->resultFactory = $resultFactory;
        $this->accountManagement = $accountManagement;
        $this->messageManager = $messageManager;
        $this->emailHelper = $emailHelper;
        $this->otpLogin = $otpLogin;
        parent::__construct($context);
    }    
    public function execute() {    
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        try{
            $post = $this->getRequest()->getPostValue();
            if(empty($post['otp']) || empty($post['email'])){
                $this->messageManager->addErrorMessage(__("Invalid Request Please Try Again"));
                $redirect->setUrl('/otplogin/otplogin/index');
                return $redirect;
            }
            else{   
                $customer = $this->otpLogin->validateOTP($post["email"],$post["otp"]);
                if($customer){
                    $redirect->setUrl('/customer/account/index/');
                    return $redirect;
                }
                $this->messageManager->addErrorMessage(__("Entered OTP is Invalid"));
                $redirect->setUrl('/otplogin/otplogin/index');
                return $redirect;
            }
        }catch(\Exception $e){
            $redirect->setUrl('/otplogin/otplogin/index');
            return $redirect;
        }
 
    }
}