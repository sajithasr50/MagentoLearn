<?php
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

class SendOtp extends ApiController implements HttpPostActionInterface{
  
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
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        EmailValidator $isEmailAvailable,
        ResultFactory $resultFactory,
        AccountManagementInterface $accountManagement,
        ManagerInterface $messageManager,
        EmailHelper $emailHelper
    ) {
        $this->session = $customerSession;
        $this->isEmailAvailable = $isEmailAvailable;
        $this->resultFactory = $resultFactory;
        $this->accountManagement = $accountManagement;
        $this->messageManager = $messageManager;
        $this->emailHelper = $emailHelper;
        parent::__construct($context);
    }    
    public function execute() {    
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $page = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        try{
            $post = $this->getRequest()->getPostValue();
            /** @var \Magento\Framework\Validator\EmailAddress $this->emailValidator */
            if(empty($post['email'])){
                $redirect->setUrl('/otplogin/otplogin/index');
                return $redirect;
            }
            if (!$this->isEmailAvailable->isValid($post['email'])) {
                $redirect->setUrl('/otplogin/otplogin/index');
                return $redirect;
            }else{
                $isEmailAvailable = $this->accountManagement->isEmailAvailable($post['email']);
                if($isEmailAvailable){
                    $this->messageManager->addErrorMessage(__("Invalid Email Address"));
                    $redirect->setUrl('/otplogin/otplogin/index');
                    return $redirect; 
                }else{
                    $send = $this->emailHelper->sendOTPLoginEmail($post["email"]);
                    if($send){
                        $this->messageManager->addSuccessMessage(__("OTP Sent Succefully"));
                        $redirect->setUrl('/otplogin/otplogin/confirmotp/'.base64_encode($post["email"]));
                        return $redirect;
                    }else{
                        $this->messageManager->addErrorMessage(__("Please try again or contact customer care"));
                        $redirect->setUrl('/otplogin/otplogin/index');
                        return $redirect; 
                    }
                }
            }
        }catch(\Exception $e){
            $redirect->setUrl('/otplogin/otplogin/index');
            return $redirect;
        }
 
    }
}