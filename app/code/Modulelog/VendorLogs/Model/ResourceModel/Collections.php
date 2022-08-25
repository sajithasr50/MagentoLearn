<?php 
namespace ModuleLog\VendorLogs\Model\ResourceModel\DataExample;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("ModuleLog\VendorLogs\Model\DataExample","ModuleLog\VendorLogs\Model\ResourceModel\DataExample");
	}
}
 ?>