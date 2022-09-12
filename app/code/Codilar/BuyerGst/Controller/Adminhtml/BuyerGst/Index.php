<?php

namespace Codilar\BuyerGst\Controller\Adminhtml\BuyerGst;

class Index extends \Magento\Backend\App\Action
{
	 /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var JsonFactory
     */
    protected $_resultJsonFactory;

    /**
     * @var \Magento\Sales\Model\ResourceModel\Order
     */
    protected $_orderResourceModel;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $_orderRepository;

    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $_quoteRepository;

    /**
     * MassPrevent constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\ResourceModel\Order $orderResourceModel,
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
       	$this->_orderResourceModel = $orderResourceModel;
        $this->_orderRepository = $orderRepository;
        $this->_quoteRepository = $quoteRepository;
        parent::__construct($context);
    } 
    /**
     * Execute mass action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
    	$httpBadRequestCode = 400;	
    	 if ($this->getRequest()->getMethod() !== 'POST' || !$this->getRequest()->isXmlHttpRequest()) {
            $response = [
                    'errors' => true,
                    'message' => "Invalid Request"
                ];
        }else{
        	 try {
        	 	$orderId=$this->getRequest()->getPostValue('order');
        	 	$buyergst=$this->getRequest()->getPostValue('buyergst');
        	 	if($orderId){
        	 		$order = $this->_orderRepository->get($orderId);
        	 		$order->setData("buyer_gst",$buyergst);
        	 		$this->_orderRepository->save($order);
        	 		$quote = $this->_quoteRepository->get($order->getQuoteId());
                    $quote->setData("buyer_gst", $buyergst);
                    $this->_quoteRepository->save($quote);
        	 	}
        	 	 $response = [
                        'errors' => false,
                        'message' => __("Buyer GST Updated Successfully")
                    ];

        	 }catch (\Exception $e) {
                $response = [
                    'errors' => true,
                    'message' => $e->getMessage()
                ];
            }   	
        }
        $resultJson = $this->_resultJsonFactory->create();
        return $resultJson->setData($response);   	
    }
}