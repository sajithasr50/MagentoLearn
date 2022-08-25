<?php
declare (strict_types = 1);

namespace Modulelog\VendorEvents\Observer;

use Modulelog\VendorEvents\Model\DataExampleFactory;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class OrderSaveAfter
 * Observer for sales_order_save_after checking blacklist email
 */
class LoginAfter implements ObserverInterface {


	public function __construct(
		DataExampleFactory $dataExampleFactory
	) {
		$this->dataExampleFactory = $dataExampleFactory;
	}
	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return $this
	 */
	public function execute(\Magento\Framework\Event\Observer $observer) {
	
		$email = $observer->getEvent()->getCustomer()->getEmail();
		$time 	= time();
		$model 	= $this->dataExampleFactory->create();
		$model->addData([
			"email" =>$email,
			"created_at" => $time
			]);

        $model->save();
         //return $this;
	}
}
