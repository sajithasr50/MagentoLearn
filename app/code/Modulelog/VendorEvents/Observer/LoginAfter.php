<?php
declare (strict_types = 1);

namespace Modulelog\VendorEvents\Observer;

use Modulelog\VendorEvents\Model\DataExampleFactory;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;


/**
 * Class LoginAfter
 * Observer for customer_login to save the login details
 */
class LoginAfter implements ObserverInterface {


	public function __construct(
		DataExampleFactory $dataExampleFactory,LoggerInterface $loggerdata
	) {
		$this->dataExampleFactory = $dataExampleFactory;
		$this->loggerdata = $loggerdata;
	}
	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return $this
	 */
	public function execute(\Magento\Framework\Event\Observer $observer) {
	
		$email = $observer->getEvent()->getCustomer()->getEmail();
		$time 	= time();
		$model 	= $this->dataExampleFactory->create();
		$this->loggerdata->debug('NEW DATA');
		$model->addData([
			"email" =>$email,
			"created_at" => $time
			]);

        $model->save();
       
	}
}
