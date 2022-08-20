<?php
namespace DollsKill\CustomerBlackList\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class CustomerBlacklist extends AbstractDb {

	public function __construct(
		Context $context
	) {
		parent::__construct($context);
	}
	protected function _construct() {
		$this->_init('customer_blacklist', 'id');
	}
}
