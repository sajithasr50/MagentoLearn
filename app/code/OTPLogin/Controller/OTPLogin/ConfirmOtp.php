<?php
namespace Litmus7\OTPLogin\Controller\OTPLogin;

use Codeception\Lib\Di;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Registry;
use Magento\Framework\Controller\ResultFactory;
use Magento\Customer\Api\AccountManagementInterface;

/**
 * Class ConfirmOTP
 */
class ConfirmOtp extends \Magento\Framework\App\Action\Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var AccountManagementInterface
     */
    private $accountManagement;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        Registry $coreRegistry,
        ResultFactory $resultFactory,
        AccountManagementInterface $accountManagement
    ) {
        $this->session = $customerSession;
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->resultFactory = $resultFactory;
        $this->accountManagement = $accountManagement;
        parent::__construct($context);
    }
    /**
     * @inheritdoc
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        if ($this->session->isLoggedIn()) {
            $resultRedirect->setPath('*/*/');
            return $resultRedirect;
        }
        $params = $this->getRequest()->getParams();
        $param = array_key_first($params);
        if(empty($param)){
            $this->messageManager->addErrorMessage(__("Invalid request please try again"));
            $redirect->setUrl('/otplogin/otplogin/index/');
            return $redirect;
        }
        $email = base64_decode($param);
        $isEmailAvailable = $this->accountManagement->isEmailAvailable($email);
        if($isEmailAvailable){
            $this->messageManager->addErrorMessage(__("Invalid request please try again"));
            $redirect->setUrl('/otplogin/otplogin/index/');
            return $redirect;
        }    
        $this->_coreRegistry->register('email',$email);
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setHeader('OTP-Login-Required', 'true');
        return $resultPage;
    }
}
