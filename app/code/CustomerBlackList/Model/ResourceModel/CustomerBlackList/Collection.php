<?php
declare (strict_types = 1);
/**
 * Module Customer Blacklist Model Collection
 * @package DollsKill/CustomerBlackList
 */

namespace DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlackList;

use DollsKill\CustomerBlackList\Model\CustomerBlacklist as Model;
use DollsKill\CustomerBlackList\Model\ResourceModel\CustomerBlacklist as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct() {
		$this->_init(
			Model::class,
			ResourceModel::class
		);
	}
}
