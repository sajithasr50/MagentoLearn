<?php 
namespace ModuleLog\VendorEvents\Model\ResourceModel\DataExample;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{
	public function _construct(){
		$this->_init("ModuleLog\VendorEvents\Model\DataExample","ModuleLog\VendorEvents\Model\ResourceModel\DataExample");
	}
}
 ?>