<?php
declare (strict_types = 1);

namespace DollsKill\CustomerBlackList\Observer;

use DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlackList\CollectionFactory;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class OrderSaveAfter
 * Observer for sales_order_save_after checking blacklist email
 */
class OrderSaveAfter implements ObserverInterface {

	const ORDER_STATUS = "fraud_review";

	/**
	 * @var CollectionFactory
	 */
	protected $_blackListFactory;

	/**
	 * @param CollectionFactory $blackListFactory
	 */
	public function __construct(
		CollectionFactory $blackListFactory
	) {
		$this->_blackListFactory = $blackListFactory;
	}
	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return $this
	 */
	public function execute(\Magento\Framework\Event\Observer $observer) {
		$order = $observer->getEvent()->getOrder();
		if ($order->getCustomerEmail()) {
			$collection = $this->_blackListFactory->create();
			$collection->addFieldToFilter('email', $order->getCustomerEmail());
			$collection->addFieldToFilter('status', true);
			$payment = $order->getPayment();
			if ($order->getStatus() != self::ORDER_STATUS
				&& $collection->getSize() > 0
				&& $payment
				&& $payment->getMethod()) {
				if (in_array($payment->getMethod(), array('paypal_express', 'stripe_payments', 'stripe_payments_express'))) {
					$order->setStatus(self::ORDER_STATUS);
					$order->addStatusHistoryComment('Customer email is Blacklisted.');
					$order->save();
				}
			}
		}
	}
}
