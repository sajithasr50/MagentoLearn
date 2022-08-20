<?php
namespace DollsKill\CustomerBlackList\Model;

use DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlacklist as ResourceModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class CustomerBlacklist extends AbstractModel implements IdentityInterface {

	const CACHE_TAG = 'customer_blacklist';

	protected function _construct() {
		$this->_init(ResourceModel::class);
	}
	public function getIdentities() {
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

}
