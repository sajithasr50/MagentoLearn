<?php
namespace Litmus7\OTPLogin\Controller\Noroute;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Cms\Controller\Noroute\Index
{
     /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context,$resultForwardFactory);
    }
     public function execute(){
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__(' heading '));
           $block = $resultPage->getLayout()
           ->createBlock('Magento\Framework\View\Element\Template')
           ->setTemplate('Litmus7_OTPLogin::404/noroute.phtml')
           ->toHtml();
          $this->getResponse()->setBody($block);

     }
     
}